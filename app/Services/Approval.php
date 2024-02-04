<?php
namespace App\Services;

class Approval{

    public static function approval(String $approval){

        switch($approval){
            case 'All':
                return null;
            break;
            case 'Processed':
                return 'Processed';
            break;
            case 'For Processing':
                return 'For Processing';
            break;
            case 'Submitted':
                return 'Submitted';
            break;
            case 'Denied':
                return 'Denied';
            break;
            case 'For Release':
                return 'For Release';
            break;
            case 'Released':
                return 'Released';
            break;
            default:
                return null;
            }
        }
        public static function status(String $status){

            switch($status){
                case 'All':
                    return null;
                break;
                case 'Pending':
                    return 'Pending';
                break;
                case 'For Approval':
                    return 'For Approval';
                break;
                case 'Approved':
                    return 'Approved';
                break;
                case 'For Release':
                    return 'For Release';
                break;
                case 'Released':
                    return 'Released';
                break;
                case 'Rejected':
                    return 'Rejected';
                break;
                default:
                    return null;
                }
            }
       
}


?>