<?php

/**
 * Handle comment page.
 * @author anza
 * @version 25-06-2011
 */
class CommentController extends SessionController
{
	private $type;

	public function __construct()
	{
		parent::__construct();
		$this->type = $this->url->getController();
	}
	
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$this->redirectToError();
	}

	public function add(AbstractController $controller, $redirect)
	{
		try
		{
			$fo = FOFactory::build('comment');
			if (!$fo->isSent())
			{
				$this->redirectToCaller($redirect);
			}
			$this->model->add($fo, $fo->getType(), $fo->getId());
			$this->redirectToCaller($redirect);
		}
		catch (FormValidationException $e)
		{
			$this->values->error = Bundle::get('form.validation.invalid.value', $e->getMessage());
			$controller->setAction($redirect);
		}
	}
	
	public function getComments()
	{
		try
		{
			$this->values->comments = $this->model->getComments($this->type, $this->url->getParameter(0), $this->url->getParameter(1));
			$commentsNo = $this->model->getCommentsCount($this->type, $this->url->getParameter(0));
			$this->values->commentPageNumbers = ceil($commentsNo / 10);
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
		}
	}
	
	private function redirectToCaller($redirect)
	{
		$url = $this->url->getActionParamURL($redirect, array($this->url->getParameter(0)));
		Navigator::redirectToURL($url);
	}
}

?>