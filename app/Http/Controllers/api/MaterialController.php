<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Material as MaterialResource;
use App\Models\Material;

class MaterialController extends ResponseController
{
    public function newMaterial( Request $request ) {

        //$request->validated();
        $material = new Material();

        $material->matetial = $request[ "material" ];
        $material->save();

        return $this->sendResponse( new MaterialResource( $material ), "Anyag kiírva");
    }
}
