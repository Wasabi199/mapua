<?php

namespace App\Imports;

use App\Models\Admin;
use App\Models\User;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class UserAdmin implements ToModel, WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $users;

    public function __construct()
    {
        $this->users = User::select('id', 'name')->get();
    }


    public function model(array $row)
    {
        
        $user =$this->users->where('name',$row['First Name'].' '.$row['Middle Name'].' '.$row['Last Name'])->first();
      
        return new Admin([
        
         
            'first_name'    =>$row['First Name'],
            'middle_name'   =>$row['Middle Name'],
            'last_name'     =>$row['Last Name'],
            'mobile_number' =>$row['Mobile'],
            'birth_date'    =>$row['Birthdate'],
            'birth_place'   =>$row['Birthplace'],
            'civil_status'  =>$row['Civil Status'],

            'department'    =>$row['Department'],
            // 'salary'        =>$row['Salary'],
            'membership'    =>$row['Membership'],
            'employment'    =>\Carbon\Carbon::parse($row['Employment']),
        ]);
    }
}
