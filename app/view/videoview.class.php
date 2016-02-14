<?php

/**
 * Handle video view.
 * @author anza
 * @version 09-08-2011
 */
class VideoView extends MenuView
{
	protected function videos()
	{
		foreach ($this->values->videos as $video)
		{
			$image = DOMFactory::getImage($video->getThumbnail());
			$link = DOMFactory::getLink($this->url->getCustomActionURL('video', 'show', array($video->getId())), $image)->addClass('thumbnail');
			$this->template->videos .= DOMFactory::getDiv($link);
		}
		$this->template->show($this->url->getActionPath());
	}
	
	protected function add()
	{
		$this->template->formAction = $this->url->getActionURL(__FUNCTION__);
		if ($this->request->error)
		{
			foreach ($this->request->getValues() as $key => $value)
			{
				$this->template->$key = $value;
			}
			$this->template->message = DOMFactory::getDiv($this->request->error)->addClass('error');
		}
		$this->template->show($this->url->getActionPath());
	}
	
	protected function user()
	{
		if ($this->values->error)
		{
			$this->template->message = DOMFactory::getDiv($this->values->error)->addClass('error');
		}
		
		if (($comments = $this->values->videos) != null)
		{
			foreach ($this->values->videos as $video)
			{
				$image = DOMFactory::getImage($video->getThumbnail());
				$link = DOMFactory::getLink($this->url->getCustomActionURL('video', 'show', array($video->getId())), $image)->addClass('thumbnail');
				$this->template->videos .= DOMFactory::getDiv($link);
			}
		}
		
		$this->template->show($this->url->getActionPath());
	}
	
	// TODO: works fine, but must be refactored to achieve clear construct
	protected function show()
	{
		if ($this->values->error)
		{
			$this->template->message = DOMFactory::getDiv($this->values->error)->addClass('error');
		}
		
		$commentView = new CommentView();
		$commentView->produceComments();
		
		$this->template->type = $this->url->getController();
		$this->template->id = $this->url->getParameter(0);
		
		$this->template->sourceId = $this->values->video->getSourceId();
		$this->template->title = $this->values->video->getTitle();
		$this->template->description = $this->values->video->getDescription();
		$this->template->duration = $this->values->video->getLength();
		$this->template->date = Date::convert($this->values->video->getDate(), 'j F Y');
		$this->template->videoObject = $this->template->getTemplate('video', $this->values->video->getType());
		$this->template->link = $this->url->getURL();
		
		$link = $this->url->getCustomActionURL('profile', $this->values->video->getLogin());
		$this->template->username = DOMFactory::getLink($link, $this->values->video->getUsername());
		
		$this->template->show($this->url->getActionPath());
	}
}

?>