<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Projection;
use Carbon\Carbon;
class ProjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
           $movies = Projection::join('movies', 'movies.id', '=', 'projections.movie_id')
           ->distinct('projections.movie_id')
            ->get(['movies.*','movies.title', 'projections.*']);
            if(!$movies){
                return response()->json(['message'=>'Projekcije ne postoje']);
            }else{
                return response()->json(['data'=>$movies]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function deleteExpiredProjection()
    {
        $deleteProjections = Projection::orderBy('id','asc')->where('projections.date', '<',Carbon::today())->get();
        $request = $deleteProjections->delete();
    }
  'projections.id','projections.time','projections.date','projections.hall','projections.price'
  
  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $projection = new Projection;
            $projection->movie_id = $request->movie_id;
            $projection->date = $request->date;
            $projection->time = $request->time;
            $projection->hall = $request->hall;
            $projection->price = $request->price;
            if(!$projection){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $projection->save();
                return response()->json(['message'=>'Uspešno dodata projekcija']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        try{
            // $movies = Projection::where('date', '=', $date)->get();
            $movies = Projection::join('movies', 'movies.id', '=', 'projections.movie_id')
            ->where('projections.date', '=', '' . $date . '')->get();
            if(!$movies){
                return response()->json(['message'=>'Projekcije ne postoje']);
            }else{
                return response()->json(['data'=>$movies]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function getProjectionsByMovieId($id)
    {
        try{
            // $movies = Projection::where('date', '=', $date)->get();
            $projections = Projection::where('movie_id','=', $id)->get();
            if(!$projections){
                return response()->json(['message'=>'Projekcija ne postoji']);
            }else{
                return response()->json(['data'=>$projections]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function getProjectionsById($id)
    {
        try{
            $projections = Projection::join('movies', 'movies.id', '=', 'projections.movie_id')
            ->where('projections.id','=',$id)
            ->get(['movies.title','projections.*']);
            if(!$projections){
                return response()->json(['message'=>'Projekcije ne postoje']);
            }else{
                return response()->json(['data'=>$projections]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function getAllDatesForProjection()
    {
        try{
            $dates = Projection::orderBy('date','asc')
           ->where('projections.date', '>=',Carbon::now())
           ->distinct()
           ->get(['projections.date']);

            if(!$dates){
                return response()->json(['message'=>'Projekcije ne postoje']);
            }else{
                return response()->json(['data'=>$dates]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $projection = Projection::find($request->id);
            $projection->movie_id = $request->movie_id;
            $projection->date = $request->date;
            $projection->time = $request->time;
            $projection->hall = $request->hall;
            $projection->price = $request->price;
            if(!$projection){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $projection->save();
                return response()->json(['message'=>'Uspešno editovana projekcija']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $projection = Projection::find($id);
            if(!$projection){
                return response()->json(['message'=>'Projekcija ne postoji']);
            }else{
                $request = $projection->delete();
                return response()->json(['message'=>'Uspešno obrisana projekcija']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }

}
         
