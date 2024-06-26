<?php

namespace App\Http\Controllers;

use App\Models\{User, BoardMembers, Contributions, UserNotifications, Loans, Medical, UserContribution};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as QueryRequest;
use App\Http\Requests\UserDeleteRequest as deleteRequest;
use App\Http\Requests\UserUpdateRequest as updateRequest;
use App\Http\Requests\LoanReviewRequest as reviewloanRequest;
use App\Http\Requests\LoanRejectRequest as rejectLoanRequest;
use App\Http\Requests\AdminReimbursementUpdateRequest as reimbursementRequest;
use App\Http\Requests\Admin as RegiterUserRequest;
use App\Http\Requests\BoardsUpdate;
use App\Http\Requests\ContributionHistoryRequest;
use App\Http\Requests\MedicalApproveAdmin;
use App\Http\Requests\MedicalToReject;
use App\Http\Requests\UserSoftDelete;
use App\Imports\UserAdmin;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth};

use App\Models\Admin;
use App\Imports\{UsersImport, ContributionImport, UserContribImport};
use App\Services\Approval;
use Illuminate\Support\Facades\{Hash, DB, Redirect};
use Maatwebsite\Excel\Facades\Excel;
use App\Services\NotificationService;

class AdminController extends Controller
{
    //

    public function users(QueryRequest $query)
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();

        $filters = $query::only('limit');
        isset($filters['limit']);
        $users = User::with('adminReg', 'userContribution')
            ->orderBy('name')
            ->filter($query::only('search'))
            ->limit($filters['limit']??5)
            ->paginate($filters['limit']??5)
            ->appends($query::only('search','limit'));
        $filters = $query::all('search');
        return Inertia::render('Admin/Users', [
            'notification' => $notification,
            'users' => $users,
            'filters' => $filters,
            'count' => $notificationCount
        ]);
    }
    public function userRegister()
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();
        return Inertia::render('Admin/RegisterUser', [
            'notification' => $notification,
            'count' => $notificationCount

        ]);
    }

    public function userProfile($id)
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();
        $userProfile = User::with('AdminReg', 'userContribution.contributionHistory')->find($id);
        $userLoan = Loans::where('user_id', '=', $id)->where('loan_status', '=', 'Paid')->get();
        return Inertia::render('Admin/UserProfile', [
            'notification' => $notification,
            'info' => $userProfile,
            'loans' => $userLoan,
            'count' => $notificationCount

        ]);
    }
    public function userDelete(deleteRequest $request)
    {

        $user_to_delete = User::findOrFail($request->validated()['id']);
        $user_to_delete->update([
            'status' => $request->validated()['status']
        ]);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Archived')]
        );
    }

    private function roleToInt(String $role): int
    {
        switch ($role) {
            case 'Admin':
                return 1;
                break;
            case 'User':
                return 2;
            case 'Medical':
                return 3;
                break;
        }
    }

    //user registration
    public function userRegisterSubmit(RegiterUserRequest $request)
    {
        $validated_data = $request->validated();
        $user = null;
        $role = $this->roleToInt($validated_data['account_information']['role']);

        DB::transaction(function () use ($validated_data, $user, $role) {

            $name  = $validated_data['first_name'] . ' ' . $validated_data['middle_name'] . ' ' . $validated_data['last_name'];
            $user = User::create([
                'name' => $name,
                'email' => $validated_data['account_information']['email'],
                'password' => Hash::make($validated_data['account_information']['password']),
                'email_verified_at' => Carbon::now(),
                'userType' => $role,
                'member_id' => $validated_data['account_information']['member_id'],
            ]);
            $user->adminReg()->create([
                'first_name' => $validated_data['first_name'],
                'last_name' => $validated_data['last_name'],
                'birth_date' => $validated_data['birth_date'],
                'birth_place' => $validated_data['birth_place'],

                'employment' => $validated_data['employment'],
                'membership' => $validated_data['membership'],
                'mobile_number' => $validated_data['mobile_number'],
                'department' => $validated_data['department'],
            ]);
        });
        return Redirect::route('users')->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Registered Member')]
        );;
    }


    public function userUpdate(updateRequest $request)
    {
        $admin = Admin::find($request->validated()['id']);

        $user = $admin->user;
        $data = $request->validated();
        $user->update([
            'name' => $data['first_name'] . ' ' . $data['middle_name'] . '' . $data['last_name']
        ]);
        $admin->update($data);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    // User profile csv upload
    public function userUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
            'password' => 'required'
        ]);
        if (Hash::check($request->password, Auth::user()->password)) {
            Excel::import(new UsersImport, $request->file);

            return Redirect::route('dashboard')->with(
                'message',
                [NotificationService::notificationItem('success', '', 'Sucessfully Uploaded')]
            );
        } else {
            return Redirect::route('dashboard')->with(
                'message',
                [NotificationService::notificationItem('failed', '', 'Password Not Match')]
            );
        }
    }



    public function userContributions(Request $request)
    {

        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
            'password' => 'required'
        ]);
        if (Hash::check($request->password, Auth::user()->password)) {
            Excel::import(new ContributionImport, $request->file);

            return Redirect::route('dashboard')->with(
                'message',
                [NotificationService::notificationItem('success', '', 'Sucessfully Uploaded')]
            );
        } else {
            return Redirect::back()->with(
                'message',
                [NotificationService::notificationItem('failed', '', 'Password Not Match')]
            );
        }
    }

    public function userContriImport(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
            'password' => 'required'
        ]);
        if (Hash::check($request->password, Auth::user()->password)) {
            Excel::import(new UserContribImport, $request->file);

            return Redirect::route('dashboard')->with(
                'message',
                [NotificationService::notificationItem('success', '', "Sucessfully Uploaded Members' Contributions")]
            );
        } else {
            return Redirect::back()->with(
                'message',
                [NotificationService::notificationItem('failed', '', 'Password Not Match')]
            );
        }
    }


    public function adminLoansView(QueryRequest $query)
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();

        $filters = $query::only('approval','limit');
        
        isset($filters['approval']) ? $filters['approval'] = Approval::approval($filters['approval']) : $filters['approval'] = Approval::approval($filters['approval'] = 'All');
        isset($filters['limit']);

        $loans = Loans::with('user')->with('contributions')->whereRelation('user', 'status', 1)->whereNot('loan_status','Paid')
            ->filter($filters)
            ->limit($filters['limit']??5)
            ->orderByRaw('updated_at DESC')
            ->paginate($filters['limit']??5)
            ->appends($query::only(['approval','limit']));

        return Inertia::render('Admin/LoansView', [
            'notification' => $notification,
            'filters' => $filters,
            'loans' => $loans,
            'count' => $notificationCount
        ]);
    }



    public function loanApprove(reviewloanRequest $request)
    {
        $loans = loans::find($request->validated()['id']);
        $data = $request->validated();
        $loans->update($data);
        UserNotifications::create([
            'user_id' => $loans->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application has been PROCESSED',
            'type' => 2,
            'notification_type' => 3
        ]);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    public function loanRelease(reviewloanRequest $request)
    {
        $loans = loans::find($request->validated()['id']);
        $data = $request->validated();
        $loans->update($data);
        UserNotifications::create([
            'user_id' => $loans->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application is Ready for Release',
            'type' => 2,
            'notification_type' => 3
        ]);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    public function loanReleased(reviewloanRequest $request)
    {
        $loans = loans::find($request->validated()['id']);
        $data = $request->validated();
        $data['loan_status'] = "Ongoing";
        $loans->update($data);
        UserNotifications::create([
            'user_id' => $loans->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application is RELEASED',
            'type' => 2,
            'notification_type' => 3
        ]);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    public function loanReject(rejectLoanRequest $request)
    {
        $loans = loans::find($request->validated()['id']);
        $data = $request->validated();
        $loans->update([
            'approval'=>$data['approval'],
            'reason'=>$data['reason'],
            'loan_status'=>$data['approval']
        ]);
        UserNotifications::create([
            'user_id' => $loans->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application has been REJECTED',
            'type' => 2,
            'notification_type' => 4
        ]);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }


    public function contributions($id)
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();
        $loanProfile = Loans::find($id);
        $info = Admin::where('user_id', $loanProfile->user_id)->get()->first();
        $contribution = Contributions::where('loans_id', '=', $loanProfile->id)
            ->limit(5)
            ->paginate(5);
        $last_contribution = Contributions::where('loans_id', '=', $loanProfile->id)->first();

        return Inertia::render('Admin/Contributions', [
            'notification' => $notification,
            'loan' => $loanProfile,
            'info' => $info,
            'contributions' => $contribution,
            'count' => $notificationCount,
            'last_contribution'=>$last_contribution
        ]);
    }
    public function addContribution()
    {
        $loans = Loans::all()->where('approval', 'Processed')->where('loan_status', 'Ongoing');
        foreach ($loans as $loan) {
            $info = Admin::find($loan->user_id);
            dd($info->total_contribution + ($info->salary * 0.05));
            if ($loan->loan_amount <= 0) {
                $loan->update([
                    'loan_amount' => $loan->loan_amount - $info->salary * 0.05,
                ]);
                $loan->contributions()->create([
                    'loans_id' => $loan->id,
                    'contribution_amount' => $info->salary * 0.05,
                ]);

                $info->update([
                    'total_contribution' => $info->total_contribution + ($info->salary * 0.05)
                ]);
            } else {
                $loan->update([
                    'loan_status' => 'Paid'
                ]);
            }
        }
    }
    public function loanPrint($id)
    {
        $loan = Loans::find($id);
        $info = Admin::where('user_id', $loan->user_id)->get()->first();
        $loan->update([
            'approval' => 'For Processing',
        ]);
        $board = BoardMembers::findOrFail(1);
        return Inertia::render('Admin/Printing', [
            'loan' => $loan,
            'info' => $info,
            'board' => $board
        ]);
    }

    public function reimbursementView(QueryRequest $query)
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();


        $filters = $query::only('status','limit');
        isset($filters['status']) ? $filters['status'] = Approval::status($filters['status']) : $filters['status'] = Approval::status($filters['status'] = 'All');
        isset($filters['limit']);
        $medical = Medical::with('user')->where('status', '!=', 'Pending')->whereRelation('user', 'status', 1)->filterAdmin($filters)->limit($filters['limit']??5)->orderByRaw('created_at DESC')->paginate($filters['limit']??5)->appends( $query::only('status','limit'));

        return Inertia::render('Admin/Reimbursement', [
            'notification' => $notification,
            'count' => $notificationCount,
            'filter' => $filters,
            'medicals' => $medical,
        ]);
    }
    public function reimbursementProfileView($id)
    {
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();

        $medical = Medical::with('attachments')->where('id', $id)->get()->first();
        $info = Admin::where('user_id', $medical->user_id)->get()->first();
        return Inertia::render('Admin/ReimbursementProfile', [
            'notification' => $notification,
            'count' => $notificationCount,
            'medical' => $medical,
            'info' => $info
        ]);
    }

    public function updateReimbursement(reimbursementRequest $request)
    {
        $validated_data = $request->validated();
        $medical = Medical::where('id', $validated_data['id'])->get()->first();
        $medical->update($validated_data);
        UserNotifications::create([
            'user_id' => $medical->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application has been Updated',
            'type' => 2,
            'notification_type' => 5
        ]);
        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    public function updateBoards(BoardsUpdate $request)
    {
        $validated_data = $request->validated();
        $board = BoardMembers::findOrFail(1);
        $board->update([
            'chairman' => $validated_data['chairman'],
            'committee_chairman' => $validated_data['committee_chairman'],
            'school_physician' => $validated_data['school_physician'],
            'vice_chairman' => $validated_data['vice_chairman'],
            'corporate_secretary' => $validated_data['corporate_secretary'],
            'treasurer' => $validated_data['treasurer'],
            'internal_auditor' => $validated_data['internal_auditor'],
            'accountant' => $validated_data['accountant'],
        ]);

        return Redirect::route('dashboard')->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    public function userArchive(QueryRequest $query)
    {

        $filters = $query::only('limit');
        isset($filters['limit']);
        $deletedUsers = User::with('adminReg')->where('status', 2)->limit($filters['limit']??5)->paginate($filters['limit']??5);
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead', false)->count();
        return Inertia::render('Admin/MemberArchive', [
            'deletedUsers' => $deletedUsers,
            'notification' => $notification,
            'count' => $notificationCount,
            'filters'=>$filters
        ]);
    }

    public function permanentDeleteUser(UserSoftDelete $deleteUser)
    {
        $user = User::findOrFail($deleteUser->validated()['id']);
        $user->delete();

        return Redirect::back()->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Deleted')]
        );
    }

    public function contributionHistory(ContributionHistoryRequest $contributionHistory){
        $validated_data = $contributionHistory->validated();
        if (Hash::check($validated_data['password'], Auth::user()->password)) {
            $contribution = UserContribution::findOrFail($validated_data['id']);
            $contribution->update([
                'contribution_amount' => $contribution->contribution_amount - $validated_data['amount']
            ]);
            $contribution->contributionHistory()->create([
                'amount'=>$validated_data['amount']
            ]);

            return Redirect::route('dashboard')->with(
                'message',
                [NotificationService::notificationItem('success', '', 'Sucessfully Claimed Contribution')]
            );
        } else {
            return Redirect::route('dashboard')->with(
                'message',
                [NotificationService::notificationItem('failed', '', 'Password Not Match')]
            );
        }
    }

    public function reimbursementToApprove(MedicalApproveAdmin $request)
    {
        $validated_data = $request->validated();
        $medical = Medical::where('id', $validated_data['id'])->get()->first();
        $medical->update($validated_data);
        UserNotifications::create([
            'user_id' => $medical->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application has been Updated',
            'type' => 2,
            'notification_type' => 5
        ]);
        return Redirect::route('dashboard')->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }

    public function reimbursementToReject(MedicalToReject $request)
    {
        $validated_data = $request->validated();
        $medical = Medical::where('id', $validated_data['id'])->get()->first();
        $medical->update($validated_data);
        UserNotifications::create([
            'user_id' => $medical->user_id,
            'universal_id' => $request->validated()['id'],
            'onRead' => false,
            'value' => 'Your application has been Updated',
            'type' => 2,
            'notification_type' => 5
        ]);
        return Redirect::route('dashboard')->with(
            'message',
            [NotificationService::notificationItem('success', '', 'Sucessfully Updated')]
        );
    }
}
