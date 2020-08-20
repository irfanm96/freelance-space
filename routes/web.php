<?php

use App\Invoice;
use App\Notifications\ContactFormNotification;
use App\Project;
use App\User;
use Illuminate\Http\Request;
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
})->name('index');
Auth::routes();

Route::get('/invoice/pdf/{id}', function ($id) {
    $invoice = Invoice::where('id', $id)->with('tasks', 'project')->first();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadView("invoice-templates.template$invoice->template", ['invoice' => $invoice, 'iframe' => false]);
    return $pdf->stream('invoice.pdf');
})->name('invoice.pdf');

Route::view('dashboard', 'dashboard');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/project/webhook/sprint_backlog/{project_id}', 'TaskController@handleSprintBacklogList')->name('project.webhook.sprint_backlog');
Route::post('/project/webhook/in_progress/{project_id}', 'TaskController@handleInProgressList')->name('project.webhook.in_progress');
Route::post('/project/webhook/in_staging/{project_id}', 'TaskController@handleInStagingList')->name('project.webhook.in_staging');
Route::post('/project/webhook/in_production/{project_id}', 'TaskController@handleInProductionList')->name('project.webhook.in_production');

Route::post('/project/webhook/in_production/{project}', function (Project $project) {
    ld('project.webhook.in_production');
    ld(request()->all());
    return response('ok')->setStatusCode(200);
})->name('project.webhook.in_production');

Route::get('/project/webhook/sprint_backlog/{project}', function (Project $project) {
    return response('ok')->setStatusCode(200);
})->name('project.webhook.sprint_backlog');

Route::get('/project/webhook/in_progress/{project}', function (Project $project) {
    return response('ok')->setStatusCode(200);
})->name('project.webhook.in_progress');

Route::get('/project/webhook/in_staging/{project}', function (Project $project) {
    return response('ok')->setStatusCode(200);
})->name('project.webhook.in_staging');

Route::get('/project/webhook/in_production/{project}', function (Project $project) {
    return response('ok')->setStatusCode(200);
})->name('project.webhook.in_produNotification Actionr@index')->name('home');

Route::post('/contact-us', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email:rfc,dns',
        'message' => 'required|min:10',
        'phone' => 'required',
        'name' => 'required|min:3'
    ]);
    $admin = User::whereEmail('irfanmm96@gmail.com')->first();
    $admin->notify(new ContactFormNotification($data));
    session()->flash('contactSuccess', 'Your response is saved, you will get notified soon');
    return redirect()->route('index');
})->name('contact');
