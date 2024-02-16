<?php namespace App\Http\Controllers;

use App\Examination;
use App\Http\Requests;
use App\Role;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    /**
     *
     */
    public function getIndex()
    {
        $examinations = Examination::where('status', 'active')->get();
        $students = Role::where('name', 'student')->first()->users->where('session_id', '!=', null)->all();

        return view('admin.dashboard.index', compact('examinations', 'students'));
    }

}
