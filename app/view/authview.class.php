<?php

/**
 * @author anza
 * @since 03-10-2010
 */
class AuthView extends MenuView
{
	public function login()
	{
		$this->template->formAction = $this->url->getActionURL(__FUNCTION__);
		$this->prepareRequest();
		$this->template->show($this->url->getActionPath());
	}
	
	// TODO: repeated in RegisterView and should be commoned
	private function prepareRequest()
	{
		if ($this->request->error)
		{
			foreach ($this->request->getValues() as $key => $value)
			{
				$this->template->$key = $value;
			}
			$this->template->message = DOMFactory::getDiv($this->request->error)->addClass('error');
		}
		
		if ($this->request->success)
		{
			$this->template->message = DOMFactory::getDiv($this->request->success)->addClass('success');
		}
	}
	
	public function activate()
	{
		$this->prepareRequest();
		$this->template->show($this->url->getActionPath('login'));
	}
	
	public function recover()
	{
		$this->template->formAction = $this->url->getActionURL(__FUNCTION__);
		$this->prepareRequest();
		$this->template->show($this->url->getActionPath());
	}
}

?>