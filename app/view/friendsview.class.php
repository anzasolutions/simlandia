<?php

/**
 * Handle friends view.
 * @author anza
 * @version 03-10-2010
 */
class FriendsView extends MenuView
{
	public function index()
	{
		$this->wall();
	}
	
	private function wall()
	{
		if (sizeof($this->values->users) > 0)
		{
			foreach ($this->values->users as $user)
			{
				$this->template->profiles .= $this->avatar($user);
			}
		}
		$this->template->show($this->url->getActionPath(__FUNCTION__));
	}
	
	protected function avatar($user)
	{
		$avatar = URL_IMG . 'avatar' . DASH . $user->getGender() . EXT_PNG;
		if ($user->getAvatar())
		{
			$avatar = URL_PHOTOS . $user->getId() . SLASH . 'avatar' . EXT_JPG;
		}
		return DOMFactory::getLink($this->url->getCustomActionURL('profile', $user->getLogin()), DOMFactory::getImage($avatar))->addClass('avatar');
	}
	
	protected function find()
	{
		$this->template->formAction = $this->url->getActionURL(__FUNCTION__);
		if ($this->request->error)
		{
			$this->template->message = DOMFactory::getDiv($this->request->error)->addClass('error');
		}
		$this->template->name = $this->values->name;
		$this->template->show($this->url->getActionPath());
		$this->wall();
	}
	
	// TODO: is this even to be used anywhere?
	public function callUser()
	{
		$this->find();
	}
}

?>