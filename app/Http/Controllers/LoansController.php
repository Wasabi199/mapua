<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Helpers\ReimbursementHelper;
use App\Http\Requests\EducationalLoanRequest;
use App\Http\Requests\ForRelativeRequest;
use App\Http\Requests\HousingLoanRequest;
use App\Http\Requests\LoanRequest as request;
use App\Http\Requests\MedicalReimbursmentRequest as medicalRequest;
use App\Http\Requests\EmergencyLoanRequest as emergencyReqest;
use App\Http\Requests\EducationalLoanRequest as educationalRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\{Loans, Medical, User, Admin, UserNotifications, Contributions};
use Illuminate\Support\Facades\Redirect;
use Tightenco\Ziggy\Output\Script;
use App\Services\Approval;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request as query;



class LoansController extends Controller
{
    //
    public function index()
    {
        $id = auth()->id();
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $user = User::with('adminReg')->find($id);
        return Inertia::render('Users/UserLoanPage', [
            'users' => $user,
            'notification' => $userNotification,
            'count' => $notificationCount
        ]);
    }
    // Loans View
    public function loansView(query $query)
    {
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $user = Auth::user();
        $loans = Loans::with('contributions')->filterOwner($user->id)
            ->limit(5)
            ->orderByRaw('created_at DESC')
            ->paginate(5)
            ->appends($query::only(auth()->id()));

        return Inertia::render('Users/LoanView', [
            'loans' => $loans,
            'notification' => $userNotification,
            'count' => $notificationCount,

        ]);
    }
    // Total Contribution
    public function totalContribution(query $query)
    {
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $id = auth()->id();
        //$loans = Loans::with('contributions')->find($id);
        $loans = Loans::find($id);
        $contributions = Contributions::where('loans_id', '=', $loans->id)
            //->filterOwner($user->id)
            ->limit(5)
            ->paginate(5);
        //->appends($query::only(auth()->id()));

        return Inertia::render('Users/TotalContribution', [
            'loans' => $loans,
            'contributions' => $contributions,
            'notification' => $userNotification,
            'count' => $notificationCount
        ]);
    }


    public function createLoans(request $request)
    {
        // dd($request);
        $validate_data = $request->validated();

        $user = User::find(auth()->id());
        if (Loans::where('user_id', $user->id)->where('loan_type', 'Educational Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {
            return Redirect::route('userLoanDashboard')->with(
                'message',
                [NotificationService::notificationItem('Success', '', 'Housing Loan cannot be loaned at the same time with Educational Loan. Loan application not created.')]
            );
        } else {
            if (Loans::where('user_id', $user->id)->where('loan_type', 'Housing Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {
                return Redirect::route('userLoanDashboard')->with(
                    'message',
                    [NotificationService::notificationItem('Success', '', 'You already have an existing ' . $validate_data['loan_type'] . '. Loan application not created.')]
                );
            } else {
                if ($request->hasFile('attachment1') || $request->hasFile('attachment2') || $request->hasFile('attachment3')) {


                    $user_loans = $user->loans()->create([

                        'loan_type' => $validate_data['loan_type'],
                        'duration' => $validate_data['terms'],
                        'attachment1' => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment1->store('LoanImage',  's3'),
                        'attachment2' => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment2->store('LoanImage',  's3'),
                        "attachment3" => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment3->store('LoanImage',  's3'),
                        'loan_amount' => $validate_data['loan_amount'],
                        'amortization'=>$validate_data['loan_amount'] / ($validate_data['terms'] * 2),
                        'amount' => $validate_data['amount'],
                        'interest' => $validate_data['interest'],
                        'loan_status' => 'Awaiting Approval',
                        'approval' => 'Submitted',

                    ]);


                    $user->userNotif()->create([
                        'universal_id' => $user_loans->id,
                        'onRead' => false,
                        'value' => $user->name . ' Applying for ' . $validate_data['loan_type'],
                        'type' => 1,
                        'notification_type' => 1
                    ]);

                    return Redirect::route('userLoanDashboard')->with(
                        'message',
                        [NotificationService::notificationItem('Success', '', 'Successfully submitted ' . $validate_data['loan_type'])]
                    );
                }
            }
        }
    }

    public function createLoansWithRelative(request $request)
    {
        $validate_data = $request->validated();

        $user = User::find(auth()->id());
        if (Loans::where('user_id', $user->id)->where('loan_type', 'Housing Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {
            return Redirect::route('userLoanDashboard')->with(
                'message',
                [NotificationService::notificationItem('Success', '', 'Educational Loan cannot be loaned at the same time with Housing Loan. Loan application not created.')]
            );
        } else {
            if (Loans::where('user_id', $user->id)->where('loan_type', 'Educational Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {
                return Redirect::route('userLoanDashboard')->with(
                    'message',
                    [NotificationService::notificationItem('Success', '', 'You already have an existing ' . $validate_data['loan_type'] . '. Loan application not created.')]
                );
            } else {
                if ($request->hasFile('attachment1') || $request->hasFile('attachment2') || $request->hasFile('attachment3')) {


                    $user_loans = $user->loans()->create([

                        'loan_type' => $validate_data['loan_type'],
                        'duration' => $validate_data['terms'],
                        'attachment1' => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment1->store('LoanImage',  's3'),
                        'attachment2' => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment2->store('LoanImage',  's3'),
                        "attachment3" => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment3->store('LoanImage',  's3'),
                        'loan_amount' => $validate_data['loan_amount'],
                        'amount' => $validate_data['amount'],
                        'amortization'=>$validate_data['loan_amount'] / ($validate_data['terms'] * 2),

                        'interest' => $validate_data['interest'],
                        'loan_status' => 'Awaiting Approval',
                        'approval' => 'Submitted',

                    ]);


                    $user->userNotif()->create([
                        'universal_id' => $user_loans->id,
                        'onRead' => false,
                        'value' => $user->name . ' Applying for ' . $validate_data['loan_type'],
                        'type' => 1,
                        'notification_type' => 1
                    ]);

                    return Redirect::route('userLoanDashboard')->with(
                        'message',
                        [NotificationService::notificationItem('Success', '', 'Successfully submitted ' . $validate_data['loan_type'])]
                    );
                }
            }
        }
    }

    public function createEmergencyLoan(emergencyReqest $request)
    {
        $validate_data = $request->validated();
        $user = User::find(auth()->id());
        if (Loans::where('user_id', $user->id)->where('loan_type', 'Emergency Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {
            return Redirect::route('userLoanDashboard')->with(
                'message',
                [NotificationService::notificationItem('Success', '', 'You already have an existing ' . $validate_data['loan_type'] . '. Loan application not created.')]
            );
        } else {
            if ($request->hasFile('attachment1')) {


                $user_loans = $user->loans()->create([

                    'loan_type' => $validate_data['loan_type'],
                    'duration' => $validate_data['terms'],
                    'attachment1' => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment1->store('LoanImage',  's3'),
                    'loan_amount' => $validate_data['loan_amount'],
                    'amount' => $validate_data['amount'],
                    'amortization'=>$validate_data['loan_amount'] / ($validate_data['terms'] * 2),

                    'interest' => $validate_data['interest'],
                    'loan_status' => 'Awaiting Approval',
                    'approval' => 'Submitted',
                ]);

                $user->userNotif()->create([
                    'universal_id' => $user_loans->id,
                    'onRead' => false,
                    'value' => $user->name . ' Applying for ' . $validate_data['loan_type'],
                    'type' => 1,
                    'notification_type' => 1
                ]);
            }


            return Redirect::route('userLoanDashboard')->with(
                'message',
                [NotificationService::notificationItem('Success', '', 'Successfully submitted ' . $validate_data['loan_type'])]
            );
        }
    }


    public function createEducationalLoan(educationalRequest $request)
    {
        $validate_data = $request->validated();

        $user = User::find(auth()->id());
        if (Loans::where('user_id', $user->id)->where('loan_type', 'Housing Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {
            return Redirect::route('userLoanDashboard')->with(
                'message',
                [NotificationService::notificationItem('Success', '', 'Educational Loan cannot be loaned at the same time with Housing Loan. Loan application not created.')]
            );
        } else {
            if (Loans::where('user_id', $user->id)->where('loan_type', 'Educational Loan')->whereIn('loan_status', ['Ongoing','Awaiting Approval'])->where('approval', '!=', 'Denied')->exists()) {

                return Redirect::route('userLoanDashboard')->with(
                    'message',
                    [NotificationService::notificationItem('Success', '', 'You already have an existing ' . $validate_data['loan_type'] . '. Loan application not created.')]
                );
            } else {
                if ($request->hasFile('attachment1') && $request->hasFile('attachment3')) {


                    $user_loans = $user->loans()->create([
                        'loan_type' => $validate_data['loan_type'],
                        'duration' => $validate_data['terms'],
                        'attachment1' => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment1->store('LoanImage',  's3'),
                        //    'attachment2'=>'../../../uploads/loans/'.$file_name2,
                        "attachment3" => 'https://fopm-sams.s3.amazonaws.com/' . $request->attachment3->store('LoanImage',  's3'),
                        'loan_amount' => $validate_data['loan_amount'],
                        'amount' => $validate_data['amount'],
                        'amortization'=>$validate_data['loan_amount'] / ($validate_data['terms'] * 2),

                        'interest' => $validate_data['interest'],
                        'loan_status' => 'Awaiting Approval',
                        'approval' => 'Submitted',

                    ]);
                    $user->userNotif()->create([
                        'universal_id' => $user_loans->id,
                        'onRead' => false,
                        'value' => $user->name . ' Applying for ' . $validate_data['loan_type'],
                        'type' => 1,
                        'notification_type' => 1
                    ]);
                    return Redirect::route('userLoanDashboard')->with(
                        'message',
                        [NotificationService::notificationItem('Success', '', 'Successfully submitted ' . $validate_data['loan_type'])]
                    );
                }
            }
        }
    }




    public function medicalReimbursment(query $query)
    {
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $filters = $query::only('status');
        isset($filters['status']) ? $filters['status'] = Approval::status($filters['status']) : $filters['status'] = Approval::status($filters['status'] = 'All');

        $medical = Medical::with('user')
            ->filter($filters)
            ->orderByRaw('updated_at DESC')
            ->limit(5)
            ->paginate(5)
            ->appends($query::only(['status']));
        return Inertia::render('Users/MedicalReimbursment', [
            'medicals' => $medical,
            'filter' => $filters,
            'notification' => $userNotification,
            'count' => $notificationCount,
        ]);
    }


    public function createReimburstment()
    {
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $info = Admin::where('user_id', auth()->id())->get()->first();

        $reimbursement_balance_in = ReimbursementHelper::inPatient(auth()->id());
        $reimbursement_balance_out = ReimbursementHelper::outPatient(auth()->id());


        foreach (Medical::where('user_id', auth()->id())->where('status', '!=', 'Denied')->where('status', '!=', 'Rejected')->get() as $medical) {
            if (date_format($medical->created_at, 'Y') == Carbon::now()->format('Y')) {
                if ($medical->reimbursment_type == "IN-PATIENT") {
                    $reimbursement_balance_in = $reimbursement_balance_in - $medical->amount;
                } else {
                    $reimbursement_balance_out = $reimbursement_balance_out - $medical->amount;
                }
            }
        }

        return Inertia::render('Users/UserReimbursmentView', [
            'info' => $info,
            'notification' => $userNotification,
            'count' => $notificationCount,
            'reimbursement_balance_in' => $reimbursement_balance_in,
            'reimbursement_balance_out' => $reimbursement_balance_out,
            'benifit' => ReimbursementHelper::benifits(auth()->id())
        ]);
    }
    public function submitCreateReimburstment(medicalRequest $request)
    {
        $validate_data = $request->validated();
        $user = User::find(auth()->id());
        $userMedical = $user->medicals()->create([
            'reimbursment_type' => $validate_data['reimbursment_type'],
            'amount' => $validate_data['amount'],
            'medical_benifit' => $validate_data['medical_benifit'],
            'clinic_name' => $validate_data['clinic_name'],
            'appointment_date' => $validate_data['appointment_date'],
            'hospital' => $validate_data['hospital'],
            'health' => $validate_data['health'],
            'eye' => $validate_data['eye'],
            'dental' => $validate_data['dental'],
            'mental' => $validate_data['mental'],
            'in_patient' => $validate_data['in_patient'],

        ]);
        if (isset($request->medical_record1)) {
            if (is_array($request->medical_record1)) {
                foreach ($request->medical_record1 as $image) {
                    $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $image->store('LoanImage',  's3');
                    $userMedical->attachments()->create([
                        'image' => $image_path,
                        'type' => 1
                    ]);
                }
            } else {
                $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $request->medical_record1->store('LoanImage',  's3');
                $userMedical->attachments()->create([
                    'image' => $image_path,
                    'type' => 1
                ]);
            }
        }


        if (isset($request->medical_record2)) {
            if (is_array($request->medical_record2)) {
                foreach ($request->medical_record2 as $image) {
                    $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $image->store('LoanImage',  's3');
                    $userMedical->attachments()->create([
                        'image' => $image_path,
                        'type' => 2
                    ]);
                }
            } else {
                $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $request->medical_record2->store('LoanImage',  's3');
                $userMedical->attachments()->create([
                    'image' => $image_path,
                    'type' => 2
                ]);
            }
        }


        if (isset($request->medical_record3)) {
            if (is_array($request->medical_record3)) {
                foreach ($request->medical_record3 as $image) {
                    $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $image->store('LoanImage',  's3');
                    $userMedical->attachments()->create([
                        'image' => $image_path,
                        'type' => 3
                    ]);
                }
            } else {
                $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $request->medical_record3->store('LoanImage',  's3');
                $userMedical->attachments()->create([
                    'image' => $image_path,
                    'type' => 3
                ]);
            }
        }

        if (isset($request->medical_record4)) {
            if (is_array($request->medical_record4)) {
                foreach ($request->medical_record4 as $image) {
                    $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $image->store('LoanImage',  's3');
                    $userMedical->attachments()->create([
                        'image' => $image_path,
                        'type' => 4
                    ]);
                }
            } else {
                $image_path = 'https://fopm-sams.s3.amazonaws.com/' . $request->medical_record4->store('LoanImage',  's3');
                $userMedical->attachments()->create([
                    'image' => $image_path,
                    'type' => 4
                ]);
            }
        }
        // }else{

        // }
        $user->userNotif()->create([
            'universal_id' => $userMedical->id,
            'onRead' => false,
            'value' => $user->name . ' Applying for Medical Reimbursement',
            'type' => 3,
            'notification_type' => 2
        ]);
        return Redirect::route('medicalView')->with(
            'message',
            [NotificationService::notificationItem('Success', '', 'Successfully submitted Medical Reimbursement ' . $validate_data['reimbursment_type'])]
        );
    }

    public function  UserLoanView($id)
    {

        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();

        $loan = Loans::find($id);
        $contribution = Contributions::where('loans_id', $loan->id)->orderByRaw('created_at DESC')->limit(5)->paginate(5);
        $user = User::with('AdminReg')->find($loan->user_id);
        return Inertia::render('Users/UserLoanView', [
            'users' => $user,
            'loans' => $loan,
            'notification' => $userNotification,
            'count' => $notificationCount,
            'contributions' => $contribution
        ]);
    }

    public function loanDashboard()
    {
        $id = auth()->id();
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $user = User::with('adminReg')->find($id);
        return Inertia::render('Users/UserLoanDashboard', [
            'users' => $user,
            'notification' => $userNotification,
            'count' => $notificationCount
        ]);
    }



    public function ReimbursView()
    {
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        return Inertia::render('Users/medicalreimbursView', [
            'notification' => $userNotification,
            'count' => $notificationCount
        ]);
    }

    public function MedicalBreakdown($id)
    {
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $userNotification->where('onRead', false)->count();
        $medical = Medical::with('attachments')->find($id);
        $info = Admin::where('user_id', $medical->user_id)->get()->first();

        return Inertia::render('Users/MedicalBreakdown', [
            'notification' => $userNotification,
            'count' => $notificationCount,
            'medical' => $medical,
            'info' => $info
        ]);
    }
}
