<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function Owner()
    // {
    //     return $this->belongsTo(Owner::class,'added_by','id');
    // }

    public function Owner() {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
