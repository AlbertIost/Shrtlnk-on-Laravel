<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function link(){
        return $this->hasMany(Link::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
