<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index($user_id)
    {
        try{
           $reservations = Reservation::join('projections', 'projections.id', '=', 'reservations.projection_id')
           ->join('movies', 'movies.id', '=', 'projections.movie_id')
           ->where('reservations.user_id','=',$user_id)
           ->orderBy('projections.date','asc')
            ->get(['movies.title','projections.date','projections.time','projections.hall','reservations.id','reservations.total_price','reservations.seats']);
            if(!$reservations){
                return response()->json(['message'=>'Rezervacije ne postoje']);
            }else{
                return response()->json(['data'=>$reservations]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function getReservationById($projection_id)
    {
        try{
           $reservations = Reservation::join('projections', 'projections.id', '=', 'reservations.projection_id')
           ->where('reservations.projection_id', '=', $projection_id )
            ->get(['reservations.seats']);
            if(!$reservations){
                return response()->json(['message'=>'Rezervacije ne postoje']);
            }else{
                return response()->json(['data'=>$reservations]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function store(Request $request)
    {
        try{
            $reservation = new Reservation;
            $reservation->user_id = $request->user_id;
            $reservation->projection_id = $request->projection_id;
            $reservation->seats = $request->seats;
            $reservation->total_price = $request->total_price;

            if(!$reservation){
                return response()->json(['message'=>'Greška sa serverom']);
            }else{
                $request = $reservation->save();
                return response()->json(['message'=>'Uspešno izvršena rezervacija']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try{
            $reservation = Reservation::find($id);
            if(!$reservation){
                return response()->json(['message'=>'Rezervacij ne postoji']);
            }else{
                $request = $reservation->delete();
                return response()->json(['message'=>'Uspešno otkazana rezervacija']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
}
