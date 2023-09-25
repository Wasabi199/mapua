<?php

namespace App\Imports;

use App\Models\User;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
// use App\Imports\Date;

class UsersImport implements   WithHeadingRow, ToCollection, WithValidation, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // HeadingRowFormatter::default('none');

            foreach ($rows as $row) {
                # code...
                
                        $pass = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                        $userNew = null;
                        // dd($pass[(int)\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('m')-1].\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('d').\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('Y'));
                        DB::transaction(function () use ($userNew,$row, $pass) {
                            $userNew = User::create([
                                'name'      =>$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'],
                                'email'     =>$row['email'],
                                'userType'  =>2,
                                'password'  =>Hash::make($pass[(int)\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('m')-1].\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('d').\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('Y')),
                                'member_id'=>$row['member_id']
                            ]);
                            $userNew->adminReg()->create([
                                'first_name'    =>$row['first_name'],
                                'middle_name'   =>$row['middle_name'],
                                'last_name'     =>$row['last_name'],
                                'mobile_number' =>'+63-'.$row['mobile'],
                                'birth_date'    =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birthdate'])->format('Y-m-d'),
                                // 'birth_place'   =>"",
                                'civil_status'  =>$row['civil_status'],
            
                                'department'    =>$row['department'],
                                // 'salary'        =>$row['salary'],
                                'membership'    =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['membership'])->format('Y-m-d'),
                                'employment'    =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['employment'])->format('Y-m-d'),
                            ]);
                        });
                    
                    }
                // }
            // }
            //
    }
    public function rules(): array
    {
        return[
            'email'=>'required|email|unique:users,email',
            'member_id'=>'required',
            'first_name'=>'required',
            // 'middle_name'=>'required',
            'last_name'=>'required',
            
            // 'mobile'=>'required',
            'birthdate'=>'required',
           
            // 'civil_status'=>'required',

           

            'department'=>'required',
            // 'salary'=>'required',
            'membership'=>'required',
            'employment'=>'required',

        ];
    }
    // public function map($row): array
    // {
    //     return[
    //         $row['first_name'],
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($row['birthdate']),
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($row['membership']),
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($row['employment']),
      
    //     ];
    // }
    // public function columnFormats(): array
    // {
    //     return[
    //         'birth_date'=> NumberFormat::FORMAT_DATE_YYYYMMDD,
    //         'membership'=> NumberFormat::FORMAT_DATE_YYYYMMDD,
    //         'employment' => NumberFormat::FORMAT_DATE_YYYYMMDD,


    //     ];
    // }

}
