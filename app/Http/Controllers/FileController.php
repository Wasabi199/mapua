<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //

    public function upload(Request $request){
        // return response()->json([
        //             'message'=>$request 
        //         ]);
      
        try{
            if($request->hasFile('img')){
                $file = $request->file('img');
                $file_name = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('uploads/'),$file_name);
                    return response()->json([
                        'message'=>'File Uploaded Successfully!'
                    ],200);
            }
            
        }catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage() 
            ]);
        }
    }
}
