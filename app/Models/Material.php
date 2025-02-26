<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function clothes() {
        return $this->hasMany( Clothes::class );
    }
}
