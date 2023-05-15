<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserControllser extends Controller
{
    
    public function dashboard(){
        if(Auth::user()->hasRole("Normal")){
            $requests = Auth::user()->requests;
        }else{
            if(Auth::user()->hasRole("Admin")){
                $requests = ModelsRequest::where('supervisor_verify',1)->orderBy('id','desc')->get();
            }else{
                $requests = ModelsRequest::orderBy('id','desc')->get();
            }
        }
        // $addrequest['created_at'] = \Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($addrequest->created_at));
        return view('dashboard',compact('requests'));
    }

    public function index()
    {
        $user = Auth::user();
        $user->assignRole('Admin');
    }
    public function blog()
    {
        $user = Auth::user();
        $user->assignRole('Editor');
    }
    public function create(): View
    {
        
        return view('users.create');
    }

}
