<?php namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CourseUpdateRequest;


class CourseController extends Controller
{

    protected $course;


    public function __construct(Course $course)
    {
        $this->course = $course;
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
        $courses = Course::all();



        $courses = $courses->sortBy(function ($course) {
            return $course->name;
        });

        return view('admin.courses.index', compact('courses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($department_id = null)
    {
        $departments = Department::lists('name', 'id');

        if ($department_id) {
            $department = Department::where('id', $department_id)->first();

            return view('admin.courses.create', compact('department', 'departments'));
        } else {

            return view('admin.courses.create', compact('departments'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\requests\UserCreateRequest $request
     *
     * @return Response
     */
    public function store(
        CourseCreateRequest $request
    ) {

        $course = Course::create($request->only(array('title', 'department_offering')));
        
        if (\Input::has('redirect_manage')) {
//            return redirect('admin/courses/manage/'.$request->get('department_offering'))->with('message',"Course added successfully");
            return redirect('admin/courses')->with('message', "Course added successfully");
        } else {
            $courses = Course::all();
            $courses = $courses->sortBy(function ($course) {
                return $course->title;
            });

            return redirect('admin/courses')->with('message', "Course added successfully");
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
        $user = User::find($id);

        return view('back.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\requests\UserUpdateRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(
        CourseUpdateRequest $request,
        $id
    ) {
        $course = Course::find($id);
        $course->title = $request->get('title');
        $course->save();

        return redirect('admin/courses')->with('message', "Course Updated successfully");

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $department_offering = $course->department_offering;
        $course->delete();

        return redirect()->back()->with('message', "Course Deleted successfully");
    }


    /**
     * Changed Delete request to get request
     * @param $id
     * @return Response
     */
    public function deleteCourse($id) {
        return $this->destroy($id);
    }

    public function manage($department_id)
    {
        $department = Department::where('id', $department_id)->first();
        $courses = Course::where('department_offering', $department_id)->get();

        return view('admin.courses.manage', compact('department', 'courses'));
    }

}
