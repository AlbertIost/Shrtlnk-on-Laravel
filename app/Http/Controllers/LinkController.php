<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Transition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Termwind\Components\Li;

class LinkController extends Controller
{
    public function ShortToLong($token){
        $link = Link::where('token', '=', $token)->first();

        if($link != null){
            if($link->password === null){
                return self::Redir($link);
            }
            else{

            }
        }
        else
            return abort(404);
    }
    private function Redir(Link $link){
        Transition::Add($link);
        return redirect($link->link);
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

            $newLink = Link::create([
                'link' => $validate['link'],
                'token' => $validate['alias'] ?? Link::GetNewToken(),
                'group_id' => null,
                'password' => $validate['password'] !== null ? Hash::make($validate['password']) : null,
                'active_before' => null,
                'created_at' => Carbon::today(),
                'user_id' => auth()->user() ? auth()->user()->id : null
            ]);

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

        Link::create([
            'link' => $link,
            'token' => $alias ?? Link::GetNewToken(),
            'group_id' => $group == 'no' ? null : '2',
            'password' => $password != null ? Hash::make($password) : null,
            'active_before' => $active_before,
            'created_at' => Carbon::today(),
            'user_id' => auth()->user()->id
        ]);
        return redirect(route('user.links'));
    }

    public function GetUserLinks(Request $request){
        $user = auth()->user();
        $links = Link::where('user_id', $user->id);

        $created_from = $request->input('created_from');
        $created_to = $request->input('created_to');

        $sort_by = $request->input('sort_by');
        $sort_by = in_array($sort_by, ['clicks', 'created_at']) ? $sort_by : 'clicks';

        $order_by = $request->input('order_by');
        $order_by = in_array($order_by, ['asc', 'desc']) ? $order_by : 'asc';

        $group = $request->input('group');

        if(is_numeric($group)){
            $links->where('group_id', $group === '0' ? null : $group);
        }

        if(isset($created_from)){
            $correct = true;
            try{
                Carbon::parse($created_from);
            }
            catch(InvalidFormatException){
                $correct = false;
            }
            if($correct)
                $links = $links->where('created_at', '>=', $created_from);
        }
        if(isset($created_to)){
            $correct = true;
            try{
                Carbon::parse($created_to);
            }
            catch(InvalidFormatException $e){
                $correct = false;
            }
            if($correct)
                $links = $links->where('created_at', '<=', $created_to);
        }

        $links = $links->orderBy($sort_by, $order_by);

        return view('user.my_links', ['links' => $links->get()]);
    }
}
