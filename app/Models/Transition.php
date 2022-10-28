<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function link(){
        return $this->belongsTo(Link::class);
    }
    public static function Add(Link $link){
        $transition = new Transition();
        $transition->link_id = $link->id;
        $transition->created_on = Carbon::now();
        $transition->save();

        $link->clicks++;
        $link->save();
    }
}
