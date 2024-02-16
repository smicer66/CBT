<?php namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Level;
use App\Role;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    protected $user;


    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
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
        $users = User::where('role_id',13)->orWhere('role_id',2)->whereNull('deleted_at')->paginate(50);

        //        dd($users);

        $links = str_replace('/?', '?', $users->render());

        return view('admin.users.index', compact('users', 'links'));
    }


    /*public function createNewUserAdmin()
    {
        $user = new User();
        $user->first_name = "James";
        $user->last_name = "Peter";
        $user->identity_no = "admin@glistenschools.com";
//        $user->role_id = $request->get('role_id');
        $role = Role::where('id', 1)->first();
        if ($role->name !== "student") {
            $password = substr(str_shuffle(MD5(microtime())), 0, 9);
            $user->password = Hash::make("password");
            flash('Password = <b>' . $password . '</b>');
        }
        $user->role_id = $role->id;
        $user->save();
        $user->attachRole($role);
    }*/


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $r = Role::where('name', '!=', 'student')->get();
        $roles = ["" => "Please Select"] + $r->lists('name', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->identity_no = $request->get('identity_no');
//        $user->role_id = $request->get('role_id');
        $role = Role::where('id', $request->get('role_id'))->first();
        if ($role->name !== "student") {
            $password = substr(str_shuffle(MD5(microtime())), 0, 9);
            $user->password = Hash::make($password);
            flash('Password = <b>' . $password . '</b>');
        }
        $user->role_id = $role->id;
        $user->save();
        $user->attachRole($role);

        return redirect('admin/users')->with('message', "User created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e) {
            flash()->error("The user does not exist");
            return back();
        }

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
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param  int $id
     * @return Response
     * @internal param $ App\requests\User
     * pdateRequest|UserUpdateRequest $request
     */
    public function update(
        UserUpdateRequest $request,
        $id
    ) {
        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->identity_no = $request->get('identity_no');
        $user->save();

        return redirect('admin/users')->with('message', "User updated successfully");
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
            $user = User::findOrFail($id);
        }
        catch(ModelNotFoundException $e) {
            flash()->error("The user does not exist");
            return back();
        }
        $user->delete();

        return redirect('admin/users')->with('message', "User deleted successfully");
    }

    public function deleteUser($id)
    {
        return $this->destroy($id);
    }


    public function getTemplate()
    {
		
        Excel::create('Master_Users_Template',
            function ($excel){
                $excel->sheet('Users', function ($sheet) {
                    $sheet->freezeFirstColumn();
					$sheet->setStyle(array(
						'td' => array(
							'width' => '500px'
						)
					));
					$classes = \App\Classes::with(array('class_arm' => function($x){
						$x->orderBy('arm_name');
					}))->orderBy('name')->get();
                    $sheet->loadView('admin.users.template', array('classes'=>$classes));
                });
            })->download('xls');    }


    public function storeTemplate()
    {
        $sheet = Excel::load(\Input::file('users'))->noHeading(true)->skip(2);
        $rows = $sheet->get();
		
        foreach($rows as $row){
			//dd($row);
            $regno = $row->get(1);
            if(!isset($regno) or trim($regno) == ""){
                continue;
            }
            $user = User::where('identity_no',$regno)->first();
            if(!is_null($user)){
                continue;
            }

//            $dept = \DB::table('departments')->where()->get();
            $class = \App\Classes::where('name', '=', $row->get(4))->first();
			//dd($dept);

//            $level = \DB::table('levels')->where('name', '=', (int) $row->get(6))->get();
            $classArm = \App\ClassArms::where('arm_name', '=', $row->get(5))->first();
//dd($row);
            if(isset($class) && $class!=null && isset($classArm) && $classArm!=null) {
				
                // if(true && isset($level) && $level!=null)
                $role = Role::where('name', 'student')->first();
                $attributes = [
                    'role_id' => $role->id,
                    'identity_no' => $row->get(1),
                    'first_name' => $row->get(2),
                    'last_name' => $row->get(3),
                    'class_id' => $class->id,
                    'class_arm_id' => $classArm->id,
					'password' => \Hash::make('password')
                ];
				
                $user = User::create($attributes);
                $user->attachRole($role);
            }
        }

        flash()->success('Users uploaded successfully');
        return redirect('admin/users/students');
    }

    public function getCreateMasterList()
    {
        return view('admin.users.uploadusers');
    }

}
