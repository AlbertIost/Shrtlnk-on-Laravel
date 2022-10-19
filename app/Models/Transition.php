<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function link(){
        return $this->belongsTo(Link::class);
    }
}
