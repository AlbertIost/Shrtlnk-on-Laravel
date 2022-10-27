<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
    public static function GetNewToken() : string{
        do{
            $token = Str::random(10);
        } while(Link::where('token', '=', $token)->first() != null);
        return $token;
    }
    public function IsActive() : bool{
        if($this->active_before === null)
            return true;

        return Carbon::parse($this->active_before)->gt(Carbon::now());
    }

    public function GetShortLink(){
        return URL::to(route('shortLink', $this->token));
    }
}
