<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function ShortToLong($token){
        $link = Link::where('token', '=', $token)->first();

        if($link != null && $link->link)
            return redirect($link->link);
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
                'must_be_deleted_on' => Carbon::now()->addDays(7)
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
}
