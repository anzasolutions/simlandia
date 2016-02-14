<?php

/**
 * View to be used for pages with menu.
 * @author anza
 * @version 27-11-2010
 */
abstract class MenuView extends AbstractView
{
	// @Override
	public function header()
	{
		if (Session::getInstance()->isStarted())
		{
			$this->template->formLogin = $this->template->getTemplate('common', 'welcome');
			$this->template->logout = DOMFactory::getLink($this->url->getCustomActionURL('account', 'logout'), Bundle::get('link.menu.logout'));
			$this->template->editProfile = DOMFactory::getLink($this->url->getCustomActionURL('account', 'edit'), Bundle::get('link.menu.profile.edit'));
			$this->template->credentials = Session::get('user')->getFirstname() . SPACE . Session::get('user')->getLastname();
			$this->template->profile = $this->prepareAvatar(Session::get('user'));
			$this->prepareMainLinks();
		}
		else
		{
			$this->template->formLogin = $this->template->getTemplate('common', 'quickLogin');
			$this->template->loginAction = $this->url->getCustomActionURL('auth');
			$this->prepareRegisterLink();
			$this->prepareWelcomeMessage();
		}
		$this->template->show(__FUNCTION__);
	}
	
	protected function prepareAvatar($user)
	{
		$avatar = URL_IMG . 'avatar' . DASH . $user->getGender() . EXT_PNG;
		if ($user->getAvatar())
		{
			$avatar = URL_PHOTOS . $user->getId() . SLASH . 'avatar' . EXT_JPG;
		}
		return DOMFactory::getLink($this->url->getCustomActionURL('profile', $user->getLogin()), DOMFactory::getImage($avatar));
	}
	
	private function prepareRegisterLink()
	{
		$this->template->registerLabel = Bundle::get('link.header.register.label');
		$this->template->registerLink = DOMFactory::getLink($this->url->getCustomActionURL('register'), Bundle::get('link.header.register.link'))->addClass('bold');
	}
	
	private function prepareMainLinks()
	{
		$friendsLink = DOMFactory::getLink($this->url->getCustomActionURL('friends'), Bundle::get('link.header.friends.link'))->addClass('bold tahoma-13');
		$friendsFindLink = DOMFactory::getLink($this->url->getCustomActionURL('friends', 'find'), Bundle::get('link.header.friends.find.link'))->addClass('bold tahoma-13');
		$videoLink = DOMFactory::getLink($this->url->getCustomActionURL('video'), Bundle::get('link.header.video'))->addClass('bold tahoma-13');
		$addVideoLink = DOMFactory::getLink($this->url->getCustomActionURL('video', 'add'), Bundle::get('link.header.video.add'))->addClass('bold tahoma-13');
		$this->template->friendsLink = DOMFactory::getLi($friendsLink);
		$this->template->friendsFindLink = DOMFactory::getLi($friendsFindLink);
		$this->template->videoLink = DOMFactory::getLi($videoLink);
		$this->template->addVideoLink = DOMFactory::getLi($addVideoLink);
	}
	
	private function prepareWelcomeMessage()
	{
		$text = 'Simlandia helps you connect and share with the people in your life.';
		$welcomeMessage = DOMFactory::getDiv($text)->addClass('bold');
		$this->template->welcomeMessage = DOMFactory::getLi($welcomeMessage);
	}
}

?>