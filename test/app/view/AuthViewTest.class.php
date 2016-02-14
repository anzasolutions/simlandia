<?php

// TODO: MUST BE FIXED!!!!!!! 
class AuthViewTest
{
	public function header()
	{
//		$this->template->formLogin = $this->template->getTemplate($this->url->getActionPath('formLogin'));
//		echo 'it\'s a AuthView header';
//		echo $this->testGetLatestLogin();
//		echo $this->testGetUser(65);
//		$user = $this->testGetUser2(66);
//		$user->setLastname('Lolo');
//		$user->setFirstname('Czololokoko');
//		$this->testSave($user);
//		echo $this->testGetUser(66);
//		$user = $this->testGetUser2(69);
//		$this->testDelete($user);
//		$user->setLastname('Zenio');
//		$user->setFirstname('Pierdzioch');

//		$user->setId(0);
//		$user->setLogin('zenek11');
//		$user->setEmail('zenek11@zenek.com');
//		$user->setPassword('kajtek');
//		$this->testSave($user);
		
//		echo $this->testGetUser(69);
//		$this->testIncorrectTypeSave();
//		parent::__construct();
		parent::header();
	}
	
	private function testGetLatestLogin()
	{
		$users = $this->model->getLatestLogin();
		
		foreach ($users as $user)
		{
//			$id = $user->isOnline() ? GenderEnum::WOMAN : '';
			
//			$image = $this->getAvatarImage($user);
			$output .= $user->getFirstname();
			$output .= $user->getId();
//			$output .= $this->html->divBegin('', 'id' . $id) . $this->html->linkBegin(URL_PROFILE . $user->getId(), '', $user->getFirstname()) . $this->html->imageBegin($image);
//			$output .= $this->html->imageEnd() . $this->html->linkEnd() . $this->html->divEnd();
		}
		
		return $output;
	}
	
	private function testGetUser($id)
	{
		$user = $this->model->getUser($id);
		$output .= $user->getFirstname();
		$output .= $user->getId();
		
//		$this->vars = ReflectionUtil::getProperties($user);
//		print_r($this->vars);
		
		return $output;
	}
	
	private function testGetUser2($id)
	{
		return $this->model->getUser($id);
	}
	
	private function testSave($user)
	{
		$this->model->save($user);
	}
	
	private function testDelete($user)
	{
		$this->model->delete($user);
	}
	
	private function testIncorrectTypeSave()
	{
		$image = new Image();
		$this->model->save($image);
	}
}

?>