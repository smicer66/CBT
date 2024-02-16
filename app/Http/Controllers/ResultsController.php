<?php namespace App\Http\Controllers;

use App\Examination;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ResultsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$examinations = Examination::all();
        return view('admin.results.index', compact('examinations'));
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
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try {
            $examination = Examination::findOrFail($id);
        }
        catch(ModelNotFoundException $e) {
            flash()->error("Page not found");
            return back();
        }
        $candidates = $examination->examinationUsers;

        $candidates = $candidates->filter(function($exam_user){
            if($exam_user->user){
                return true;
            }
        });
        return view('admin.results.show', compact('examination', 'candidates'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
