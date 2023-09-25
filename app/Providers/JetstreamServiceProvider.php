<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\UserNotifications;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\{Auth};

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
        
        Jetstream::inertia()->whenRendering(
            'Profile/Show',
            function (Request $request, array $data) {
                // dd(Auth::user()->userType);
                if(Auth::user()->userType == 2){
                    $notification = UserNotifications::filterOwner(Auth::user()->userType)->get();
                    $notificationCount = $notification->where('onRead',false)->count();
                }else{
                    $notification = UserNotifications::filter(Auth::user()->userType)->get();
                    $notificationCount = $notification->where('onRead',false)->count();
                }
                
                return array_merge($data, [
                    // Custom data...
                    'notification'=>$notification,
                    'count'=>$notificationCount,
                ]);
            }
        );
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
