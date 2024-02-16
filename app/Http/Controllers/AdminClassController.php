<?php namespace App\Http\Controllers;

use App\Department;
use App\Examination;
use App\ExaminationUser;
use App\Faculty;
use App\FileUpload;
use App\Http\Requests;
use App\Http\Requests\UploadClassRequest;
use App\Role;
use App\User;
use Excel;
use File;
use Illuminate\Support\Facades\DB;
use Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Input;
use Session;

class AdminClassController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $examination = Examination::findOrFail($id);
//        $candidates = $examination->examinationUsers()->paginate(10);
        $candidates = $examination->examinationUsers()->with('user')->has('user')->paginate(10);

        return view('admin.class.index', compact('examination', 'candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadClassRequest $request
     * @param $id
     * @return Response
     */
    public function store(UploadClassRequest $request)
    {
        //dd(33);
        $buttonClicked = $request->get('buttonClicked');

        if($buttonClicked==1) {
            $examinationId = $request->get('examination_id');
            $file = $request->file('candidates');

            if (!$this->verifyUploadedSheet($file, $examinationId)) {
                return back();
            }

            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put('/exam_class/' . $request->get('examination_id') . '/' . time() . '/' . $file->getClientOriginalName() . '.' . $extension,
                File::get($file));
            $entry = new FileUpload();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $examinationId . ' ' . $file->getClientOriginalName();
            $entry->user_id = \Auth::user()->id;
            $entry->examination_id = $examinationId;
            $entry->save();
            ExaminationUser::where('examination_id', '=', $examinationId)->delete();
            $sheet = Excel::load($request->file('candidates'))->noHeading(true)->skip(8);
            $rows = null;
            try {
                $rows = $sheet->get();
            } catch (\Exception $e) {
                flash()->danger('There is a problem with the values in the sheet you uploaded. Check that it contains data.');

                return back();
            }
            if (!$rows) {
                flash()->danger('There is a problem with the values in the sheet you uploaded. Check that it contains data.');

                return back();
            }


            $this->processCandidates($rows, $examinationId);
            flash()->success('Candidates uploaded successfully');
        }
        else {
            $faculties = ["" => "Please Select"]+Faculty::lists('name','id');
            $examinationId = $request->get('examination_id');
            $examination = Examination::find($examinationId);
            return view('admin.class.faculties',compact('faculties','examination'));
        }

        return new RedirectResponse('/admin/exams/' . $request->get('examination_id') . '/class');
    }


    public function getFacultiesView($exam_id){
        $faculties = ["" => "Please Select: "]+Faculty::lists('name','id');
        $examination = Examination::find($exam_id);
        return view('admin.class.faculties',compact('faculties','examination'));
    }



    public function steptwo(Requests\AddClassStep2Request $request,$id)
    {
        $examination = Examination::find($id);
        $faculty_id = Input::get('faculty');
        $departments = ["" => "Please Select"]+Department::where('faculty_id',$faculty_id)->lists('name','id');
        $levels = ["" => "Please Select"]+DB::table('levels')->lists('name','id');
        return view('admin.class.steptwo',compact('examination','departments','levels'));
    }

    public function stepthree(Requests\AddClassStep3Request $request,$exam_id = null)
    {
        $level = Input::get('level');
        $examination = Examination::where('id',$exam_id)->first();
        $department = Input::get('department');
        $students = DB::table('users')->where('department', '=', $department)->where('level', '=', $level)->get();
        //dd(DB::table('users')->where('department', '=', $department)->where('level', '=', $level)->toSql());
        //dd($candidates);
        $dept = DB::table('departments')->where('id', '=', $department)->get();
        $lvl = DB::table('levels')->where('id', '=', $level)->get();
        return view('admin.class.stepthree',compact('students','dept','lvl', 'examination'));
    }


    public function stepzero($exam_id = null)
    {
        $examination = Examination::where('id',$exam_id)->first();
//        $students = DB::table('examination_users')->where('examination_id', '=', $exam_id);
        $students = [];
        $students1 = ExaminationUser::where('examination_id',$exam_id)->get();
        foreach($students1 as $student){
            if($student->user!=null)
                $students[] = $student->user;
        }
        //dd($students);
        //dd(DB::table('users')->where('department', '=', $department)->where('level', '=', $level)->toSql());
        //dd($candidates);
        return view('admin.class.stepzero',compact('students', 'examination'));
    }

    public function deleteCandidate($exam_id = null, $student_id = null)
    {
        $exam_user = ExaminationUser::where('examination_id',$exam_id)->where('user_id',$student_id)->first();
        if($exam_user){
            $exam_user->delete();
        }
        $examination = Examination::where('id',$exam_id)->first();
//        $students = DB::table('examination_users')->where('examination_id', '=', $exam_id);
        $students = [];
        $students1 = ExaminationUser::where('examination_id',$exam_id)->get();
        foreach($students1 as $student){
            if($student->user!=null)
                $students[] = $student->user;
        }
        //dd($students);
        //dd(DB::table('users')->where('department', '=', $department)->where('level', '=', $level)->toSql());
        //dd($candidates);
        Session::flash("message", 'Candidate deleted from the list of candidates for the examination - '.$examination->title );
        return view('admin.class.stepzero',compact('students', 'examination'));
    }




    public function stepfour($exam_id = null)
    {

        $students = Input::get('studentsList');
        $level = Input::get('level');
        $exm = $exam_id;
            $examination = DB::table('examinations')->where('id', '=', $exam_id)->first();

            for ($x = 0; $x < sizeof($students); $x++) {
                $examUser = DB::table('examination_users')->where('examination_id', '=', $exam_id)->where('user_id', '=', $students[$x])->get();

                if (isset($examUser) && $examUser != null) {
                    //dd((isset($examUser) && $examUser!=null));
                } else {
                    $examUser = ExaminationUser::create(['user_id' => $students[$x], 'examination_id' => $exam_id, 'level' => $level, 'status' => 'active']);
                }
            }
            $faculties = ["" => "Please Select"] + Faculty::lists('name', 'id');
            //Session::flash("message", 'Candidates successfully added to the examination. Add More to this examination?' );
            return redirect('admin/exams/' . $exam_id)->with('message', 'Candidates successfully added to the examination. Click <a href="/admin/exams/' . $exam_id . '/getFacultiesView"><b>here</b></a> to add more candidates.');

//        return view('admin.class.faculties',compact('faculties','examination'))->with('message', 'Candidates successfully added to the examination. Add More to this examination?');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Action to download class template for examination
     *
     * @param $id
     */
    public function classTemplate($id)
    {
        $examination = Examination::find($id);
        $this->generateClassSheet($examination);
    }

    /**
     * @param $examination
     */
    private function generateClassSheet($examination)
    {
        Excel::create($examination->title . '_Candidate_List__' . $examination->str_verify . '__class_template',
            function ($excel) use ($examination) {
                $excel->sheet('Candidates', function ($sheet) use ($examination) {
                    $sheet->freezeFirstColumn();
                    $sheet->loadView('admin.exam.class')->with('examination', $examination);
                });
            })->download('xls');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function upload($id)
    {
        $examination = Examination::findOrFail($id);
//        dd();


        if(!$examination->isCreated OR $examination->isActive OR $examination->isArchived) {
            flash()->warning("You cannot upload candidates to an examination that is running or archived.");
            return back();
        }
        return view('admin.class.upload', compact('examination'));
    }

    /**
     * @param $file
     * @param $examinationId
     * @return bool
     */
    private function verifyUploadedSheet($file, $examinationId)
    {
        $fileNameArr = explode('__', $file->getClientOriginalName());
        if (isset($fileNameArr[1])) {
            $exam = Examination::find($examinationId);
            if ($exam->str_verify == $fileNameArr[1]) {
                return true;
            }
        }
        \Flash::error('The uploaded file does not match this examination. Please download the specified template by clicking the <b>Get Questions template </b> button');

        return false;
    }

    /**
     * @param $rows
     * @param $examinationId
     */
    public function processCandidates($rows,  $examinationId) {
        foreach($rows->all() as $row) {

            $user['identity_no'] = $row->get(1);
            $user['first_name'] = $row->get(2);
            $user['last_name'] = $row->get(3);
            $mUser = User::where('identity_no', $user['identity_no'])->first();
//            dd($mUser);
            if(! $mUser) {
//                $mUser = User::create($user);
//                $role = Role::where('name', 'student')->first();
//                $mUser->attachRole($role);
                continue;
            }
            if($mUser) {
                $examUser['user_id'] = $mUser->id;
                $examUser['examination_id'] = $examinationId;
                $examUser['level'] = $row->get(4);
//                $examUser['unique_exam_code'] = $row->get(5);
                $examUser['status'] = 'inactive';
                $mExamUser = ExaminationUser::create($examUser);
            }
        }
    }
}
