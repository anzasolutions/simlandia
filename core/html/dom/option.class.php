<?php

class Option extends DOMObject
{
	private $value;
	private $selected;
	private $content;
	
	public function __construct($value)
	{
		$this->value = $value;
	}

    public function addSelected($selected)
    {
    	if ($selected)
    		$this->selected = ' selected';
        return $this;
    }

    public function addContent($content)
    {
        $this->content = $content;
        return $this;
    }
	
	public function __toString()
	{
		return '<option value="' . $this->value . '" ' . $this->selected . $this->class . $this->style . '>' . $this->content . '</option>' . "\n";
	}
}

?>