<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

// ── Auth ──
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('admin.admin-dashboard');
})->name('dashboard');

Route::get('/joborder/dashboard', function () {
    return view('joborder.joborder-dashboard');
})->name('joborder.dashboard');

Route::get('/joborder/payslip', function () {
    return view('joborder.joborder-payslip');
})->name('joborder.payslip');

Route::get('/joborder/attendance', function () {
    return view('joborder.joborder-attendance');
})->name('joborder.attendance');

Route::get('/joborder/training', function () {
    return view('joborder.joborder-training');
})->name('joborder.training');

Route::get('/joborder/leave', function () {
    return view('joborder.joborder-leave');
})->name('joborder.leave');

Route::get('/joborder/profile', function () {
    return view('joborder.joborder-profile');
})->name('joborder.profile');

Route::get('/joborder/performance', function () {
    return view('joborder.joborder-performance');
})->name('joborder.performance');

Route::get('/joborder/settings', function () {
    return view('joborder.joborder-settings');
})->name('joborder.settings');

Route::get('/permanent/dashboard', function () {
    return view('permanent.permanent-dashboard');
})->name('permanent.dashboard');

Route::get('/permanent/payslip', function () {
    return view('permanent.permanent-payslip');
})->name('permanent.payslip');

Route::get('/permanent/attendance', function () {
    return view('permanent.permanent-attendance');
})->name('permanent.attendance');

Route::get('/permanent/leave', function () {
    return view('permanent.permanent-leaveandbenefits');
})->name('permanent.leave');

Route::get('/permanent/training', function () {
    return view('permanent.permanent-training');
})->name('permanent.training');

Route::get('/permanent/performance', function () {
    return view('permanent.permanent-performance');
})->name('permanent.performance');

Route::get('/permanent/profile', function () {
    return view('permanent.permanent-profile');
})->name('permanent.profile');

Route::get('/permanent/settings', function () {
    return view('permanent.permanent-settings');
})->name('permanent.settings');

Route::get('/recruitment', function () {
    return view('admin.admin-recruitment');
})->name('recruitment');

Route::post('/recruitment', function () {
    return back()->with('success', 'Job posting saved.');
})->name('recruitment.store');

Route::get('/password/forgot', function () {
    return view('user.forgot-password');
})->name('password.forgot');

// ── Signup ──
Route::get('/signup', function () {
    return view('user.signup');
})->name('signup');

Route::post('/signup', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'first_name'       => ['required', 'string', 'max:100'],
        'last_name'        => ['required', 'string', 'max:100'],
        'employee_id'      => ['required', 'string', 'max:50'],
        'employment_type'  => ['required', 'in:Permanent,Job Order'],
        'position'         => ['required', 'string', 'max:100'],
        'email'            => ['required', 'email', 'unique:users,email'],
        'password'         => ['required', 'min:4', 'confirmed'],
    ]);

    return back()
        ->with('signup_success', true)
        ->with('signup_name',  $data['first_name'] . ' ' . $data['last_name'])
        ->with('signup_email', $data['email'])
        ->with('signup_type',  $data['employment_type']);
})->name('signup.post');

Route::get('/personnel', function () {
    return view('admin.admin-personnel');
})->name('personnel');

Route::post('/personnel', function () {
    return back()->with('success', 'Employee record saved.');
})->name('personnel.store');

Route::get('/attendance', function () {
    return view('admin.admin-attendance');
})->name('attendance');

Route::get('/performance', function () {
    return view('admin.admin-performance');
})->name('performance');

Route::get('/training', function () {
    return view('admin.admin-training');
})->name('training');

Route::post('/training', function () {
    return back()->with('success', 'Training program saved.');
})->name('training.store');

Route::get('/leave', function () {
    return view('admin.admin-leaveandbenefits');
})->name('leave');

Route::get('/payroll', function () {
    return view('admin.admin-payroll');
})->name('payroll');

Route::get('/departments', function () {
    return view('admin.admin-departments');
})->name('departments');

Route::get('/reports', function () {
    return view('admin.admin-reports');
})->name('reports');

Route::get('/settings', function () {
    return view('admin.admin-settings');
})->name('settings');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
