<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function CountTransitions() : int {
        $user = auth()->user();
        $sum = 0;
        foreach ($user->link as $link){
            $sum += $link->transition->count();
        }
        return $sum;
    }

    public function CountTransitionsToday() : int {
        $user = auth()->user();
        $sum = 0;
        foreach ($user->link as $link){
            foreach($link->transition as $transition){
                if(Carbon::parse($transition->created_on)->diffInHours(Carbon::now()) <= 24){
                    $sum++;
                }
            }
        }
        return $sum;
    }
    public function CountTransitionsInMonth() : int {
        $user = auth()->user();
        $sum = 0;
        foreach ($user->link as $link){
            foreach($link->transition as $transition){
                if(Carbon::parse($transition->created_on)->isCurrentMonth()){
                    $sum++;
                }
            }
        }
        return $sum;
    }

    public function link(){
        return $this->hasMany(Link::class);
    }
    public function group(){
        return $this->hasMany(Group::class);
    }

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;
}
