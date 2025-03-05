<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Brand;
// use App\Models\Material;
// use App\Models\Type;
use App\Models\Clothes;
use App\Http\Resources\Clothes as ClothesResponse;
use App\Http\Controllers\api\ResponseController;


class ClothesController extends Controller
{
    public function getClothes() {
        $clothes = Clothes::with("type", "material", "brand")->get();

        // return $this->sendResponse( ClothesResource::collection( $clothes ), "Betöltés");
    }
    public function getCloth( Request $request ){
        $cloth = Cloth::where( "ruha", $request[ "ruha" ])->first();

        return $this->sendResponse( new ClothesResource( $cloth ), "Betöltve" );
    }
}
