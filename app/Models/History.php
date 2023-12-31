<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public function Building()
    {
        return $this->belongsTo(History::class,'building_id','id');
    }


    public function Owner() {
        return $this->belongsTo(Owner::class,'owner_id','id');
    }

}
