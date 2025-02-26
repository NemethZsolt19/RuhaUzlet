<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Brand;
use App\Http\Models\Material;
use App\Http\Models\Type;


class ClothesController extends Controller
{
    public function getClothes() {
        $clothes = Cloth::with()->get();

        return $this->sendResponse( ClothesResource::collection( $clothes ), "Betöltés");
    }
    public function getCloth( Request $request ){
        $cloth = Cloth::where( "ruha", $request[ "ruha" ])->first();

        return $this->sendResponse( new ClothResource( $cloth ), "Betöltve" );
    }

    public function isAdmin() {
        if( !Gate::allows( "status" )) {
            return "status";
        }
        return "nem vásárló";
    }
}
