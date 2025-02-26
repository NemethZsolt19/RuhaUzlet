<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Brand;
// use App\Models\Material;
// use App\Models\Type;
use App\Models\Clothes;


class ClothesController extends Controller
{
    public function getClothes() {
        $clothes = Clothes::with("type", "material", "brand")->get();

        return $this->sendResponse( ClothesResource::collection( $clothes ), "Betöltés");
    }
    public function getCloth( Request $request ){
        $cloth = Cloth::where( "ruha", $request[ "ruha" ])->first();

        return $this->sendResponse( new ClothResource( $cloth ), "Betöltve" );
    }
}
