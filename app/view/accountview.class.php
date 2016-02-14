<?php

class AccountView extends MenuView
{
	protected function edit()
	{
		echo 'Here I edit my account';
//		$profile = Session::get('profile');
//		echo $profile->getFirstname();
//		echo $profile->getLastname();
	}
	
	public function update()
	{
		echo 'here I can update my account';
	}
}

?>