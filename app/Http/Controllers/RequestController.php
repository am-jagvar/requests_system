<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    
    
    public function verify_request(Request $request){
        try {
            if(Auth::user()->hasRole('Admin')){
                $findrequest = ModelsRequest::find($request->requestid);
                if($findrequest->supervisor_verify != 0){
                    $updatereq = ModelsRequest::find($request->requestid)->update([
                        'admin_verify'=> 1
                    ]);
                    return response()->json(['success'=>'درخواست مورد نظر تایید شد.']);
                }else{
                    return response()->json(['permission'=>'تا زمانی که سرپرست درخواست را تایید نکند شما قادر به انجام این کار نمی باشید.']);
                }
            }elseif(Auth::user()->hasRole('Supervisor')){
                $deletereq = ModelsRequest::find($request->requestid)->update([
                    'supervisor_verify'=> 1
                ]);
                return response()->json(['success'=>'درخواست مورد نظر تایید شد.']);
            }
            return true;
        } catch (\Throwable $th) {
            Log::error('error in verify-request : ' . $th);
            return response()->json(['error'=>'خطا در انجام عملیات !']);
        }
    }

}
