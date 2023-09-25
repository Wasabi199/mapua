<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use App\Models\Loans;

class Contributions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:contribution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will add a contribution for Teaching on Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       foreach(Admin::all() as $users){
        if($users->member_type == 'Teaching'){
            $users->update([
                 'total_contribution'=>$users->total_contribution + ($users->salary * 0.05)
             ]);
        }
       }
        // $loans = Loans::all()->where('approval','Approved')->where('loan_status','Ongoing');
        // $loans = User::has('loans')->get();
        // $info = Admin::all()->where($loans->user_id);
        // dd($loans);
        // foreach($loans as $loan){
        //     $info = Admin::find($loan->user_id);
        //     // dd($info->total_contribution + ($info->salary *0.05));
        //     // dd($loan->loan_amount);
        //     if($info->member_type == 'Teaching'){
        //         if(!$loan->loan_amount <= 0){
        //             // dd($loan->loan_amount - $info->salary * 0.05,);
        //            $loan->update([
        //                 'loan_amount'=>$loan->loan_amount - $info->salary * 0.05,
        //             ]); 
    
        //             $loan->contributions()->create([
        //                 'loans_id' => $loan->id,
        //                 'contribution_amount'=>$info->salary * 0.05,
        //             ]);
    
        //         }else{
        //             $loan->update([
        //                 'loan_status'=>'Paid'
        //             ]);
        //         }
        //     }
       
        // }
    }
}
