<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ClothesController extends Controller
{
    public function getClothes() {
        $clothes = Cloth::with()->get();

        return $this->sendResponse( ClothesResource::collection( $clothes ), "Betöltés");
    }
    public function getCloth( Request $request ){
        $cloth = Cloth::where( "ruha", $request[ "ruha" ])->first();

        return $this->sendResponse( new ClotchResource( $cloth ), "Betöltve" );
    }

    public function isAdmin() {
        if( !Gate::allows( "status" )) {
            return "status";
        }
        return "nem vásárló";
    }
}
