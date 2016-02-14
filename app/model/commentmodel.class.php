<?php

/**
 * Business logic of comment.
 * @author anza
 * @version 07-07-2011
 */
class CommentModel extends AbstractModel
{
	public function add(CommentFO $fo, $type, $typeId)
	{
		$comment = $this->makeComment($fo, $type, $typeId);
		DAOFactory::getCommentDAO()->save($comment);
	}
	
	private function makeComment(CommentFO $fo, $type, $typeId)
	{
		$user = Session::get('user');
		
		$comment = new Comment();
		$comment->setContent($fo->getComment());
		$comment->setType($type);
		$comment->setTypeId($typeId);
		$comment->setDate(null);
		$comment->setUserId($user->getId());
		return $comment;
	}
	
	// TODO: local variables could be customizable?
	// TODO: variable names could be enhanced?
	public function getComments($type, $typeId, $start)
	{
		$span = 10;
		$limit = 10;
		$position = 0;
		
		if ($start != null)
		{
			$limit = $start * $span;
			$position = $limit - $span;
		}
		
		$comments = DAOFactory::getCommentDAO()->findByTypeAndTypeIdAndLimit($type, $typeId, $position, $limit);
		$users = DAOFactory::getUserDAO()->findByCommentTypeAndCommentTypeIdAndLimit($type, $typeId);
		$users = $this->convertToIdMap($users);
		$commentTOs = $this->makeCommentTOs($comments, $users);
		return $commentTOs;
	}
	
	// TODO: extract to let's say Arrays class to be used with similar cases?
	private function convertToIdMap($users)
	{
		foreach ($users as $user)
		{
			$map[$user->getId()] = $user;
		}
		return $map;
	}
	
	private function makeCommentTOs(array $comments, array $users)
	{
		foreach ($comments as $comment)
		{
			$commentTOs[] = new CommentTO($comment, $users);
		}
		return $commentTOs;
	}
	
	public function getCommentsCount($type, $typeId)
	{
		return DAOFactory::getCommentDAO()->countByTypeAndTypeId($type, $typeId);
	}
}

?>