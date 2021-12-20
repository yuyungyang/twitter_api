<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\AuthenticateService;

class TwitterController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToTwitter() {
        return Socialite::driver('twitter')->redirect();
    }
    public function handleTwitterCallback() {
        Auth::login('fd7b2976-5f64-11ec-a939-0242ac1a0003');
    }
}
