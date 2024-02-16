<?php namespace App\Http\Controllers;

use App\Course;
use App\Examination;
use App\ExaminationUser;
use App\Faculty;
use App\Http\Requests;
use App\Http\Requests\ExaminationsRequest;
use App\Http\Requests\ExaminationsUpdateRequest;
use App\Setting;
use Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Input;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminExaminationsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //$courses = ['' => 'Select Courses:'] + Course::all()->lists('code', 'id');
        //$faculties = ["" => "Please Select"]+Faculty::lists('name','id');
		$classes_ = \App\Classes::with(array('class_arm' => function($x){
			$x->orderBy('arm_name');
		}))->orderBy('name')->get();
		
		$classes = array();
		foreach($classes_ as $c)
		{
			foreach($c->class_arm as $classArm)
			{
				$classes[$classArm->id."|||".$c->id."|||".$c->name." ".$classArm->arm_name] = $c->name." ".$classArm->arm_name;
			}
		}
        return view('admin.exam.faculties',compact('classes'));
        //return view('admin.exam.create', compact('courses'));
        //return view('admin.exam.create', compact('courses'));
    }

	
	public function refeshCandidates($id)
	{
		$examination = Examination::where('id', '=', $id)->first();
		$examinationUsers = ExaminationUser::where('examination_id', '=', $examination->id)->lists('user_id');
		$users = \App\User::where('class_arm_id', '=', $examination->class_arm_id)->whereNotIn('id', $examinationUsers)->get();
		
		foreach($users as $usr)
		{
			$examUser = new \App\ExaminationUser();
			$examUser->examination_id = $examination->id;
			$examUser->level = $examination->class_arm_id;
			$examUser->unique_exam_code = str_random(13);
			$examUser->user_id = $usr->id;
			$examUser->status = 'active';
			
			$examUser->save();
		}
		Flash::success('Examination Candidated Refreshed successfully');
		return \Redirect::back();
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param ExaminationsRequest $request
     * @return Response
     */
    public function store(ExaminationsRequest $request)
    {

        $attributes = $request->except("_token", "score_weight_type");
//        $attributes['duration'] = $request->get('duration');
        $attributes['status'] = 'created';
        $attributes['str_verify'] = str_random(10);
        $examination = Examination::firstOrCreate($attributes);
		$users = \App\User::where('class_arm_id', '=', \Input::get('class_arm_id'))->get();
		
		foreach($users as $usr)
		{
			$examUser = new \App\ExaminationUser();
			$examUser->examination_id = $examination->id;
			$examUser->level = \Input::get('class_arm_id');
			$examUser->unique_exam_code = str_random(13);
			$examUser->user_id = $usr->id;
			$examUser->status = 'active';
			$examUser->save();
		}
		
//        Setting::where('examination_id', $examination->id)->where('key', 'DISPLAY_RESULTS')->delete();
        Setting::create([
            'key' => 'DISPLAY_RESULTS',
            'value' => 'NO',
            'examination_id' => $examination->getKey(),
        ]);

        Flash::success('Examination created successfully');

        return redirect('/admin/exams/' . $examination->id . '/questions/upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $examination = Examination::find($id);
        if (!$examination) {
            \App::abort(Response::HTTP_NOT_FOUND);
        }

        return view('admin.exam.show', compact('examination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $courses = ['' => 'Select Courses:'] + Course::all()->lists('title', 'id');

        $examination = Examination::findOrFail($id);

        return view('admin.exam.edit', compact('examination', 'courses'));
    }

    /**
     * @param ExaminationsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ExaminationsUpdateRequest $request, $id)
    {

        $attributes = $request->all();
//        $attributes['status'] = 'inactive';
//        $attributes['str_verify'] = str_random(10);
//        if (!isset($attributes['score_weight_type'])) {
//            $attributes['question_score_weight'] = null;
//        }
        $examination = Examination::findOrFail($id)->update($attributes);
        if ($examination) {
            Flash::success('Examination updated successfully');

            return redirect('/admin/exams/' . $id);
        }
        Flash::danger('Failed to update examination details');

        return redirect('/admin/exams/' . $id);
    }


    public function getSet($id)
    {
        $examination = Examination::findOrFail($id);
        return view('admin.exam.set',compact('examination'));
    }


    public function postSet(Requests\SetExaminationsRequest $request,$id)
    {
        $data = \Request::all();
        $data['status'] = 'active';
        $examDate = $data['exam_date'];
        try {
            $data['exam_date'] = \Carbon\Carbon::createFromFormat('j M Y h:i A', $examDate);
        }
        catch (\Exception $e) {
            $data['exam_date'] = \Carbon\Carbon::createFromFormat('d/m/Y h:i A', $examDate);
        }

        if (Examination::find($id)->update($data)) {
            $value = \Request::get('show_result');
			$settings = Setting::where('examination_id', '=', $id);
            if($settings->count() > 0) {
                $setting = $settings->first();
				$setting->value = 'YES';
				$setting->save();
            }
            else {
                $setting = Setting::create(['key' => 'DISPLAY_RESULTS', 'value' => 'NO', 'examination_id' => $id]);
            }
            flash()->success('Update successful');
            return redirect('admin/exams/' . $id);
        }
        flash()->danger('An error occurred.');
        return redirect('admin/exams/' . $id);
    }




    public function examresults($id = null)
    {
        $examination = Examination::find($id);
        $this->generateAndDownload($examination);
    }
    /**
     * Update the specified resource in storage.
     * /PATCH
     * @param  int $id
     * @return Response
     */
    public function end($id)
    {
        if (Examination::find($id)->update(['status' => 'inactive'])) {
            flash()->success('Update successful');
            return redirect('admin/exams/');
        }
        flash()->danger('An error occurred.');

        return redirect('admin/exams/');
    }

    public function archive($id)
    {
        if (Examination::find($id)->update(['status' => 'archived'])) {
            flash()->success('Update successful');
            return redirect('admin/exams/');
        }
        flash()->danger('An error occurred.');

        return redirect('admin/exams/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $examination = Examination::findOrFail($id);
        }
        catch(ModelNotFoundException $e) {
            flash()->error("The examination does not exist.");

            return back();
        }
        if ($examination->status == 'active') {
            flash()->error('Cannot delete examination when it is set');

            return back();
        }
        else{
            $examination->status = 'deleted';
            $examination->save();
            $examination->delete();
            flash()->success('Examination deleted');
            return redirect('/admin/exams');
        }

        flash()->warning('There was a problem performing that action');

        return redirect('/admin/exams');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $exams = Examination::where('status', '!=', 'deleted')->has('course')->with('questions')->get();

//        $exams = Examination::where('status','!=','archived')->get();
//        dd($exams);
        return view('admin.exam.index', compact('exams'));
    }

    /**
     * Get the template for the question
     * @param int $id
     */
    public function template($id)
    {
        $examination = Examination::with('class_')->with('class_arm')->find($id);
        $this->generateAndDownload($examination);
    }

    /**
     * @param $examination
     */
    private function generateAndDownload($examination)
    {
        Excel::create($examination->title . '_Exam_Questions_verifycode__' . strtoupper($examination->str_verify) . '__template',
            function ($excel) use ($examination) {
                $excel->sheet('Questions', function ($sheet) use ($examination) {
                    $data = array();
                    if ($examination->question_score_weight) {
                        $data['score'] = $examination->question_score_weight;
                        $data['no_of_questions'] = $examination->no_of_questions;
                    }
//				$sheet->protectCells('A1:Z20');
//				$sheet->setFreeze('A9');
                    $sheet->freezeFirstRowAndColumn();
                    $sheet->loadView('admin.exam.template')->with('examination', $examination);
                });
            })->download('xls');
    }


    public function step2(Requests\CreateExamStep2Request $request)
    {

		$class = explode('|||', ($request->get('class')));
		$class_id = $class[1];
		$class_arm_id = $class[0];
		$className = $class[2];
        $dbCourses = Course::all();
        $courses = [NULL => '-Select A Subject-'] + $dbCourses->lists('title', 'id');
        if($dbCourses->count() > 0) {
            return view('admin.exam.create', compact('courses', 'class_id', 'class_arm_id', 'className'));
        }else
        {
            Session::flash("error", 'No subject has been created on the platform. Create at least one subject before you can proceed');
            return \Redirect::back();
        }
    }



    public function stepone()
    {
        $faculties = ["" => "Please Select"]+Faculty::lists('name','id');
        return view('admin.exam.steptwo',compact('faculties'));
    }

    public function step3($exam_id = null)
    {

        //$courses = DB::table('courses')->where('department_offering', '=', $department)->get();
        $dbCourses = Course::all();
        $courses = ['' => 'Select Courses:'] + $dbCourses->lists('title', 'id');
        //dd(DB::table('users')->where('department', '=', $department)->where('level', '=', $level)->toSql());
        //dd($candidates);
//        if(isset($courses) && $courses!=null) {
        if($dbCourses->count() > 0) {
            return view('admin.exam.create', compact('courses'));
        }else
        {
            Session::flash("error", 'No Classes have been created on the platform yet. You Must create at least one class and class arm if to proceed');
            return \Redirect::to('/admin/exams/create');
        }
    }



    /** List all questions related to the examination resource and their options
     * @param $id
     * @return \Illuminate\View\View
     */
    public function questions($id)
    {
        $examination = Examination::findOrFail($id);
        $questions = $examination->questions()->paginate(50);
		
		
		$q1 = array();
		foreach($questions as $q)
		{
			array_push($q1, $q->id);
		}
		
		
		$options = \App\Option::whereIn('question_id', $q1)->lists('id');
		$optionImages = \App\OptionImage::whereIn('option_id', $options)->get();
		$questionImages = \App\QuestionImage::whereIn('question_id', $q1)->get();

        return view('admin.exam.questions', compact('examination', 'questions', 'optionImages', 'questionImages'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function uploadQuestions($id)
    {
        $examination = Examination::findOrFail($id);

        return view('admin.exam.uploadquestions', compact('examination'));
    }


    public function downloadResultSheet($id) {
        $examination = Examination::find($id);
        Excel::create($examination->title . '_result_sheet',
            function ($excel) use ($examination) {
                $excel->sheet('Results', function ($sheet) use ($examination) {
                    $candidates = $examination->examinationUsers()->has('user')->where('examination_id', '=', $examination->id)->get();
//                    $candidates = DB::table('examination_users')->where('examination_id', '=', $examination->id)->get();
                    $course = DB::table('courses')->where('id', '=', $examination->course_id)->first();
                    //dd($course);
                    //$dept = DB::table('departments')->where('id', '=', $course->department_offering)->first();-->

                    $sheet->freezeFirstColumn();

                    $sheet->loadView('admin.exam.result-template')
                        ->with('examination', $examination)
                        ->with('course', $course)
                        //->with('dept', $dept)
                        ->with('candidates', $candidates);
                });
            })->download('xls');
    }


//    public function downloadResultSheet($id) {
//        //dd($id);
////        $examination = DB::table('examinations')->where('id', '=', $id)->first();
//        $examination = Examination::find($id);
//        //dd($examination);
//        Excel::create($examination->title . '_result_sheet',
//            function ($excel) use ($examination) {
//                $excel->sheet('Results', function ($sheet) use ($examination) {
//                    $candidates = $examination->examinationUsers()->has("");
//                    $candidates = $candidates->filter(function($exam_user){
//                        if($exam_user->first()->user){
//                            if($exam_user->first()->user->user_department) {
//                                return true;
//                            }
//                        }
//                    });
//                    $candidates = $candidates->where('examination_id', '=', $examination->id)->get();
////                    $candidates = DB::table('examination_users')->where('examination_id', '=', $examination->id)->get();
//                    $course = DB::table('courses')->where('id', '=', $examination->course_id)->first();
//                    //dd($course);
//                    $dept = DB::table('departments')->where('id', '=', $course->department_offering)->first();
//
//                    $sheet->freezeFirstColumn();
//
//                    $sheet->loadView('admin.exam.result-template')
//                        ->with('examination', $examination)
//                        ->with('course', $course)
//                        ->with('dept', $dept)
//                        ->with('candidates', $candidates);
//                });
//            })->download('xls');
//    }

    /**
     * Delete Examination via get and not the /DELETE destroy method as usual
     * @param $id
     * @return Response
     */
    public function deleteExamination($id) {
        return $this->destroy($id);
    }

    public function endExamination($id) {
        return $this->end($id);
    }
}

