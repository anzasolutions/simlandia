<?php

class RegisterView extends MenuView
{
	public function register()
	{
		$this->template->formAction = $this->url->getActionURL(__FUNCTION__);
		$this->prepareRequest();

		$date = new DateSelectGenerator($this->request);
		$this->template->selectDate = $date->getSelectDate();
		
		$gender = new GenderSelectGenerator($this->request);
		$this->template->selectGender = $gender->generateSelectGender();
		
		$this->template->show($this->url->getActionPath());
	}
	
	// TODO: repeated in AuthView and should be commoned
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
}

?>