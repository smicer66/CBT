<?php namespace App\Http\Controllers;

use App\Answer;
use App\Examination;
use App\ExaminationUser;
use App\Http\Requests;
use App\Option;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use DB;

class ExamController extends Controller
{


    protected $examination;


    public function __construct(Examination $examination)
    {
        $this->middleware('auth');
        $this->middleware('student');
        $this->$examination = $examination;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $user_id = \Auth::user()->id;
        $exam_ids = [];
        $examinations = \App\Examination::where('class_arm_id', '=', \Auth::user()->class_arm_id)->with('course')->get();

		foreach($examinations as $ex)
		{
			$examUsers = \App\ExaminationUser::where('examination_id', '=', $ex->id)->where('user_id', '=', \Auth::user()->id)->first();
			
			if($examUsers!=NULL)
				$exam_ids[$ex->id] = $examUsers; 
		}
		$questions = \DB::table('questions')->select('examination_id', DB::raw('sum(score_weight) as total'))->groupBy('examination_id')->get();
		$q2 = array();
		foreach($questions as $q)
		{
			$q2[$q->examination_id]= $q->total;
		}

		

		

        return view('exam.index', compact('examinations', 'exam_ids', 'q2'));
    }


//    public function getExamList($user_id)
//    {
//        $exam_ids = [];
//        $exams_user = ExaminationUser::where('user_id', $user_id)->where('status', 'active')->get();
//        if ($exams_user and $exams_user->count() > 0) {
//            foreach ($exams_user as $exam_user) {
//                $exam_ids[] = $exam_user->examination_id;
//            }
//            $examinations = Examination::whereIn('id', $exam_ids)->get();
//
//            return view('front.examinations.index', compact('examinations'));
//        } else {
//            return redirect()->back()->with('message', 'You do not have any active examinations to write at this time');
//        }
//    }



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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user_id = \Auth::user()->id;
        $examination = Examination::where('id', $request->get('examination_id'))->first();
        $examination_user = ExaminationUser::where('user_id', $user_id)->where('examination_id',
            $request->get('examination_id'))->first();
        $total_num_questions = count($examination->questions);
        $candidate_score = 0;
        Answer::where('examination_user_id', $examination_user->id)->delete();

        if (!$this->verifyTime($examination_user, $examination)) {
            $examination_user->result = $candidate_score;
            $examination_user->save();
            flash()->error('Your examination was not submitted in time therefore you have no score. Contact the examiner for help.');

            return redirect('client/examinations');
        }

        for ($i = 1; $i <= $total_num_questions; $i++) {
            $key = "answers" . $i;
            $answers = ($request->get($key));
            if (isset($answers)) {
                if (!is_array($answers)) {
                    $option = Option::where('id', $answers)->first();
                    $question = $option->question;
                    $inserted_answer = Answer::create([
                        'question_id' => $question->id,
                        'option_id' => $option->id,
                        'examination_user_id' => $examination_user->id
                    ]);
                    if ($option->correct_answer) {
                        $candidate_score += $question->score_weight;
                    }
                } else {
                    $question = null;
                    $options = [];
                    foreach ($answers as $option_id) {
                        $option = Option::where('id', $option_id)->first();
                        $question = $option->question;
                        $options[] = $option_id;
                        $inserted_answer = Answer::create([
                            'question_id' => $question->id,
                            'option_id' => $option->id,
                            'examination_user_id' => $examination_user->id
                        ]);
                    }
                    $correct_options = [];
                    $option_collection = Option::where('question_id', $question->id)->where('correct_answer',
                        '1')->get();
                    foreach ($option_collection as $option) {
                        $correct_options[] = $option->id;
                    }
                    $count = sizeof($correct_options);
                    $number_correct = sizeof(array_intersect($options, $correct_options));
                    $score = ($number_correct / ($count==0 ? 1 : $count) * $question->score_weight);
                    $candidate_score += $score;

                }

            }

        }
        $examination_user->result = round($candidate_score,2);
        $examination_user->status = 'inactive';
        $examination_user->save();

        return redirect('client/examinations')->with('message', "Your examination was successfully submitted");
    }

    /**
     * Check if user submitted in time.
     *
     * @author Michael Obi
     *
     * @param ExaminationUser $examinationUser
     * @param Examination $examination
     * @return bool
     */
    public function verifyTime(ExaminationUser $examinationUser, Examination $examination)
    {
        // Time of submission
        $currentTime = Carbon::now();

        // Time Examination started
        $startTime = $examinationUser->started_at;


        // Examination duration in seconds with Addition of one minute for latency issues.
//        $duration = $examination->duration / 1000;
        $duration = $examination->duration * 60;

        // Time Examination is supposed to end
        $endTime = $examinationUser->started_at->addSeconds($duration)->addMinutes(1);

        //dd($endTime." - ". $startTime." - ". $currentTime." - ". $duration);
        if ($currentTime->between($startTime, $endTime)) {
            return true;
        }

        return false;

    }

    /**
     * Display the specified resource.
     *
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if(! \Session::get('auth_code')) {
            flash()->error('Please input your authentication code');

            return redirect('client/examinations/confirm/' . $exam_id);
        }
		

        $examination = Examination::where('id', $id)->first();
        if (!$examination->isActive) {
            flash()->warning('The Examination is not active.');

            return \Redirect::to('/client/examinations');
        }
        $examinationUser = $examination->examinationUsers()->where('user_id', \Auth::user()->getKey())->first();
		
        if (!is_null($examinationUser->started_at)) {
            flash()->error('You cannot take this examination again. Contact the administrator to reset your details');
            return redirect('/client/examinations');
        }
        $questions = Question::with(array('options'=>function($x){
			$x->with('optionImages');
		}))->with('qnImages')->where('examination_id', '=', $id)->where('score_weight', '>', 0)->get();
		
		
		
        $questionCollection = [];
        //populate question collection with questions

        if($examination->question_delivery == 'random'){
            $questions->shuffle();
        }

        foreach ($questions as $question) {
            $questionCollection[] = $question;
        }

        //set the time this examination started;
        $examinationUser = $examination->examinationUsers()->where('user_id', \Auth::user()->getKey())->first();
        $examinationUser->started_at = Carbon::now();
        $examinationUser->result = 0;
        $examinationUser->status = 'active';
        $examinationUser->save();

        return view('exam.show', compact('examination', 'questions', 'questionCollection'));
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


    public function takeExam($exam_id)
    {


        $examination = Examination::where('id', $exam_id)->first();
        $questions = Question::with('options')->where('examination_id', '=', $exam_id)->get();
//        $questionCollection = $questions->toArray();
        $questionCollection = [];
        //populate question collection with questions
        foreach ($questions as $question) {
            // dd($question->title);
            $questionCollection[] = $question;
        }

        return view('front.examinations.show', compact('examination', 'questions', 'questionCollection'));

    }

    public function viewConfirmCode($id)
    {
		
        //$examination = Examination::find($id);
		\Session::put('auth_code', \Auth::user()->id);
		return redirect('client/examinations/' . $id);

        return view('exam.confirm-code', compact('examination'));
    }

    public function confirmCode($id)
    {
        $examinationUser = ExaminationUser::where('examination_id', $id)->where('user_id',
            \Auth::user()->getKey())->first();
        $user = $examinationUser->user;

        $authCode = \Request::get('auth_code');
//        dd($authCode . " : " . $user->examination_code);

        if ($authCode == $user->examination_code) {
            \Session::put('auth_code', $authCode);
            return redirect('client/examinations/' . $id);
        }
        flash()->error('The authentication key ou supplied is invalid');


        return redirect('client/examinations/confirm/' . $id);

    }

}
