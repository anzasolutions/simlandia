<?php

class DefaultView extends MenuView
{
	public function index()
	{
		$lipsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ornare sollicitudin elit, vitae vestibulum nisl laoreet vel.';
		$this->template->index = DOMFactory::getDiv($lipsum);
		$this->template->show($this->url->getActionPath('index'));
	}
}

?>