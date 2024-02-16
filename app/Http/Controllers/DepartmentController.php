<?php namespace App\Http\Controllers;

use App\Department;
use App\Faculty;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{

    protected $department;


    public function __construct(Department $department)
    {
        $this->department = $department;
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
        $departments = Department::all();
        $departments = $departments->sortBy(function ($department) {
            return $department->faculty->name;
        });

        return view('admin.departments.index', compact('departments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($faculty_id = null)
    {
        if ($faculty_id) {
            $faculty = Faculty::where('id', $faculty_id)->first();
            return view('admin.departments.create', compact('faculty'));
        } else {
            $faculties = ["" => "Please Select"] + Faculty::lists('name', 'id');

            return view('admin.departments.create', compact('faculties'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\requests\UserCreateRequest $request
     *
     * @return Response
     */
    public function store(DepartmentCreateRequest $request)
    {
        $department = Department::create($request->only(array('name', 'faculty_id')));
        if (\Input::has('redirect_manage')) {
//            return redirect('admin/departments/manage/'.$request->get('faculty_id'))->with('message',"Department added successfully");
            return redirect('admin/departments')->with('message', "Department added successfully");
        } else {
            $departments = Department::all();
            $departments = $departments->sortBy(function ($department) {
                return $department->faculty->name;
            });

            return view('admin.departments.index', compact('departments'))->with('message',
                'Department Created Successfully');
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
        $department = Department::find($id);
        $faculties = ["" => "Please select"] + Faculty::lists('name', 'id');

        return view('admin.departments.edit', compact('department', 'faculties'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        $faculties = ["" => "Please select"] + Faculty::lists('name', 'id');

        return view('admin.departments.edit', compact('department', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\requests\UserUpdateRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(
        DepartmentUpdateRequest $request,
        $id
    ) {
        $department = Department::find($id);
        $department->name = $request->get('name');
        $department->faculty_id = $request->get('faculty_id');
        $department->save();
//        $departments = Department::where('faculty_id',$request->get('original_faculty_id'));
//        return redirect('admin/departments/manage/'.$request->get('original_faculty_id'))->with('message',"Department updated successfully");
        return redirect('admin/departments')->with('message', "Department updated successfully");

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $faculty_id = $department->faculty_id;
        $department->delete();
//        $departments = Department::where('faculty_id',$faculty_id);
//        return redirect('admin/departments/manage/'.$faculty_id)->with('message',"Department deleted successfully");
        return redirect()->back()->with('message', "Department deleted successfully");
    }

    public function deleteDepartment($id) {
        return $this->destroy($id);
    }

    public function manage($faculty_id)
    {
        $faculty = Faculty::where('id', $faculty_id)->first();
        $departments = Department::where('faculty_id', $faculty_id)->get();
        if ($departments and $departments->count() > 0) {
            return view('admin.departments.manage', compact('departments', 'faculty_id', 'faculty'));
        } else {
            return view('admin.departments.manage', compact('departments', 'faculty_id', 'faculty'))->with('message',
                'This faculty does not have any departments at this time');
        }
    }

}
