<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\ImageUpload;
use App\Models\Appends;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{


    public function fileCreate()
    {
        $user = Auth::user()->created_at;
        dd(\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($user)));
        return view('imageupload');
    }
    /** zakhirehye file haye peyvast shode */
    public function fileStore(Request $request)
    {
        Validator::make($request->toArray(), [
            'title' => ['required', 'string', 'max:255'],
            'descryption' => ['max:1000'],
            // 'file' => ['mimetypes:video/*,image/*,application/pdf'],
        ])->validate();
        $addrequest = RequestModel::create([
        'user_id' => Auth::user()->id,
        'title'=> $request->title,
        'descryption'=> $request->descryption,
        'priority' => $request->priority
        ]);
        $date = \Morilog\Jalali\CalendarUtils::strftime('Y-m-d/H:i:s', strtotime($addrequest->created_at));
        $date = \Morilog\Jalali\CalendarUtils::convertNumbers($date);
        $createdtime = $date;
        $files = $request->file('file');
        $responseFiles = array();
        foreach($files as $file){
            // Log::info($file->getClientOriginalName());
            $fileName = $file->getClientOriginalName();
            if($fileName == 'blob'){
                break;
            }
            $file->move(public_path('storage/files'), $fileName);
            $append = Appends::create([
                'request_id' => $addrequest->id,
                'path' => 'storage/files/' . $fileName
            ]);
            array_push($responseFiles , 'storage/files/' . $fileName);
        }
        // return response()->json(['success' => $fileName]);
        return response()->json([
            'responseFiles'=>$responseFiles,
            'name'=>$addrequest->user->name,
            'request'=>$addrequest->toArray(),
            'createdtime'=>$createdtime,
            'priority'=>$request->priority,]);

    }
    /** hazf peyvast */
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        $delete = Appends::where('path', 'storage/files/' . $filename)->delete();
        $path = public_path() . '/storage/files/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
