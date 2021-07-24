<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;


class LoginSteamController extends Controller
{
    public function redirectToSteam()
    {
        return Socialite::driver('steam')->redirect();
    }

    public function redirectCallback()
    {
        $steam = Socialite::driver('steam')->user();

        session()->put('steam', $steam);
        session()->put('steamInfo', $steam->user);

        notify()->success('Logged In');

        return redirect('/'.$steam->id);
    }

    public function LogOut()
    {
        session()->forget('steam');
        session()->forget('steamInfo');

        notify()->success('Logged Out');

        return redirect('/');
    }
}
