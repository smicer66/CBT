<?php namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use App\Http\Requests;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students = User::where('role_id', 3)->with('class_')->with('classArm')->paginate(200);

        $links = str_replace('/?', '?', $students->render());

        return view('admin.students.index', compact('students', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //$levels = ["" => "Please Select"] + DB::table('levels')->lists('name', 'id');
		$classes = \App\Classes::with(array('class_arm' => function($x){
			$x->orderBy('arm_name');
		}))->orderBy('name')->get();
		$levels = array();
		foreach($classes as $c)
		{
			foreach($c->class_arm as $c1)
			{
				$levels[$c1->id."|||".$c->id] = $c->name." ".$c1->arm_name;
			}
		}
        return view('admin.students.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreateStudentRequest $request)
    {
        $role = Role::where('name', 'student')->first();
		$student = new User();
		try{
			$student->first_name = $request->get('first_name');
			$student->last_name = $request->get('last_name');
			$student->identity_no = $request->get('identity_no');
			$student->password = \Hash::make(env('password'));
			$student->role_id = $role->id;
			$student->class_arm_id = explode('|||', $request->get('level'))[0];
			$student->class_id = explode('|||', $request->get('level'))[1];

			$student->save();
	
	
			return redirect('admin/users/students')->with('message', 'Student created successfully');
		}catch(Exception $e)
		{
			return \Redirect::back()->with('error', 'Student account could not be created successfully. Ensure the identity number you provided has not been used by another school');
		}
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
        $student = User::where('id', $id)->first();
        $classes = \App\Classes::with(array('class_arm' => function($x){
			$x->orderBy('arm_name');
		}))->orderBy('name')->get();
		$levels = array();
		foreach($classes as $c)
		{
			foreach($c->class_arm as $c1)
			{
				$levels[$c1->id."|||".$c->id] = $c->name." ".$c1->arm_name;
			}
		}

        return view('admin.students.edit', compact('student', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Requests\EditStudentRequest $request, $id)
    {
        $student = User::where('id', '=', $id)->first();
		$student->first_name = $request->get('first_name');
		$student->last_name = $request->get('last_name');
		$student->identity_no = $request->get('identity_no');
		$student->class_arm_id = explode('|||', $request->get('level'))[0];
		$student->class_id = explode('|||', $request->get('level'))[1];

		$student->save();

        return redirect('admin/users/students')->with('message', 'Student Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect('admin/users/students')->with('message', 'Student deleted successfully');
    }

    public function deleteStudent($id)
    {
        return $this->destroy($id);
    }
}
