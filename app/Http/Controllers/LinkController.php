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
        $validate = $request->validate([
            'link' => 'bail|required|url'
        ]);
        $link = Link::where('link', $validate['link'])->first();
        if($link === null){
            $validate = $request->validate([
                'link' => 'bail|required|url',
                'alias' => 'bail|nullable|unique:links,token|max:16',
                'password' => 'nullable|string'
            ]);

            $newLink = new Link();
            $newLink->link = $validate['link'];
            $newLink->password = $validate['password'] != null ? Hash::make($validate['password']) : null;
            $newLink->token = $validate['alias'];
            $newLink->active_before = null;
            $newLink->group_id = null;
            $newLink->user_id = auth()->user() ? auth()->user()->id : null;
            $newLink->save();

            return view('mainPage', ['short_url' => URL::to('/') . '/' . $validate['token']]);
        }

        $token = $link->token;

        return view('mainPage', ['short_url' => URL::to('/') . '/' . $token]);
    }
    public function CreateShortLink(Request $request){
        $validate = $request->validate([
            'link' => 'bail|required|unique:links|url',
            'alias' => 'bail|nullable|unique:links,token|max:16',
            'active_before' => 'nullable|date',
            'password' => 'nullable|string'
        ]);

        $link = $request->input('link');
        $alias = $request->input('alias');
        $group = $request->input('group');
        $password = $request->input('password');
        $active_before = $request->input('active_before') ? Carbon::parse($request->input('active_before')) : null;

        if(Group::find($group) === null && $group != 'no'){
            return redirect(route('user.links.create'))->withErrors([
               'group' => 'The selected group is invalid.'
            ]);
        }

        Link::firstOrCreate(
            [
                'link' => $link
            ],
            [
                'token' => $alias ?? self::GetNewToken(),
                'group_id' => $group == 'no' ? null : '2',
                'password' => $password != null ? Hash::make($password) : null,
                'active_before' => $active_before,
                'user_id' => auth()->user()->id
            ]
        );
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
