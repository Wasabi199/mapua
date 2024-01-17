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

        // $user = User::with('medicals')
        $medical = Medical::with('user')
        // ->orderBy('name')
        ->filterAdmin($filters)
        // ->get()
        ->limit(5)
        ->orderByRaw('created_at DESC')
        ->paginate(5);
        // ->appends($query::only('search'));
        // $filters = $query::all('search');
// dd($medical);
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
        // dd($request);
        $medical = Medical::find($request->validated()['id']);
        $data = $request->validated();
        // dd($data);
        $medical->update($data);
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
        // dd($request);
        $medical = Medical::find($request->validated()['id']);
        $data = $request->validated();
        // dd($medical);
        $medical->update($data);
        UserNotifications::create([
            'user_id'=>$medical->user_id,
            'universal_id'=>$request->validated()['id'],
            'onRead'=>false,
            'value'=>'Your application has been REJECTED',
            'type'=>2,
            'notification_type'=>6
        ]);

        return Redirect::back()->with('message',
            [NotificationService::notificationItem('success', '', 'Successfully Updated')]);
    }

    public function reimbursemetPrint($id){
        $medical = Medical::where('id',$id)->get()->first();
        $info = Admin::where('user_id',$medical->user_id)->get()->first();
        $board = BoardMembers::findOrFail(1);
        
        return Inertia::render('Medical/ReimburstmentPrint',[
            'medical'=>$medical,
            'info'=>$info,
            'board'=>$board
        ]);
    }

}
