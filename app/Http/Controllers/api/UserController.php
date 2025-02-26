<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends ResponseController
{
    public function register( UserRegisterRequest $request ) {

        $request->validated();

        $user = User::create([

            "name" => $request["name"],
            "email" => $request["email"],
            "status" => 0
        ]);

        return $this->sendResponse( $user->name, "Sikeres regisztráció");
    }

    public function login( UserLoginRequest $request ) {

        $request->validated();

        if( Auth::attempt([ "name" => $request["name"], "email" => $request["email"] ]) ) {

            $actualTime = Carbon::now();
            $authUser = Auth::user();
            $bannedTime = ( new BannerController )->getBannedTime( $authUser->name );
            ( new BannerController )->reSetLoginCounter( $authUser->name );

            if( $bannedTime < $actualTime ) {

                ( new BannerController )->resetBannedTime( $authUser->name );
                $token = $authUser->createToken( $authUser->name."Token" )->plainTextToken;
                $data["user"] = [ "user" => $authUser->name ];
                $data[ "time" ] = $bannedTime;
                $data[ "status" ] = $authUser->admin;
                $data["token"] = $token;

                return $this->sendResponse( $data, "Sikeres bejelentkezés");

            }else {

                return $this->sendError( "Autentikációs hiba", [ "Következő lehetőség: ", $bannedTime ], 401 );
            }
        }else {

            $loginCounter = ( new BannerController )->getLoginCounter( $request[ "name" ]);
            if( $loginCounter < 3 ) {

                ( new BannerController )->setLoginCounter( $request[ "name" ]);

                return $this->sendError( "Autentikációs hiba", "Hibás felhasználónév vagy jelszó", 401 );

            }else {

                ( new BannerController )->setBannedTime( $request[ "name" ]);
                $bannedTime = ( new BannerController )->getBannedTime( $request[ "name" ]);
                ( new MailController )->sendMail( $request[ "name" ], $bannedTime );

                $errorMessage = [ "message" => "Következő lehetőség:", "time" => $bannedTime ];

                return $this->sendError( "Autentikációs hiba", [$errorMessage], 401 );
            }


        }
    }

    public function logout() {

        auth( "sanctum" )->user()->currentAccessToken()->delete();
        $name = auth( "sanctum" )->user()->name;

        return $this->sendResponse( $name, "Sikeres kijelentkezés");
    }



        public function getTokens() {

        $tokens = DB::table( "personal_access_tokens" )->get();

        return $tokens;
    }
}
