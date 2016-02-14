<?php

/**
 * Generate select tag.
 * @author anza
 * @since 20-11-2010
 */
class Select extends DOMObject
{
	private $content;
	
	public function __construct()
	{
	}

    public function addContent($content)
    {
        $this->content = $content;
        return $this;
    }
	
	public function __toString()
	{
		return '<select ' . $this->id . $this->name . $this->class . $this->style . $this->event . '>' . $this->content . '</select>' . "\n";
	}
}

?>