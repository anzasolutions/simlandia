<?php

/**
 * Handle user's video page.
 * @author anza
 * @version 21-04-2011
 */
class VideoController extends SessionController
{
	/**
	 * @Invocable
	 */
	protected function index()
	{
		$this->setAction('videos');
	}
	
	/**
	 * @Invocable
	 */
	protected function videos()
	{
		$this->getLastestVideos();
	}
	
	/**
	 * @Invocable
	 */
	protected function user()
	{
		$userId = $this->url->getParameter(0);
		$this->getLastestUserVideos($userId);
	}
	
	private function getLastestUserVideos($userId)
	{
		try
		{
			$videos = $this->model->getLatestUserVideos(10, $userId);
			$this->values->videos = $videos;
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
			$this->values->error = Bundle::get('video.message.error.user.has.no.videos');
		}
	}
	
	private function getLastestVideos()
	{
		try
		{
			$videos = $this->model->getLatestVideos(35);
			$this->values->videos = $videos;
		}
		catch (NoResultException $e)
		{
			$e->getTraceAsString();
			$this->values->error = Bundle::get('form.validation.video.url.incorrect', $e->getMessage());
		}
	}
	
	/**
	 * @Invocable
	 */
	protected function add()
	{
		try
		{
			$fo = FOFactory::build('newvideo');
			if (!$fo->isSent())
				return;
			$this->model->add($fo);
			Navigator::redirectTo('video');
		}
		catch (FormValidationException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.invalid.value', $e->getMessage());
		}
		catch (VideoNotExistsException $e)
		{
			$e->getTraceAsString();
			$this->request->error = Bundle::get('form.validation.video.url.incorrect', $e->getMessage());
		}
	}
	
	/**
	 * @Invocable
	 */
	protected function show()
	{
		if (!$this->url->hasParameters())
		{
			$this->redirectToError();
		}
		$videoId = intval($this->url->getParameter(0));
		$this->values->video = $this->model->getVideo($videoId);
		ControllerFactory::create('Comment')->getComments();
	}
	
	/**
	 * @Invocable
	 */
	protected function comment()
	{
		ControllerFactory::create('Comment')->add($this, 'show');
	}
}

?>