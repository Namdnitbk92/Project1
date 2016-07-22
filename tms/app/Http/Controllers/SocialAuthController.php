<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SocialAccountService;

use Socialite;

class SocialAuthController extends Controller
{

	public function redirect($driver) {
		return Socialite::driver($driver)->redirect();
	}

	public function callback(SocialAccountService $service) {

		$user = $service->createOrGetUser(Socialite::driver('facebook')->user(),'facebook');

        auth()->login($user);

        return redirect()->to('/home');
	}

	public function callbackTwitter(SocialAccountService $service) {

		$user = $service->createOrGetUser(Socialite::driver('twitter')->user(),'twitter');

        auth()->login($user);

        return redirect()->to('/home');
	}

	public function callbackGmail(SocialAccountService $service) {

		$user = $service->createOrGetUser(Socialite::driver('google')->user(),'gmail');

        auth()->login($user);

        return redirect()->to('/home');
	}

}
