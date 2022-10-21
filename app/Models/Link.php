<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function transition(){
        return $this->hasMany(Transition::class);
    }
    public function CountTransitions() : int {
        return $this->transition->count();
    }
}
