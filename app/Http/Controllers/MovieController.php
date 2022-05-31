<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $movies = Movie::all();
            if(!$movies){
                return response()->json(['message'=>'Filmovi ne postoje']);
            }else{
                return response()->json(['data'=>$movies]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function comingSoon()
    {
        try{
            $movies = Movie::where('coming_soon', '=', 'Da')->get();
            if(!$movies){
                return response()->json(['message'=>'Data is not available']);
            }else{
                return response()->json(['data'=>$movies]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function currentMovies()
    {
        try{
            $movies = Movie::where('coming_soon', '=', 'Ne')->get();
            if(!$movies){
                return response()->json(['message'=>'Data is not available']);
            }else{
                return response()->json(['data'=>$movies]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $movie = new Movie;
            $movie->title = $request->title;
            $movie->english_title = $request->english_title;
            $movie->director = $request->director;
            $movie->actors = $request->actors;
            $movie->genre = $request->genre;
            $movie->duration = $request->duration;
            $movie->distributor = $request->distributor;
            $movie->country_of_origin = $request->country_of_origin;
            $movie->year_of_production = $request->year_of_production;
            $movie->description = $request->description;
            $movie->trailer = $request->trailer;
            $movie->coming_soon = $request->coming_soon;
            $movie->image = $request->image;
            $movie->broadcast_date = $request->broadcast_date;
            if(!$movie){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $movie->save();
                return response()->json(['message'=>'Uspešno dodat film']);
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
    public function show($id)
    {
        try{
            $movie = Movie::find($id);
            if(!$movie){
                return response()->json(['message'=>'Film ne postoji']);
            }else{
                return $movie;
                return response()->json(['data'=>$movie]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $movie = Movie::find($request->id);
            $movie->title = $request->title;
            $movie->english_title = $request->english_title;
            $movie->director = $request->director;
            $movie->actors = $request->actors;
            $movie->genre = $request->genre;
            $movie->duration = $request->duration;
            $movie->distributor = $request->distributor;
            $movie->country_of_origin = $request->country_of_origin;
            $movie->year_of_production = $request->year_of_production;
            $movie->description = $request->description;
            $movie->trailer = $request->trailer;
            $movie->coming_soon = $request->coming_soon;
            $movie->image = $request->image;
            $movie->broadcast_date = $request->broadcast_date;
            if(!$movie){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $movie->save();
                return response()->json(['message'=>'Uspešno editovan film']);
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
            $movie = Movie::find($id);
            if(!$movie){
                return response()->json(['message'=>'Film ne postoji']);
            }else{
                $request = $movie->delete();
                return response()->json(['message'=>'Uspešno obrisan film']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
}
