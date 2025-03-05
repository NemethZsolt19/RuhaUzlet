<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Material;
use App\Models\Type;
use App\Models\Clothes;
use App\Http\Resources\Clothes as ClothesResource;
use App\Http\Resources\Brand as BrandResource;
use App\Http\Resources\Material as MaterialResource;
use App\Http\Resources\Type as TypeResource;
use App\Http\Controllers\api\ResponseController;


class ClothesController extends ResponseController
{
    public function getClothes() {
        $clothes = Clothes::with("type", "material", "brand")->get();

        return $this->sendResponse( ClothesResource::collection( $clothes ), "Betöltés");
    }
    public function getCloth( Request $request ){
        $cloth = Cloth::where( "ruha", $request[ "ruha" ])->first();

        return $this->sendResponse( new ClothesResource( $cloth ), "Betöltve" );
    }

    public function newCloth( Request $request ) {

        //$request->validated();
        $cloth = new Clothes();
        $cloth->type_id = ( new TypeController )->getTypeId( $request[ "type" ]);
        $cloth->brand_id = ( new BrandController )->getBrandId( $request[ "brand" ]);
        $cloth->material_id = ( new MaterialController )->getMaterialId( $request[ "material" ]);

        $cloth->save();

        return $cloth;
    }



    public function brand() {
        $brands = Clothes::with( "brand" )->get();
        return $this->sendResponse( BrandResource::collection( $brands ), "Betöltve" );
    }

    public function material() {
        $materials = Clothes::with( "material" )->get();
        return $this->sendResponse( MaterialResource::collection( $materials ), "Betöltve" );
    }

    public function type() {
        $types = Clothes::with( "type" )->get();
        return $this->sendResponse( TypeResource::collection( $types ), "Betöltve" );
    }
}
