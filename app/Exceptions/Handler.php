<?php namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
     * @param  \Exception $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
        if ($e instanceof NotFoundHttpException OR $e instanceof ModelNotFoundException) {
            flash()->error('The page you requested does not exist');
            return back();
        }
        if ($e instanceof TokenMismatchException) {
            flash()->error('A session error occurred. Please retry your request.');
            return back();
        }
		else
		{
			if($e!=NULL)
			{
				dd($e);
			}
		}
        flash()->error('An error occurred');
        return back();

		return parent::render($request, $e);
	}

}
