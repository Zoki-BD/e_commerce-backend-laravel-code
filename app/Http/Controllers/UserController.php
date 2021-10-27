<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Cookie;


class UserController extends Controller
{


   function register(RegisterRequest $request)
   {


      $request->validate([
         'name' => 'required|string',
         'email' => 'required|string|unique:users,email',
         'password' => 'required|string'
      ]);

      $user = new User;

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      $user->username = $request->input('username');
      $user->save();

      //      //return $user;

      // return response($user, Response::HTTP_CREATED);


      $token = $user->createToken('token')->plainTextToken;

      $response = [
         'user' => $user,
         'token' => $token,
      ];

      return response($response, 201);

      //VIP !!!!!! Same
      //   $user = User::create([
      //  'name' => $request->input('name'),
      //  'email' => $request->input('email'),
      //  'password' => Hash::make($request->input('password')),
      //  'username' => $request->input('username'),
      //  ]);
      //    $user->save();

      //  return $user;
   }



   function login(Request $request)
   {

      if (!Auth::attempt($request->only('email', 'password'))) {
         return response()->json([
            'error' => "Nevalidni Podatoci"
         ], Response::HTTP_UNAUTHORIZED);
      }

      $request->validate([
         'email' => 'required|string',
         'password' => 'required|string'
      ]);

      // $user = Auth::user();

      // $token = $user->createToken('token')->plainTextToken;

      // $cookie =cookie('jwt', $token, 60 *24);

      //  return response()
      //  ->json(['jwt' => $token, 'cookie'=>$cookie])
      //  ->withCookie($cookie);

      //Posle cookie - ideme vo Authenticate.php i dodavame handle funkcija koja je kopirame ...


      //Ova e po nacinot bez cookie i token so sanctum.
      //// I Vaka go dobivame userot, ne mora kako dole: $user = Auth::user();

      $user = User::where('email', $request->email)->first();

      if (!$user || !Hash::check($request->password, $user->password)) {
         return ['error' => "Email or password are not matched"];
      };

      //Check password
      if (!$user || !Hash::check($request->password, $user->password)) {
         return response(['error' => "Email or password are not matched"], 401);
      };

      $token = $user->createToken('token')->plainTextToken;

      $response = [
         'user' => $user,
         'token' => $token,
      ];
      return response($response, 201);
      // return $user;
   }

   public function user(Request $request)
   {
      return $request->user();
   }


   public function logout(Request $request)
   {
      //Gives error tokens() is not method
      //auth()->user()->tokens()->delete();

      //ako ideme so request a ne preku auth() mora da odime prkeu id na userot logiran
      $user = request()->user();
      $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

      return response()
         ->json(['message' => "Uspesno"]);
   }
}
