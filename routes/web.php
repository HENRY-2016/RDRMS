<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DivesController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\SafetyController;
use App\Http\Controllers\StudentsController;

use App\Models\AdminModel;
use App\Models\CoursesModel;
use App\Models\EquipmentsModel;
use App\Models\DivesModel;
use App\Models\StudentsModel;
use App\Models\InstructorsModel;
use App\Models\SafetyModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// migrate db tables
Route::get('/migrate', function(){
    Artisan::call('migrate'); 
    dd('Migrations Done!');
});

//Clear route cache:
Route::get('/cache-clear', function() {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache cleared';
}); 

// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache cleared';
});

 //Clear route cache:
Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache cleared';
}); 








Route::get('/', function () {return view('welcome');});

// Logins
Route::get('/students/login', function () {return view('login/students');});
Route::get('/admin/login', function () {return view('login/admin');});
Route::get('/instructors/login', function () {return view('login/instructors');});

// Route::post('users/user/login',[UserAuthenticationController ::class,'userLogIn']);
Route::post('users/admin/login',[UserAuthenticationController ::class,'adminLogIn']);
Route::post('users/students/login',[UserAuthenticationController ::class,'studentsLogIn']);
Route::post('users/instructors/login',[UserAuthenticationController ::class,'instructorsLogIn']);


// Log out
Route::get('users/admin/logout', function () 
{
    if (session()->has('user')){session()->pull('user');}
    return redirect('/admin/login');
});

Route::get('users/students/logout', function () 
{
    if (session()->has('user')){session()->pull('user');}
    return redirect('/students/login');
});

Route::get('users/instructors/logout', function () 
{
    if (session()->has('user')){session()->pull('user');}
    return redirect('/instructors/login');
});


// Admin

Route::get('/components/admin', function () 
{
    if (session()->has('user')) {
        $data = AdminModel::latest()->get();
        $total = AdminModel::count();

        return view('components/admin', compact('data','total'));
    }
    return view('welcome');
});

Route::get('/components/instructors', function () 
{
    if (session()->has('user')) {
        $data = InstructorsModel::latest()->get();
        $total = InstructorsModel::count();

        return view('components/instructors', compact('data','total'));
    }
    return view('welcome');
});
Route::get('/components/students', function () 
{
    if (session()->has('user')) {
        $data = StudentsModel::latest()->get ();
        $total = StudentsModel::count();
        $courses = CoursesModel::get(['Name']);
        return view('components/students', compact('data','total','courses'));
    }
    return view('welcome');
});
Route::get('/components/courses', function () 
{
    if (session()->has('user')) {
        $data = CoursesModel::latest()->get ();
        $total = CoursesModel::count();
        return view('components/courses', compact('data','total'));
    }
    return view('welcome');
});
Route::get('/components/safety', function () 
{
    if (session()->has('user')) {
        $data = SafetyModel::latest()->get ();
        $total = SafetyModel::count();
        return view('components/safety', compact('data','total'));
    }
    return view('welcome');
});

Route::get('/components/dives', function () 
{
    if (session()->has('user')) {
        $data = DivesModel::latest()->get ();
        $total = DivesModel::count();
        $instructors = InstructorsModel::get(['id']);
        $equipments = EquipmentsModel::get(['id']);
        return view('components/dives', compact('data','total','instructors','equipments'));
    }
    return view('welcome');
});


Route::get('/components/dives/{viewType?}/{keyId?}',[DivesController::class,'viewDives']);
Route::get('/components/student/{viewType?}/{keyId?}',[StudentsController::class,'viewStudent']);



Route::get('/components/dives/students/', function () 
{
    if (session()->has('user')) {
        $data = DivesModel::where ('Student','1')->get ();
        $total = DivesModel::count();
        $instructors = InstructorsModel::get(['id']);
        $equipments = EquipmentsModel::get(['id']);
        return view('components/dives', compact('data','total','instructors','equipments'));
    }
    return view('welcome');
});

Route::get('/components/equipments', function () 
{
    if (session()->has('user')) {
        $data = EquipmentsModel::latest()->get ();
        $total = EquipmentsModel::count();
        return view('components/equipments', compact('data','total'));
    }
    return view('welcome');
});

Route::get('get/course/amount/{name}',[StudentsController::class,'getCourseAmount']);


// resources
Route::resource('AdminResource',AdminController::class);
Route::resource('DivesResource', DivesController::class);
Route::resource('SafetyResource',SafetyController::class);
Route::resource('CoursesResource',CoursesController::class);
Route::resource('StudentsResource',StudentsController::class);
Route::resource('EquipmentsResource',EquipmentsController::class);
Route::resource('InstructorsResource',InstructorsController::class);



