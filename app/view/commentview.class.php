<?php

/**
 * Handle views used for comments inclusions.
 * @author anza
 * @version 26-08-2011
 */
class CommentView extends MenuView
{
	public function produceComments()
	{
		$this->template->comments = $this->template->getTemplate('comments', 'comments');
		$this->template->formAction = $this->url->getActionParamURL('comment', array($this->url->getParameter(0)));
		
		if (($comments = $this->values->comments) != null)
		{
			foreach ($comments as $comment)
			{
				$this->template->commentItems .= $this->makeComment($comment);
			}
			$index = PageIndex::make($this->values->commentPageNumbers);
			$this->template->commentIndex = DOMFactory::getDiv($index)->addId('comment');
		}
	}
	
	private function makeComment($comment)
	{
		$avatar = $this->prepareAvatar($comment->getUser());
		$author = DOMFactory::getDiv($avatar)->addId('comment-avatar');
		
		$link = $this->url->getCustomActionURL('profile', $comment->getLogin());
		$nameLink = DOMFactory::getLink($link, $comment->getName());
		
		$content = DOMFactory::getDiv($nameLink)->addClass('name');
		$content .= DOMFactory::getDiv($comment->getContent());
		$content .= DOMFactory::getDiv('Added on: ' . Date::convert($comment->getDate(), 'j F Y'))->addClass('date');
		
		$author .= DOMFactory::getDiv($content)->addId('comment-author');
		
		$section = DOMFactory::getDiv($author)->addId('comment');
		$section .= DOMFactory::getDiv()->addClass('separator');
		return $section;
	}
}

?>