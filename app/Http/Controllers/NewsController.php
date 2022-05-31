<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function getNews($paginate){
        try{
            $news = News::orderBy('id','desc')->paginate($paginate);
             if(!$news){
                 return response()->json(['message'=>'Vesti ne postoje']);
             }else{
                 return response()->json(['data'=>$news]);
             }
         }catch(\Exception $exception){
             return response()->json(['message'=>$exception->getMessage()]);
         }
    }
    public function store(Request $request)
    {
        try{
            $news = new News;
            $news->title = $request->title;
            $news->description = $request->description;
            $news->image = $request->image;
            if(!$news){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $news->save();
                return response()->json(['message'=>'Uspešno dodata vest']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try{
            $news = News::find($id);
            if(!$news){
                return response()->json(['message'=>'Vest ne postoji']);
            }else{
                $request = $news->delete();
                return response()->json(['message'=>'Uspešno obrisana vest']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function show($id)
    {
        try{
            $news = News::find($id);
            if(!$news){
                return response()->json(['message'=>'Ne postoji vest']);
            }else{
                return $news;
                return response()->json(['data'=>$news]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        try{
            $news = News::find($request->id);
            $news->title = $request->title;
            $news->description = $request->description;
            $news->image = $request->image;
            if(!$news){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $news->save();
                return response()->json(['message'=>'Uspešno obrisana vest']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
        
    }

}
