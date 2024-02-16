<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers {
        getLogout as logout;
    }

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     */

    protected $loginPath;
    protected $redirectPath;


    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->middleware('guest', ['except' => 'getLogout']);

    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'identity_no' => 'required',
        ]);

        $credentials = $request->only('identity_no', 'password');

        try {
            $user = User::where('identity_no', $credentials['identity_no'])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->backWithErrors($request, ['identity_no' => 'That Identity number does not exist.']);
        }
        if ($request->exists('student')) {
            $this->redirectPath = "client/examinations";

            return $this->handleStudent($request, $user);
        }

        if ($this->auth->attempt($credentials, false)) {
			if(\Auth::user()->isStudent())
			{
            	$this->redirectPath = "client/examinations";

           		return $this->handleStudent($request, \Auth::user());
			}
			else
			{
				return redirect()->intended($this->redirectPath());
			}
        }

        return $this->backWithErrors($request, ['identity_no' => 'Those credentials do not exist in our records.']);
    }

    /**
     * @param Request $request
     * @param array $failedMessages
     * @return $this
     */
    protected function backWithErrors(Request $request, array $failedMessages)
    {
        return back()
            ->withInput($request->only('identity_no', 'remember'))
            ->withErrors($failedMessages);
    }

    /**
     * @param Request $request
     * @param $user
     * @return AuthController|string
     */
    private function handleStudent(Request $request, $user)
    {
        if ($user->isStudent()) {
            if (!$this->hasSession($user)) {
                $this->auth->login($user);
                $user->session_id = \Session::getId();
                $user->save();

                return redirect()->intended($this->redirectPath());
            }
            flash()->error('You are already logged in on another computer or browser. Logout on the other computer(s) or Contact the administrator.');

            return back();
        }

        return $this->backWithErrors($request,
            ['identity_no' => 'You are not a student. So you cant access the Examinations page']);
    }

    private function hasSession(User $user)
    {
//        dd(\Session::all());
        $sessionId = $user->session_id; // retrive last session

        if ($sessionId && \Auth::check()) {
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        if($this->auth->user()->isStudent()) {
            $this->redirectAfterLogout = "/auth/login-student";
        }

        $this->auth->user()->session_id = null;

        return $this->logout();

    }


    public function postLogout()
    {

        $this->auth->user()->session_id = null;

        return $this->logout();

    }

    /**
     * Displays the login form for students
     * @return \Illuminate\View\View
     */
    public function getLoginStudent()
    {
        return view('auth.loginstudent');
    }

}
