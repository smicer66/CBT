<?php namespace App\Http\Controllers;

use App\Examination;
use App\FileUpload;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\UploadQuestionsRequest;
use App\Option;
use App\Question;
use Excel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        \App::abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        \App::abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadQuestionsRequest|Request $request
     * @return Response
     * @throws \Exception
     */
    public function store(UploadQuestionsRequest $request)
    {
        $examinationId = $request->get('examination_id');
        $file = $request->file('questions');

        if (!$this->verifyUploadedSheet($file, $examinationId)) {
            return back();
        }

        $extension = $file->getClientOriginalExtension();
        \Storage::disk('local')->put('/exam_questions/' . $request->get('examination_id') . '/' . time() . '/' . $file->getClientOriginalName() . '.' . $extension,
            \File::get($file));
        $entry = new FileUpload();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $examinationId . ' ' . $file->getClientOriginalName();
        $entry->user_id = \Auth::user()->id;
        $entry->examination_id = $examinationId;
		
        $entry->save();
        $qns_ = Question::where('examination_id', '=', $examinationId)->get();
        foreach($qns_ as $qn){
            Option::where('question_id', '=', $qn->id)->delete();
        }
        Question::where('examination_id', '=', $examinationId)->delete();
        $sheet = Excel::load($request->file('questions'))->noHeading(true)->skip(8);
        $rows = $sheet->get();
        $this->processQuestions($rows, $examinationId);
        flash()->success('Questions uploaded successfully');

        return new RedirectResponse('/admin/exams/' . $request->get('examination_id'));
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
            if (strtoupper($exam->str_verify) == $fileNameArr[1]) {
                return true;
            }
        }
        \Flash::error('The uploaded file does not match this examination. Please download the specified template by clicking the <b>Get Questions template </b> button');

        return false;
    }

    /**
     * @param $row
     * @return void
     */

    /**
     * @param $rows
     * @param $examinationId
     */
    private function processQuestionsOld($rows, $examinationId)
    {
        $question = [];
        $questionOptions = [];
        $questionScores = [];
        $questionTitle = "";
        $optionCollection = [];
        $scoreValue = 0;
        $lastRow = count($rows->all());
        $counter = 0;
		
        foreach ($rows->all() as $row) {
            $counter++;
            $currentOption = $row->get(2);

            if (is_bool($currentOption)) {
                $currentOption = $currentOption ? 'True' : 'False';
            }
            if (is_null($currentOption)) {
                //store all question meta data
                $questionOptions[$questionTitle] = $optionCollection;
                $questionScores[$questionTitle] = $scoreValue;
                $question[] = $questionTitle;
                //empty all arrays
                $optionCollection = [];
                $scoreValue = 0;
                $questionTitle = "";
                continue;
            }

            if ($row->get(1)) {

                $questionTitle = $row->get(1);

                $scoreValue = $row->get(4);

                $optionCollection[$currentOption] = $row->get(3);
            } else {
                $optionCollection[$currentOption] = $row->get(3);
            }

            if ($counter >= $lastRow) {
                $questionOptions[$questionTitle] = $optionCollection;
                $questionScores[$questionTitle] = $scoreValue;
                $question[] = $questionTitle;

            }
        }

        $this->saveQuestions($examinationId, $questionOptions, $questionScores);
    }



    private function processQuestions($rows, $examinationId)
    {
        $question = [];
        $questionOptions = [];
        $questionScores = [];
        $questionTitle = "";
        $optionCollection = [];
        $scoreValue = 0;
        $lastRow = count($rows->all());
        $counter = 0;
        $totalScore = 0;

        foreach ($rows->all() as $row) {
            $counter++;
            $currentOption = $row->get(3);
            //dd($currentOption);

            if (is_bool($currentOption)) {
                $currentOption = $currentOption ? 'True' : 'False';
            }
            if (is_null($currentOption)) {
                //store all question meta data
                $questionOptions[$questionTitle] = $optionCollection;
                $questionScores[$questionTitle] = $scoreValue;
                $question[] = $questionTitle;
                //empty all arrays
                $optionCollection = [];
                $scoreValue = 0;
                $questionTitle = "";
                continue;
            }

            if ($row->get(1) && strtolower($row->get(1))!=strtolower('Type Your Question Here')) {

                $questionTitle = $row->get(1);

                $scoreValue = $row->get(2);
                $totalScore =  $totalScore + $scoreValue;
				
				if(strtolower($row->get(4)) != strtolower('Option 1') && 
					strtolower($row->get(4)) != strtolower('Option 2') && 
					strtolower($row->get(4)) != strtolower('Option 3') && 
					strtolower($row->get(4)) != strtolower('Option 4') && 
					strtolower($row->get(4)) != strtolower('Option 5') && strlen($row->get(4))>1)
				{
                	$optionCollection[$currentOption] = $row->get(4);
				}
            } else {
                if(strtolower($row->get(4)) != strtolower('Option 1') && 
					strtolower($row->get(4)) != strtolower('Option 2') && 
					strtolower($row->get(4)) != strtolower('Option 3') && 
					strtolower($row->get(4)) != strtolower('Option 4') && 
					strtolower($row->get(4)) != strtolower('Option 5') && strlen($row->get(4))>1)
				{
                	$optionCollection[$currentOption] = $row->get(4);
				}
            }

            if ($counter >= $lastRow) {
                $questionOptions[$questionTitle] = $optionCollection;
                $questionScores[$questionTitle] = $scoreValue;
                $question[] = $questionTitle;

            }
        }


        $this->saveQuestions($examinationId, $questionOptions, $questionScores,  $totalScore);
    }


    /**
     * @param $examinationId
     * @param $questionOptions
     * @param $questionScores
     */
    private function saveQuestions($examinationId, $questionOptions, $questionScores, $totalScore)
    {
        $examination = Examination::find($examinationId);
        $examination->maximum_score = $totalScore;
        $examination->save();
		$i = 0;
        foreach ($questionOptions as $title => $options) {
            if (is_null($title) or empty($title)) {
                continue;
            }
            $questionTitle = $title;
            $score = $questionScores[$questionTitle];
            $mQuestion = new Question();
            $mQuestion->title = $questionTitle;
            $mQuestion->examination_id = $examinationId;
            $mQuestion->score_weight = $score;
			if($mQuestion->save())
			{
				$i++;
			}

            foreach ($options as $option => $correct) {
                $mOption = new Option();
                $mOption->title = $option;
                $mOption->question_id = $mQuestion->getKey();
                if (trim(strtolower($correct)) == 'yes') {
                    $mOption->correct_answer = true;
                }
                $mOption->save();
            }
        }
		return $i;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $question = Question::findOrFail($id);
			$questionImage = \App\QuestionImage::where('question_id', '=', $id)->get();
			$options = \App\Option::where('question_id', '=', $id)->lists('id');
			
			$optionImages = \App\OptionImage::whereIn('option_id',  $options)->get();

			
        }
        catch(ModelNotFoundException $e) {
            flash()->error("The question does not exist");

            return back();
        }

        return view('admin.questions.edit', compact('question', 'questionImage', 'optionImages'));
    }



	public function deleteQuestionImage($id)
	{
		$id = \Crypt::decrypt($id);
		$qImage = \App\QuestionImage::where('id', '=', $id)->first();
		$qImage->delete();
		flash()->success("Question Image deleted successfully");
		return back();
	}
	
	
	public function deleteOptionImage($id)
	{
		$id = \Crypt::decrypt($id);
		$qImage = \App\OptionImage::where('id', '=', $id)->first();
		$qImage->delete();
		flash()->success("Option Image deleted successfully");
		return back();
	}

	public function editQuestion()
	{
		$qimage = \Input::file('uploadQuestionImages');
		$ques = \App\Question::where('id', '=', \Input::get('question_id'));
		if($ques->count()>0)
		{
			$ques = $ques->first();
			$ques->title = \Input::get('title');
			$ques->score_weight = \Input::get('score_weight');
			$ques->save();
		
			if(isset($qimage) && !is_null($qimage))
			{
				$fileName = str_random(5);
				$extension = $qimage->getClientOriginalExtension();
				$fileName = $fileName.'.'.$extension;
				$path = public_path('questions');
				//dd($path);
				$qimage->move($path, $fileName);
				$qnImage = new \App\QuestionImage();
				$qnImage->image_url = $fileName;
				$qnImage->question_id = \Input::get('question_id');
	
				$qnImage->save();
			}
			
			
			$arr = explode(',', \Input::get('arr'));
			$correct_keys = array_keys(\Input::get('correct_answers'));
			foreach($arr as $a)
			{
				$file = 'uploadOption'.$a;
				$file_ = \Input::file($file);
				if(isset($file_) && !is_null($file_))
				{
					$fileName = str_random(5);
					$extension = $file_->getClientOriginalExtension();
					$fileName = $fileName.'.'.$extension;
					$path = public_path('options');
					//dd($path);
					$file_->move($path, $fileName);
					$optionImage = \App\OptionImage::where('option_id', '=', $a)->first();
					if($optionImage==NULL)
					{
						$optionImage = new \App\OptionImage();
					}
					$optionImage->image_url = $fileName;
					$optionImage->option_id = $a;
					$optionImage->save();
				}
				
				$option = \App\Option::where('id', '=', $a)->first();
				$opt = 'options';
				$opt1 = \Input::get($opt);
				$option->title = $opt1[$a];
				$option->correct_answer = 0;
				if(in_array($a, $correct_keys))
				{
					$option->correct_answer = 1;
				}
				
				//dd(\Input::get('correct_answers'));
				
				$option->save();
			}
        	flash()->success('Question Updated successfully.');
			$url = ('/admin/exams/'.$ques->examination_id.'/questions');
			///admin/exams/38/questions
			return \Redirect::to($url);
		}
		else
		{
			\Flash::error('Question update was not successful');
			return \Redirect::back();
		}
	}
    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(QuestionRequest $request, $id)
    {
        try {
            $question = Question::findOrFail($id);
        }
        catch(ModelNotFoundException $e) {
            flash()->error("The question does not exist");

            return back();
        }

        //update examination score
        $oldScore = $question->score_weight;
        $newScore = $request->get("score_weight");

        $examination = $question->examination;
        $examOldScore = $examination->maximum_score;

        $examination->maximum_score = $examOldScore - $oldScore + $newScore;
        $examination->save();

        $data = $request->all();
        $question->title = $data['title'];
        $question->score_weight = $data['score_weight'];

        $options = $data['options'];
        $correctAnswers = $data['correct_answers'];
        $question->save();

        foreach ($options as $id => $mOption) {
            $option = Option::find($id);
            $option->title = $mOption;
            $option->correct_answer = false;
            $option->save();
        }
        foreach ($correctAnswers as $id => $correctAnswer) {
            $option = Option::find($id);
            $option->correct_answer = true;
            $option->save();
        }
        flash()->success('Question Updated successfully.');

        return redirect('admin/exams/' . $question->examination->id .'/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $question = Question::destroy($id);
        flash()->success('The Question has been deleted.');

        return back();
    }
}
