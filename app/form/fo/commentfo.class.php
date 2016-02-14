<?php

/**
 * Comment Form Object.
 * Validates and hold comment form data.
 * @author anza
 * @version 27-06-2011
 */
class CommentFO extends AbstractFO
{
	const COMMENT = 'comment';
	const TYPE = 'type';
	const ID = 'id';
	
	private $comment;
	private $type;
	private $id;
	
	protected function bind()
	{
		$this->comment = $this->request->valueOf(self::COMMENT);
		$this->type = $this->request->valueOf(self::TYPE);
		$this->id = $this->request->valueOf(self::ID);
	}
	
	protected function validate()
	{
		// temporarily ValidationRules::NONE validation rule is applied
		FormValidator::validate($this->comment, self::COMMENT, ValidationRules::NONE);
	}

	public function getComment()
	{
	    return $this->comment;
	}

	public function getType()
	{
	    return $this->type;
	}

	public function getId()
	{
	    return $this->id;
	}
}

?>