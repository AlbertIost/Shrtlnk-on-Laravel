<?php

namespace App\Http\Controllers;

use App\Models\Transition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function RedirectByToken($token){
        $link = Link::where('token', '=', $token)->first();

        if($link != null){
            Transition::Add($link);

            return redirect($link->link);
        }
        else
            return abort(404);
    }
    public function LongToShort(Request $request){
        $link = $request->input('link');

        $row = Link::firstOrCreate(
            [
                'link' => $link
            ],
            [
                'token' => self::GetNewToken(),
                'active_before' => Carbon::now()->addDays(7),
                'user_id' => auth()->user() ? auth()->user()->id : null
            ]
        );


        return URL::to('/') .'/'. $row->token;
    }
    private function GetNewToken() : string{
        do{
            $token = Str::random(10);
        } while(Link::where('token', '=', $token)->first() != null);
        return $token;
    }
    public function ShowUserLinks(Request $request){
        $links = Link::where('user_id', auth()->user()->id)->get();

        return view('user.my_links', $links);
    }
}
