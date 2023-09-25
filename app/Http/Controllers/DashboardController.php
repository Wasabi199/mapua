<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardsUpdate;
use Illuminate\Support\Facades\{Auth};
use App\Models\{BoardMembers, UserNotifications, User, UserContribution};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as QueryRequest;



class DashboardController extends Controller
{
    //
    public function userLandingPage(QueryRequest $request)
    {


        $contribution = UserContribution::find(Auth::user()->id);
        $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
        $userNotificationCount = $userNotification->where('onRead', false)->count();
        return Inertia::render('Users/UserDashboard', [
            'notification' => $userNotification,
            'count' => $userNotificationCount,
            'contribution' => $contribution,
        ]);
    }

    public function index(QueryRequest $request)
    {
        if (Auth::user()->status != 2) {
            $notification = UserNotifications::filter(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
            $notificationCount = $notification->where('onRead', false)->count();
            $contribution = UserContribution::find(Auth::user()->id);
            $userNotification = UserNotifications::filterOwner(Auth::user()->userType)->orderByRaw('created_at DESC')->get();
            $userNotificationCount = $userNotification->where('onRead', false)->count();
            $boards = BoardMembers::findOrFail(1);
            // dd($boards);

            if (Auth::user()->userType == 1) {
                return Inertia::render('Admin/AdminDashboard', [
                    'notification' => $notification,
                    'count' => $notificationCount,
                    'boards' => $boards
                ]);
            } else if (Auth::user()->userType == 2) {
                return Inertia::render('Users/UserLandingPage', []);
            } else if (Auth::user()->userType == 3) {
                return Inertia::render('Medical/Dashboard', [
                    'notification' => $notification,
                    'count' => $notificationCount

                ]);
            } else if (Auth::user()->userType == 4) {
                return Inertia::render('Chairman/Dashboard', [
                    'notification' => $notification,
                    'count' => $notificationCount
                ]);
            }
        } else {

            auth('web')->logout();
            // Auth::user()->token()->revoke();
            // Auth::logout();

            // $request->session()->invalidate();

            // $request->session()->regenerateToken();

            return redirect('/');
        }
    }
}
