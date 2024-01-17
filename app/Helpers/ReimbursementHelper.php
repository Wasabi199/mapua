<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;

class ReimbursementHelper
{


    public static function inPatient($id): int
    {
        $balance = 5000;

        $user = User::where('id', $id)->with('adminReg')->first();

        $no_years = (int)Carbon::now()->year - (int)Carbon::createFromFormat('Y-m-d', $user->adminReg->membership)->year;

        if((int)Carbon::createFromFormat('Y-m-d', $user->adminReg->membership)->year < 2021){
            if ($no_years >= 1 && $no_years <= 3) {
                $balance = $balance * 0.5;
            } else if ($no_years >= 3 && $no_years <= 5) {
                $balance = $balance * 0.7;
            } else {
                return $balance;
            }
        }else{

            if ($no_years >= 0 && $no_years <= 2) {
                $balance = $balance * 0.1;
            } else if ($no_years >= 2 && $no_years <= 3) {
                $balance = $balance * 0.2;
            }else if ($no_years >= 3 && $no_years <= 4) {
                $balance = $balance * 0.3;
            }else if ($no_years >= 4 && $no_years <= 5) {
                $balance = $balance * 0.4;
            }else if ($no_years >= 5 && $no_years <= 6) {
                $balance = $balance * 0.5;
            }else if ($no_years >= 6 && $no_years <= 7) {
                $balance = $balance * 0.6;
            }else if ($no_years >= 7 && $no_years <= 8) {
                $balance = $balance * 0.7;
            }else if ($no_years >= 8 && $no_years <= 9) {
                $balance = $balance * 0.8;
            }else if ($no_years >= 9 && $no_years <= 10) {
                $balance = $balance * 0.9;
            }else{
                $balance = $balance * 1;
    
            }
        }

        return $balance;
    }

    public static function outPatient($id){
        $balance = 7000;

        $user = User::where('id', $id)->with('adminReg')->first();

        $no_years = (int)Carbon::now()->year - (int)Carbon::createFromFormat('Y-m-d', $user->adminReg->membership)->year;


        if((int)Carbon::createFromFormat('Y-m-d', $user->adminReg->membership)->year < 2021){
            if ($no_years >= 1 && $no_years <= 3) {
                $balance = $balance * 0.5;
            } else if ($no_years >= 3 && $no_years <= 5) {
                $balance = $balance * 0.7;
            } else {
                return $balance;
            }
        }else{

            if ($no_years >= 0 && $no_years <= 2) {
                $balance = $balance * 0.1;
            }else if ($no_years >= 2 && $no_years <= 3) {
                $balance = $balance * 0.2;
            }else if ($no_years >= 3 && $no_years <= 4) {
                $balance = $balance * 0.3;
            }else if ($no_years >= 4 && $no_years <= 5) {
                $balance = $balance * 0.4;
            }else if ($no_years >= 5 && $no_years <= 6) {
                $balance = $balance * 0.5;
            }else if ($no_years >= 6 && $no_years <= 7) {
                $balance = $balance * 0.6;
            }else if ($no_years >= 7 && $no_years <= 8) {
                $balance = $balance * 0.7;
            }else if ($no_years >= 8 && $no_years <= 9) {
                $balance = $balance * 0.8;
            }else if ($no_years >= 9 && $no_years <= 10) {
                $balance = $balance * 0.9;
            }else{
                $balance = $balance * 1;
    
            }
        }


        return $balance;
    }
}
