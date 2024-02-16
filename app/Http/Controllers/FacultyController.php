<?php namespace App\Http\Controllers;

use App\Faculty;
use App\Http\Requests\FacultyCreateRequest;

class FacultyController extends Controller
{

    protected $faculty;


    public function __construct(Faculty $faculty)
    {
        $this->faculty = $faculty;
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
        $faculties = Faculty::paginate(50);
        $links = str_replace('/?', '?', $faculties->render());

        return view('admin.faculties.index', compact('faculties', 'links'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
//        $departments = ["" => "Please Select"]+Department::lists('name','id');
        return view('admin.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\requests\UserCreateRequest $request
     *
     * @return Response
     */
    public function store(FacultyCreateRequest $request)
    {
        $faculty = Faculty::create($request->only(array('name', 'code')));

        return redirect('admin/faculties')->with('message', "Faculty created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $faculty = Faculty::find($id);

//        $departments = ["" => "Please select"]+Department::lists('name','id');
        return view('admin.faculties.edit', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $faculty = Faculty::find($id);

//        $departments = ["" => "Please select"]+Department::lists('name','id');
        return view('admin.faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\requests\UserUpdateRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(
        FacultyCreateRequest $request,
        $id
    ) {
        $faculty = Faculty::find($id);
        $faculty->name = $request->get('name');
        $faculty->code = $request->get('code');
        $faculty->save();

        return redirect('admin/faculties')->with('message', "Faculty updated successfully");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::find($id);
        $faculty->delete();

        return redirect('admin/faculties')->with('message', "Faculty deleted successfully");
    }


    public function deleteFaculty($id) {
        return $this->destroy($id);
    }
}
