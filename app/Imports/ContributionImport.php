<?php

namespace App\Imports;

use App\Models\{User,Loans};

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
class ContributionImport implements ToCollection, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach($rows as $row){
            $user = User::where('member_id',$row['member_id'])->has('loans')->first();
            if(User::findOrFail($user->id)->has('loans')){
                $loan = Loans::filterOwner($user->id)->get();
                foreach($loan as $loanUpdate){
                    
                    if($loanUpdate->loan_type == $row['loan_type']){
                        if($loanUpdate->approval == 'Released'){
                            if(!$loanUpdate->loan_amount >= 0){
                                 
                                $loanUpdate->contributions()->create([
                                    'contribution_amount'=>$row['loan_payment'],
                                    'remaining_balance'=>$row['remaining_balance']
                                ]);
    
                                if($row['remaining_balance'] <= 0){
                                    $loanUpdate->update([
                                        // 'loan_amount'=>$loanUpdate->loan_amount - $row['loan_payment'],
                                        'loan_amount'=>$row['remaining_balance'],
                                        'loan_status'=>'Paid',

                                    ]);
                                }else{
                                    $loanUpdate->update([
                                        'loan_amount'=>$row['remaining_balance'],
                                    ]);
                                }
    
                             }else{
                                $loanUpdate->update([
                                    'loan_status'=>'Paid'
                                ]);
                            }
                        }
                       
                    }
                    
                }
                
             
            }
        }
    }
    public function rules(): array
    {
        return[
            'member_id'=>'required',
            'loan_type'=>'required',
            'loan_payment'=>'required',
            'remaining_balance'=>'required'
        ];
    }
}
