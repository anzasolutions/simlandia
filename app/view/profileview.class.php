<?php

class ProfileView extends MenuView
{
	protected function account()
	{
		$profile = $this->values->profile;
		$this->template->name = $profile->getFirstname() . SPACE . $profile->getLastname();
		$photo = URL_IMG . 'profile' . DASH . $profile->getGender() . EXT_PNG;
		if ($profile->getAvatar())
		{
			$photo = URL_PHOTOS . $profile->getId() . SLASH . 'profile' . EXT_JPG;
		}
		$this->template->photo = DOMFactory::getLink($this->url->getCustomActionURL('profile', $profile->getLogin()), DOMFactory::getImage($photo)->addClass('photo-frame'));
		$this->template->videoLink = DOMFactory::getLink($this->url->getCustomActionURL('video', 'user', array($profile->getLogin())), 'Videos')->addClass('tahoma-13')->addStyle('margin-right: 6px;');
		$this->template->photosLink = DOMFactory::getLink($this->url->getCustomActionURL('photos', 'user', array($profile->getLogin())), 'Photos')->addClass('tahoma-13')->addStyle('margin-right: 6px;');
		$this->template->friendsLink = DOMFactory::getLink($this->url->getCustomActionURL('friends', 'user', array($profile->getLogin())), 'Friends')->addClass('tahoma-13')->addStyle('margin-right: 6px;');
		$this->template->blogLink = DOMFactory::getLink($this->url->getCustomActionURL('blog', 'user', array($profile->getLogin())), 'Blog')->addClass('tahoma-13')->addStyle('margin-right: 6px;');
		$this->template->show($this->url->getActionPath());
	}
	
}

?>