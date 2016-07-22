<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;


class SocialAccountService {


	public function createOrGetUser(ProviderUser $providerUser, $typeAccount) {
		
		$account = SocialAccount::whereProvider($typeAccount)
	            ->whereProviderUserId($providerUser->getId())
	            ->first();

	       if ($account) {
	            return $account->user;
	       } else {
	        	$account = new SocialAccount([
	                'provider_user_id' => $providerUser->getId(),
	                'provider' => $typeAccount,
	                'avatar' => $providerUser->getAvatar()
	            ]);	

	             $user = User::whereEmail($providerUser->getEmail())->first();

	            if (!$user) {

	                $user = User::create([
	                    'email' => $providerUser->getEmail(),
	                    'name' => $providerUser->getName(),
	                    'avatar' => $providerUser->getAvatar()
	                ]);
	            }

	            $account->user()->associate($user);
	            $account->save();

	            return $user;

	        }
	}

}



