<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
	
	return redirect('auth/login-student');
});
Route::get('home', 'HomeController@index');

Route::post('/logout', 'Auth\AuthController@logout');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


// Admin Exams Routes


Route::get('admin/exams/{exams}/set', 'AdminExaminationsController@getSet');
Route::post('admin/exams/{exams}/set', 'AdminExaminationsController@postSet');
Route::get('admin/exams/{exams}/end', 'AdminExaminationsController@end');
Route::patch('admin/exams/{exams}/end', ['uses' => 'AdminExaminationsController@endExamination', 'as' => 'admin.exams.endexam']);
Route::get('admin/exams/{exams}/delete', 'AdminExaminationsController@deleteExamination');
Route::get('admin/exams/{exams}/archive', 'AdminExaminationsController@archive');
Route::get('admin/exams/{exams}/questions/upload', 'AdminExaminationsController@uploadQuestions');
//Route::get('admin/exams/{exams}/questions/upload', 'AdminExaminationsController@stepone');
Route::get('admin/exams/{exams}/questions', 'AdminExaminationsController@questions');
Route::get('admin/exams/{exams}/template', 'AdminExaminationsController@template');
Route::get('admin/exams/{exams}/results', ['uses' => 'AdminExaminationsController@downloadResultSheet', 'as' => 'admin.exams.results.download']);
Route::get('admin/exams/{exams}/class/template', 'AdminClassController@classTemplate');
Route::get('admin/exams/{exams}/class/step0', 'AdminClassController@stepzero');
Route::get('admin/exams/{exams}/class/upload', 'AdminClassController@upload');
Route::get('admin/exams/{exams}/{student_id}/deleteCandidate', 'AdminClassController@deleteCandidate');
//Route::get('admin/exams/{exams}/class/steptwo', 'AdminClassController@steptwo');
Route::post('admin/exams/{exams}/class/step2', 'AdminClassController@steptwo' );
Route::post('admin/exams/{exams}/class/step3', 'AdminClassController@stepthree');
Route::post('admin/exams/{exams}/class/step4', 'AdminClassController@stepfour');
Route::post('admin/exams/{exams}/class/examresults', 'AdminExaminationsController@examresults');

Route::get('admin/exams/{exams}/getFacultiesView', 'AdminClassController@getFacultiesView');
Route::resource('/admin/exams/{exams}/class', 'AdminClassController');
Route::resource('/admin/exams/questions', 'QuestionsController');
Route::controller('admin/dashboard', 'AdminDashboardController');
Route::post('admin/exams/new/step2', 'AdminExaminationsController@step2');
Route::post('admin/exams/new/step3', 'AdminExaminationsController@step3');
Route::resource('admin/exams', 'AdminExaminationsController');


//courses,departments,faculties,users entities management

Route::group(array('prefix' => 'admin'), function () {
    Route::get('users/students/{student}/delete', ['as' => 'admin.users.students.delete', 'uses' => 'StudentController@deleteStudent']);
    Route::resource('users/students','StudentController');
    Route::get('users/createMasterList', 'UserController@getCreateMasterList');
    Route::get('users/template', 'UserController@getTemplate');
    Route::post('users/template', ['as' => 'admin.users.template', 'uses' => 'UserController@storeTemplate']);
    Route::get('users/{user}/delete', ['as' => 'admin.users.delete', 'uses' => 'UserController@deleteUser']);
    Route::resource('users', 'UserController');
    Route::get('courses/{department_id}/delete', ['as' => 'admin.courses.delete', 'uses' => 'CourseController@deleteCourse']);
    Route::get('courses/manage/{department_id}', ['as' => 'admin.courses.manage', 'uses' => 'CourseController@manage']);
    Route::get('courses/create/{department_id}', ['as' => 'admin.courses.create', 'uses' => 'CourseController@create']);
    Route::resource('courses', 'CourseController');

    Route::get('departments/manage/{faculty_id}',
        ['as' => 'admin.departments.manage', 'uses' => 'DepartmentController@manage']);

    Route::get('departments/create/{faculty_id}',
        ['as' => 'admin.departments.create', 'uses' => 'DepartmentController@create']);


    Route::get('departments/{department_id}/delete',
        ['as' => 'admin.departments.delete', 'uses' => 'DepartmentController@deleteDepartment']);
    Route::resource('departments', 'DepartmentController');


    Route::get('faculties/{faculty_id}/delete', ['as' => 'admin.faculties.delete', 'uses' => 'FacultyController@deleteFaculty']);
    Route::resource('faculties', 'FacultyController');

    Route::resource('results', 'ResultsController');

	Route::get('class/step-one/{x?}', 'ClassController@getStepOne');
	Route::get('class/step-two/{x}/{y?}', 'ClassController@getStepTwo');
	Route::get('class', 'ClassController@getView');
	Route::get('class/delete-class/{x}', 'ClassController@getDeleteClass');
	Route::get('class/delete-arm/{x}/{y}', 'ClassController@getDeleteClassArm');
	Route::post('class/store-step-one', 'ClassController@postStepOne');
	Route::post('class/store-step-two', 'ClassController@postStepTwo');
	
	Route::post('question/edit-question', 'QuestionsController@editQuestion');
	Route::get('exams/questions/deleteoptionimage/{x}', 'QuestionsController@deleteOptionImage');
	Route::get('exams/questions/deleteimage/{x}', 'QuestionsController@deleteQuestionImage');
	Route::get('results/refreshcandidates/{x}', 'AdminExaminationsController@refeshCandidates');

});

//examinations

Route::group(array('prefix' => 'client'), function () {
    Route::get('examinations/submit/{exam_id}',
        ['as' => 'client.examinations.submit', 'uses' => 'ExamController@submitExam']);
    Route::get('examinations/confirm/{exam_id}',
        ['as' => 'client.examinations.confirm', 'uses' => 'ExamController@viewConfirmCode']);
    Route::post('examinations/confirm-code/{exam_id}',
        ['as' => 'client.examinations.confirm-code', 'uses' => 'ExamController@confirmCode']);

    Route::get('examinations/take/{exam_id}',
        ['as' => 'client.examinations.take', 'uses' => 'ExamController@takeExam']);
//    Route::get('examinations/list/{user_id}',
//        ['as' => 'client.examinations.list', 'uses' => 'ExamController@getExamlist']);
    Route::resource('examinations', 'ExamController');

});
