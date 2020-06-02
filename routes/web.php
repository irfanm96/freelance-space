<?php

use App\Project;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::view('dashboard', 'dashboard');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/project/webhook/sprint_backlog/{project}',function(Project $project){
    ld('project.webhook.sprint_backlog');
    ld(request()->all());
})->name('project.webhook.sprint_backlog');

Route::post('/project/webhook/in_progress/{project}', function (Project $project) {
    ld('project.webhook.in_progress');
    ld(request()->all());
})->name('project.webhook.in_progress');

Route::post('/project/webhook/in_staging/{project}', function (Project $project) {
    ld('project.webhook.in_staging');
    ld(request()->all());
})->name('project.webhook.in_staging');

Route::post('/project/webhook/in_production/{project}', function (Project $project) {
    ld('project.webhook.in_production');
    ld(request()->all());
})->name('project.webhook.in_production');