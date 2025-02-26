<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    public $timestamps = false;

    public function type() {
        return $this->belongsTo( Type::class );
    }

    public function brand() {
        return $this->belongsTo( Brand::class );
    }

    public function material() {
        return $this->belongsTo( Material::class );
    }
}
