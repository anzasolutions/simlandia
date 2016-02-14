<?php

/**
 * Default view.
 * Should be extended by all views.
 * @author anza
 * @version 03-10-2010
 */
abstract class AbstractView
{
	protected $template;
	protected $url;
	protected $request;
	protected $values;
	
	public function __construct()
	{
		$this->url = URL::getInstance();
		$this->template = Template::getInstance();
		$this->request = Request::getInstance();
		$this->values = Values::getInstance();
	}
	
	public function display($action)
	{
		$this->header();
		$this->$action();
		$this->footer();
	}
	
	public function header()
	{
		$this->template->show(__FUNCTION__);
	}
	
	public function index()
	{
		$this->template->show(__FUNCTION__);
	}
	
	public function footer()
	{
		$this->template->show(__FUNCTION__);
	}
    
    public function error()
    {
    	$this->template->show(__FUNCTION__);
    }
}

?>