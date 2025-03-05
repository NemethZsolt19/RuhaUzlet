<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Type as TypeResource;
use App\Models\Type;

class TypeController extends ResponseController
{
    public function newType( Request $request ) {

        //$request->validated();
        $type = new Type();

        $type->type = $request[ "type" ];
        $type->save();

        return $this->sendResponse( new TypeResource( $type ), "Típus kiírva");
    }
}
