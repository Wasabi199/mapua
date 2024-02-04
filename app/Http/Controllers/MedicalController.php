<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalApprove;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as QueryRequest;
use App\Models\{Admin, BoardMembers, Medical, User, UserNotifications};
use App\Services\Approval;
use Illuminate\Support\Facades\{Hash, DB, Redirect,Auth };
use App\Services\NotificationService;
class MedicalController extends Controller
{
    //
    public function index(QueryRequest $query){
        $filters = $query::only('status');
        isset($filters['status']) ? $filters['status'] = Approval::status($filters['status']) : $filters['status'] = Approval::status($filters['status'] = 'All');

        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead',false)->count();

        $medical = Medical::with('user')
        ->filterAdmin($filters)
        ->limit(5)
        ->orderByRaw('created_at DESC')
        ->paginate(5);

        return Inertia::render('Medical/Medical_Reimbursment',[
            'medical'=>$medical,
            'notification'=>$notification,
            'count'=>$notificationCount,
            'filter'=>$filters
        ]);
    }
    public function medicalProfile($id){
        $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $notificationCount = $notification->where('onRead',false)->count();

        $medical = Medical::with('attachments')->find($id);
        $info = Admin::where('user_id',$medical->user_id)->get()->first();

        return Inertia::render('Medical/MedicalAppliedView',[
            'userProfile'=> $info,
            'userMedical'=> $medical,
            'notification'=>$notification,
            'count'=>$notificationCount
        ]);
    }
    public function medicalApprove(MedicalApprove $request){
        $medical = Medical::find($request->validated()['id']);
        $data = $request->validated();

        $medical->update([
            'status'=>$data['status'],
            'signed_document'=> 'https://fopm-sams.s3.amazonaws.com/' . $request->signed_document->store('LoanImage',  's3')
        ]);


        UserNotifications::create([
            'user_id'=>$medical->user_id,
            'universal_id'=>$request->validated()['id'],
            'onRead'=>false,
            'value'=>'Your application has been APPROVED',
            'type'=>2,
            'notification_type'=>5
        ]);
        
        UserNotifications::create([
            'user_id'=>$medical->user_id,
            'universal_id'=>$request->validated()['id'],
            'onRead'=>false,
            'value'=>'Medical Reimbursement has been APPROVED',
            'type'=>1,
            'notification_type'=>7
        ]);
        return Redirect::back()->with('message',
            [NotificationService::notificationItem('success', '', 'Successfully Updated')]);
    }

    public function medicalReject(MedicalApprove $request){
        $data = $request->validated();
        $medical = Medical::find($data['id']);

        UserNotifications::create([
            'user_id'=>$medical->user_id,
            'universal_id'=>$request->validated()['id'],
            'onRead'=>false,
            'value'=>'Your application has been REJECTED',
            'type'=>2,
            'notification_type'=>6
        ]);

        return Redirect::back()->with('message',
            [NotificationService::notificationItem('success', '', 'Successfully Forwarded to Admin')]);
    }

    public function reimbursemetPrint($id){
        $medical = Medical::with('attachments')->findOrFail($id);
        $info = Admin::where('user_id',$medical->user_id)->get()->first();
        $board = BoardMembers::findOrFail(1);
        
        return Inertia::render('Medical/ReimburstmentPrint',[
            'medical'=>$medical,
            'info'=>$info,
            'board'=>$board
        ]);
    }

}
