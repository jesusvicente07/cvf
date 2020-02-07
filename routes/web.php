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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::get('/coordinadores', 'CoordinatorController@coordinators')->name('coordinators');
Route::get('/nuevo/coordinador', 'CoordinatorController@addcoordinators')->name('addcoordinators');
Route::post('/nuevo/coordinador', 'CoordinatorController@store')->name('storecoordinators');
Route::get('/editar/coordinador/{coordinator}', 'CoordinatorController@editcoordinators')->name('editcoordinators');
Route::put('/editar/coordinador/{coordinator}', 'CoordinatorController@updatecoordinators')->name('updatecoordinators');
Route::delete('eliminar/coordinador/{id}', 'CoordinatorController@deletecoordinators')->name('deletecoordinators');


Route::get('/estudiantes', 'StudentController@students')->name('students');
Route::get('/estudiantes/progreso', 'StudentController@studentprogress')->name('studentprogress');

Route::get('/competencias', 'CompetitionController@competitions')->name('competitions');
Route::get('/nueva/competencia', 'CompetitionController@addcompetitions')->name('addcompetitions');
Route::post('/nueva/competencia', 'CompetitionController@store')->name('storecompetitions');
Route::get('/editar/competencia/{competition}', 'CompetitionController@editcompetitions')->name('editcompetitions');
Route::put('/editar/competencia/{competition}', 'CompetitionController@update')->name('updatecompetitions');
Route::delete('eliminar/competencia/{id}', 'CompetitionController@deletecompetitions')->name('deletecompetitions');
Route::delete('eliminar/curso/{id}', 'CompetitionController@deletecourses')->name('deletecourses');

Route::get('/carreras', 'CareerController@careers')->name('careers');
Route::get('/nueva/carrera', 'CareerController@addcareers')->name('addcareers');
Route::post('/nueva/carrera', 'CareerController@store')->name('storecareers');
Route::get('/editar/carrera/{career}', 'CareerController@editcareers')->name('editcareers');
Route::put('/editar/carrera/{career}', 'CareerController@update')->name('updatecareers');
Route::delete('eliminar/carrera/{id}', 'CareerController@deletecareers')->name('deletecareers');
Route::delete('eliminar/carreraT/{id}', 'CareerController@deletetrajectories')->name('deletetrajectories');

Route::get('/trayectorias', 'TrajectorieController@index')->name('trajectories');
Route::get('/nueva/trayectoria', 'TrajectorieController@create')->name('createTrajectories');
Route::post('/nueva/trayectoria', 'TrajectorieController@store')->name('storeTrajectories');
Route::get('/editar/trayectoria/{trajectorie}', 'TrajectorieController@edit')->name('editTrajectories');
Route::put('/editar/trayectoria/{trajectorie}', 'TrajectorieController@update')->name('updateTrajectories');
Route::delete('/eliminar/trayectoria/{trajectorie}', 'TrajectorieController@delete')->name('deleteTrajectories');
Route::delete('/eliminar/detalleTrayectoriaCompetencia/{trajectorie}', 'TrajectorieController@deleteDetailTrajectorieCompetition')->name('deleteDetailTrajectorieCompetition');



