<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array,
		'App\Http\Middleware\VerifyCsrfToken'
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'App\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
        'student' => 'App\Http\Middleware\CheckStudentRole',
        'examiner' => 'App\Http\Middleware\CheckExaminerRole',
        'admin' => 'App\Http\Middleware\CheckAdminRole',
        'staff' => 'App\Http\Middleware\CheckStaffRole',
	];

}
