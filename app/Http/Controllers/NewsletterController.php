<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function Newsletter(Request $request ){
        try{
            $newsletter = new Newsletter;
            $newsletter->email = $request->email;
            if(!$newsletter){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $newsletter->save();
                return response()->json(['message'=>'Uspešno ste se prijavili']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
}
