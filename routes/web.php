<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
date_default_timezone_set('Asia/Jakarta');
//frontend route
Route::get('/', 'HomeController@index')->name('home')->middleware('guest:web');

//student route
Route::get('/signin', 'LoginStudentController@index')->name('signin')->middleware('guest:web');
Route::post('/process_signin','LoginStudentController@process_signin')->middleware('guest:web')->name('process_signin');
Route::group(['middleware' => ['auth:student']], function () {
	Route::get('/students', 'Student\StudentFrontController@index')->name('front');
	Route::post('/change_password_students', 'Student\StudentFrontController@change_password_fro_student')->name('change.passwords');
	Route::post('/sign_out', 'LoginStudentController@sign_out')->name('sign_out');
});

//parent route
Route::get('/signin_parent', 'LoginParentController@index')->name('signin_parent')->middleware('guest:web');
Route::post('/process_signin_parent','LoginParentController@process_signin')->middleware('guest:web')->name('process_signin_parent');
Route::group(['middleware' => ['auth:parent']], function () {
	Route::get('/parents', 'Parent\ParentFrontController@index_parent')->name('parents');
	Route::post('/sign_out_parent', 'LoginParentController@sign_out_parent')->name('sign_out_parent');
	Route::post('/process_confirm', 'Parent\ParentFrontController@process_confirm')->name('parents.confirm');

});

//admin login
Route::get('/login', 'LoginController@index')->name('login')->middleware('guest:web');
Route::post('/login/process_login','LoginController@process_login')->middleware('guest:web')->name('user.login');

//teacher login
Route::get('/login_teacher', 'LoginTeacherController@index')->name('login.teacher')->middleware('guest:teacher');
Route::post('/login_teacher/process_login_teacher','LoginTeacherController@process_login_teacher')->middleware('guest')->name('teacher.login');
Route::group(['middleware' => ['auth:teacher']], function () {
	Route::get('teacher/profile', 'Root\TeacherController@teacher_profile')->name('teacher.profile');
	Route::prefix('assignment')->group(function () {
		Route::get('/', 'Root\AssignmentController@index_assignment')->name('assignment');
		Route::post('/show', 'Root\AssignmentController@show_assignment')->name('teacher.assignment.show');
		Route::post('/save', 'Root\AssignmentController@save_assignment')->name('teacher.assignment.store');
		Route::delete('/delete', 'Root\AssignmentController@delete_assignment')->name('teacher.assignment.delete');
		Route::get('/edit/{assignment}', 'Root\AssignmentController@fetch_data_assignment');
		Route::post('/update', 'Root\AssignmentController@update_assignment')->name('teacher.assignment.update');
		Route::get('/delete_file_assignment/{assignment}', 'Root\AssignmentController@delete_file_assignment');
	});
	Route::post('/change_password', 'Root\TeacherController@change_password_teacher')->name('teachers.change.password');
	Route::post('/logouts', 'LoginTeacherController@logout_teacher')->name('logouts');
});

Route::group(['middleware' => ['auth:web','check_access_menu']], function () {
	//common routes
	Route::get('/beranda', 'Root\DashboardController@home')->name('beranda');
	Route::post('/logout', 'LoginController@logout')->name('logout');

	//menu admin routes
	Route::prefix('menu')->group(function () {
		Route::get('/', 'Root\MenuController@index_menu')->name('menu');
		Route::post('/show', 'Root\MenuController@show_menu')->name('menu.show');
		Route::post('/save', 'Root\MenuController@save_menu')->name('menu.store');
		Route::delete('/delete', 'Root\MenuController@delete_menu')->name('menu.delete');
		Route::get('/edit/{menu}', 'Root\MenuController@fetch_data_menu');
		Route::put('/update', 'Root\MenuController@update_menu')->name('menu.update');
	});

	//user admin routes
	Route::prefix('user')->group(function () {
		Route::get('/', 'Root\UserController@index_user')->name('user');
		Route::post('/save', 'Root\UserController@save_user')->name('user.store');
		Route::delete('/{user}/delete', 'Root\UserController@delete_user')->name('user.delete');
		Route::get('/{user}/edit', 'Root\UserController@index_user')->name('user.edit');
		Route::patch('/{user}/update', 'Root\UserController@update_user')->name('user.update');
		Route::post('/change_password', 'Root\UserController@change_password_user')->name('user.change.password');
	});

	//class routes Ready production
	Route::prefix('class')->group(function () {
		Route::get('/', 'Root\ClassController@index_class')->name('class');
		Route::post('/show', 'Root\ClassController@show_class')->name('class.show');
		Route::post('/save', 'Root\ClassController@save_class')->name('class.store');
		Route::delete('/delete', 'Root\ClassController@delete_class')->name('class.delete');
		Route::get('/edit/{class}', 'Root\ClassController@fetch_data_class');
		Route::put('/update', 'Root\ClassController@update_class')->name('class.update');
	});

	//teacher routes
	Route::prefix('teacher')->group(function () {
		Route::get('/', 'Root\TeacherController@index_teacher')->name('teacher');
		Route::post('/show', 'Root\TeacherController@show_teacher')->name('teacher.show');
		Route::post('/save', 'Root\TeacherController@save_teacher')->name('teacher.store');
		Route::delete('/delete', 'Root\TeacherController@delete_teacher')->name('teacher.delete');
		Route::get('/edit/{teacher}', 'Root\TeacherController@fetch_data_teacher');
		Route::post('/update', 'Root\TeacherController@update_teacher')->name('teacher.update');
		Route::post('/change_password', 'Root\TeacherController@change_password_teacher')->name('teacher.change.password');
		Route::get('/delete_profile_picture/{teacher}', 'Root\TeacherController@delete_profile_picture_teacher')->name('teacher.delete_profile_picture');
	});

	//student routes
	Route::prefix('student')->group(function () {
		Route::get('/', 'Root\StudentController@index_student')->name('student');
		Route::post('/show', 'Root\StudentController@show_student')->name('student.show');
		Route::post('/save', 'Root\StudentController@save_student')->name('student.store');
		Route::delete('/delete', 'Root\StudentController@delete_student')->name('student.delete');
		Route::get('/edit/{student}', 'Root\StudentController@fetch_data_student');
		Route::post('/update', 'Root\StudentController@update_student')->name('student.update');
		Route::post('/change_password', 'Root\StudentController@change_password_student')->name('student.change.password');
		Route::get('/delete_profile_picture/{student}', 'Root\StudentController@delete_profile_picture_student')->name('student.delete_profile_picture');
	});

	//parent routes
	Route::prefix('parent')->group(function () {
		Route::get('/', 'Root\ParentController@index_parent')->name('parent');
		Route::post('/show', 'Root\ParentController@show_parent')->name('parent.show');
		Route::post('/save', 'Root\ParentController@save_parent')->name('parent.store');
		Route::delete('/delete', 'Root\ParentController@delete_parent')->name('parent.delete');
		Route::get('/edit/{parent}', 'Root\ParentController@fetch_data_parent');
		Route::put('/update', 'Root\ParentController@update_parent')->name('parent.update');
		Route::post('/change_password', 'Root\ParentController@change_password_parent')->name('parent.change.password');
	});

	//subject routes
	Route::prefix('subject')->group(function () {
		Route::get('/', 'Root\SubjectController@index_subject')->name('subject');
		Route::post('/show', 'Root\SubjectController@show_subject')->name('subject.show');
		Route::post('/save', 'Root\SubjectController@save_subject')->name('subject.store');
		Route::delete('/delete', 'Root\SubjectController@delete_subject')->name('subject.delete');
		Route::get('/edit/{subject}', 'Root\SubjectController@fetch_data_subject');
		Route::put('/update', 'Root\SubjectController@update_subject')->name('subject.update');
	});

	//assign subject teacher routes
	Route::prefix('assign')->group(function () {
		Route::get('/', 'Root\AssignSubjectTeacherController@index_assign_subject_teacher')->name('assign');
		Route::post('/show', 'Root\AssignSubjectTeacherController@show_assign_subject_teacher')->name('assign.show');
		Route::post('/save', 'Root\AssignSubjectTeacherController@save_assign_subject_teacher')->name('assign.store');
		Route::get('/edit/{assign}', 'Root\AssignSubjectTeacherController@fetch_data_assign_subject_teacher');
		Route::put('/update', 'Root\AssignSubjectTeacherController@update_assign_subject_teacher')->name('assign.update');
		Route::delete('/delete', 'Root\AssignSubjectTeacherController@delete_assign_subject_teacher')->name('assign.delete');
	});

	//assign class teacher routes
	Route::prefix('assign_kelas')->group(function () {
		Route::get('/', 'Root\AssignClassTeacherController@index_assign_class_teacher')->name('assign_kelas');
		Route::post('/show', 'Root\AssignClassTeacherController@show_assign_class_teacher')->name('assign.kelas.show');
		Route::post('/save', 'Root\AssignClassTeacherController@save_assign_class_teacher')->name('assign.kelas.store');
		Route::get('/edit/{assign_kelas}', 'Root\AssignClassTeacherController@fetch_data_assign_class_teacher');
		Route::put('/update', 'Root\AssignClassTeacherController@update_assign_class_teacher')->name('assign.kelas.update');
		Route::delete('/delete', 'Root\AssignClassTeacherController@delete_assign_class_teacher')->name('assign.kelas.delete');
	});

	//finance routes
	Route::prefix('finance')->group(function () {
		Route::get('/', 'Root\FinancialController@index_finance')->name('finance');
		Route::post('/show', 'Root\FinancialController@show_finance')->name('finance.show');
		Route::post('/save', 'Root\FinancialController@save_finance')->name('finance.store');
		Route::delete('/delete', 'Root\FinancialController@delete_finance')->name('finance.delete');
		Route::get('/edit/{finance}', 'Root\FinancialController@fetch_data_finance');
		Route::put('/update', 'Root\FinancialController@update_finance')->name('finance.update');
	});

	//confirmation merge with financial controller
	Route::prefix('confirmation')->group(function () {
		Route::get('/', 'Root\FinancialController@index_confirmation')->name('confirmation');
		Route::post('/show', 'Root\FinancialController@show_confirmation')->name('confirmation.show');
		Route::get('/view_confirm/{confirm_id}', 'Root\FinancialController@fetch_data_confirmation');
		Route::put('/update_confirmation', 'Root\FinancialController@update_confirmation_data')->name('confirmation.update');
	});

	//absence routes
	Route::prefix('absence')->group(function () {
		Route::get('/', 'Root\AbsenceController@index_absence')->name('absence');
		Route::post('/show/{class}/{start_date}/{end_date}', 'Root\AbsenceController@show_absence')->name('absence.show');
		Route::post('/save', 'Root\AbsenceController@save_absence')->name('absence.store');
		Route::delete('/delete', 'Root\AbsenceController@delete_absence')->name('absence.delete');
		Route::get('/edit/{absence}', 'Root\AbsenceController@fetch_data_absence');
		Route::put('/update', 'Root\AbsenceController@update_absence')->name('absence.update');
	});

	//event routes
	Route::prefix('event')->group(function () {
		Route::get('/', 'Root\EventController@index_event')->name('event');
		Route::post('/show', 'Root\EventController@show_event')->name('event.show');
		Route::post('/save', 'Root\EventController@save_event')->name('event.store');
		Route::delete('/delete', 'Root\EventController@delete_event')->name('event.delete');
		Route::get('/edit/{event}', 'Root\EventController@fetch_data_event');
		Route::post('/update', 'Root\EventController@update_event')->name('event.update');
		Route::get('/delete_file_event/{event}', 'Root\EventController@delete_file_event')->name('event.delete_file_event');
	});

});
