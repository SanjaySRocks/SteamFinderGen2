<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SteamID;
use Steam as Steam2;

class SteamController extends Controller
{
    public function search(Request $request)
    {
        $apikey = env('STEAM_API_KEY');
        $id = $request->steamid;

        $id = str_ireplace("https://", "", $id);
        $id = str_ireplace("http://", "", $id);
        $id = str_ireplace("steamcommunity.com/id/", "", $id);
        $id = str_ireplace("steamcommunity.com/profiles/", "", $id);
        $id = str_ireplace("/", "", $id);
        $id = str_ireplace("\\", "", $id);
        $id = str_ireplace(" ", "", $id);


        $player = Steam2::user()->ResolveVanityURL($id);

        // dd($player->id64);

        if($player != "No match")
        {
            $id = $player->id64;

            notify()->success('Steam ID Found');
            return redirect('/' .$id);
        }
        else
        {
            try
            {
                $s = new SteamID($id);
                $id = $s->ConvertToUInt64();

                notify()->success('Steam ID Found');
                return redirect('/' .$id);
            }
            catch(\InvalidArgumentException $e)
            {
                notify()->error('Given SteamID could not be parsed.');
                return back();
            }
        } 
    }

    public function show($id)
    {
        $s = new SteamID($id);
        if(!$s->IsValid())
            return redirect('/')->with('error', 'Failed to get data please check id!');

        $apikey = env('STEAM_API_KEY');
        $data = Http::get('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$apikey.'&steamids='.$id)->json();
        $collection=collect($data);

        if(empty($collection['response']['players'][0]))
            return redirect('/')->with('error', 'Failed to get data please check id!');

        $id64temp = $collection['response']['players'][0]['steamid'];

        try
        {
            $s = new SteamID($id64temp);
        }
        catch( InvalidArgumentException $e )
        {
            echo 'Given SteamID could not be parsed.';
        }

        $data['si64'] = $collection['response']['players'][0]['steamid'];
        $data['cvs'] = $collection['response']['players'][0]['communityvisibilitystate'];
        $data['prs'] = $collection['response']['players'][0]['profilestate'];
        $data['pn'] = $collection['response']['players'][0]['personaname'];
        $data['purl'] = $collection['response']['players'][0]['profileurl'];
        $data['av'] = $collection['response']['players'][0]['avatar'];
        $data['avm'] = $collection['response']['players'][0]['avatarmedium'];
        $data['avf'] = $collection['response']['players'][0]['avatarfull'];
        $data['avhash'] = $collection['response']['players'][0]['avatarhash'];
        $data['ps'] = $collection['response']['players'][0]['personastate'];

        if(!empty($collection['response']['players'][0]['realname']))
            $data['rn'] = $collection['response']['players'][0]['realname'];
        else
            $data['rn'] = "";
        
        $data['pcid'] = $collection['response']['players'][0]['primaryclanid'];
        $data['createdat'] = $collection['response']['players'][0]['timecreated'];
        $data['psf'] = $collection['response']['players'][0]['personastateflags'];

        $data['steam3'] = $s->RenderSteam3();
        $data['steam32'] = $s->RenderSteam2();
        $data['profile2'] = 'http://steamcommunity.com/profiles/'.$data['si64'].'/';

        $pbans = Steam2::user($id64temp)->GetPlayerBans()[0];
        $bans['cb'] = $pbans->CommunityBanned;
        $bans['vb'] = $pbans->VACBanned;
        $bans['novb'] = $pbans->NumberOfVACBans;
        $bans['dslb'] = $pbans->DaysSinceLastBan;
        $bans['nogb'] = $pbans->NumberOfGameBans;
        $bans['eb'] = $pbans->EconomyBan;

        return view('steaminfo', compact('data','bans'));
    }
}
