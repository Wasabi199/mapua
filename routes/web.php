<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\LogoutControllers;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UpdateUser;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
// });
Route::get('/', function () {
    return Inertia::render('Auth/Login', []);
});

Route::middleware(['auth:sanctum'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::middleware(['auth:sanctum'])->get('/notAuthenticated',[LogoutControllers::class,'perform'])->name('notAuthenticated');
Route::prefix('Admin')->middleware(['auth:sanctum', 'Admin'])->group(function () {

    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('user/register', [AdminController::class, 'userRegister'])->name('registerUser');
    Route::get('user/{id}', [AdminController::class, 'userProfile'])->name('userProfile');
    Route::delete('user/delete', [AdminController::class, 'userDelete'])->name('userDelete');
    Route::post('user/register', [AdminController::class, 'userRegisterSubmit'])->name('registerUserSubmit');
    Route::post('user/update/submit', [AdminController::class, 'userUpdate'])->name('userUpdate');

    Route::post('importUser', [AdminController::class, 'userUpload'])->name('import');
    Route::post('importContributions', [AdminController::class, 'userContributions'])->name('importContributions');
    Route::post('userContributionImport', [AdminController::class, 'userContriImport'])->name('userContriImport');

    Route::get('loansView', [AdminController::class, 'adminLoansView'])->name('adminLoansView');
    Route::get('contributions/{id}', [AdminController::class, 'contributions'])->name('contributions');
    Route::delete('loan/delete', [AdminController::class, 'loanDelete'])->name('loanDelete');
    Route::post('loan/approve', [AdminController::class, 'loanApprove'])->name('loanApprove');
    Route::post('loan/reject', [AdminController::class, 'loanReject'])->name('loanReject');
    Route::post('loan/release', [AdminController::class, 'loanRelease'])->name('loanRelease');
    Route::post('loan/released', [AdminController::class, 'loanReleased'])->name('loanReleased');

    Route::get('Admin/ReimbursementView', [AdminController::class, 'reimbursementView'])->name('ReimbursementView');
    Route::get('Admin/Reimbursement/{id}', [AdminController::class, 'reimbursementProfileView'])->name('ReimbursementProfile');
    Route::post('Admin/Reimbursement/Update', [AdminController::class, 'updateReimbursement'])->name('updateReimbursement');

    // Route::get('contribution/add',[AdminController::class,'addContribution'])->name('addContri');

    Route::post('UpdateBoard', [AdminController::class, 'updateBoards'])->name('updateBoards');

    Route::get('loan/print/{id}', [AdminController::class, 'loanPrint'])->name('printingLoan');

    Route::post('Admin/notification', [NotificationController::class, 'notification'])->name('AdminNotification');

    Route::get('Admin/Archive', [AdminController::class, 'userArchive'])->name('archive');

    Route::delete('user/permanent/delete', [AdminController::class, 'permanentDeleteUser'])->name('permanentDelete');
});


Route::prefix('Users')->middleware(['auth:sanctum', 'Users'])->group(function () {
    Route::get('User/Dashboard', [DashboardController::class, 'userLandingPage'])->name('userDashboard');
    Route::get('User/Loan', [LoansController::class, 'index'])->name('userLoan');
    Route::get('User/LoanDashboard', [LoansController::class, 'loanDashboard'])->name('userLoanDashboard');
    Route::post('Loan/createLoans', [LoansController::class, 'createLoans'])->name('createLoans');

    Route::post('Loan/createLoansWithRelative', [LoansController::class, 'createLoansWithRelative'])->name('createLoansWithRelative');
    Route::get('Loan/View', [LoansController::class, 'loansView'])->name('loansView');
    Route::get('Loan/TotalContribution', [LoansController::class, 'totalContribution'])->name('totalContribution');
    Route::get('Loan/MedicalView', [LoansController::class, 'medicalReimbursment'])->name('medicalView');
    Route::get('Loan/Create/Reimburstment', [LoansController::class, 'createReimburstment'])->name('createReimburstment');
    Route::post('Medical/MedicalReimburstment', [LoansController::class, 'submitCreateReimburstment'])->name('ReimburstmentSubmit');
    Route::get('User/Loan/View/{id}', [LoansController::class, 'UserLoanView'])->name('UserLoanView');
    Route::get('User/MedicalButton', [LoansController::class, 'ReimbursView'])->name('ReimbursView');
    Route::get('User/MedicalBreakdown/{id}', [LoansController::class, 'MedicalBreakdown'])->name('MedicalBreakdown');
    //    Route::post('Loan/RelativeEducational',[LoansController::class,'relativeEducational'])->name('relativeEducational');

    Route::post('Loan/Emergency', [LoansController::class, 'createEmergencyLoan'])->name('emergency');
    Route::post('Loan/Educational', [LoansController::class, 'createEducationalLoan'])->name('educational');
    Route::post('User/notification', [NotificationController::class, 'notification'])->name('UserNotification');
});


Route::prefix('Medical')->middleware(['auth:sanctum', 'Medical'])->group(function () {
    Route::get('Medical/List', [MedicalController::class, 'index'])->name('medicalList');
    Route::get('Medical/{id}', [MedicalController::class, 'medicalProfile'])->name('medicalProfile');
    Route::post('Medical/Approve', [MedicalController::class, 'medicalApprove'])->name('medicalApprove');
    Route::post('Medical/Reject', [MedicalController::class, 'medicalReject'])->name('medicalReject');

    Route::post('Medical/notification', [NotificationController::class, 'notification'])->name('MedicalNotification');

    Route::get('Medical/Printing/{id}', [MedicalController::class, 'reimbursemetPrint'])->name('ReimburstmentPrintng');
});
Route::prefix('Chairman')->middleware(['auth:sanctum', 'Chairman'])->group(function () {
    // Route::get('Chairman')
});
