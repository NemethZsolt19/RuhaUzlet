<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Resources\Brand as BrandResource;

class BrandController extends ResponseController
{
    public function newBrand( Request $request ) {

        //$request->validated();
        // hrhrhrhr
        $brand = new Brand();

        $brand->brand = $request[ "brand" ];
        $brand->save();

        return $this->sendResponse( new BrandResource( $brand ), "Márka kiírva");
    }
}
