<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'firstName' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);
            $user = User::create([
            'firstName' => $fields['firstName'],
            'lastName' => $fields['lastName'],
            'role' => 'user',
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Pogrešan email i lozinka'
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
    public function getUserById($id)
    {
        try{
           $user = User::where('users.id', '=', $id)
            ->get();
            if(!$user){
                return response()->json(['message'=>'Korisnik ne postoji']);
            }else{
                return response()->json(['data'=>$user]);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
    public function updateUser (Request $request)
    {
        try{
            $user = User::find($request->id);
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            if(!$user){
                return response()->json(['message'=>'Error']);
            }else{
                $request = $user->save();
                return response()->json(['message'=>'Uspesno editovan profil']);
            }
        }catch(\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }
    }
}
