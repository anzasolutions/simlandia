<?php

class GenderSelectGenerator extends SelectGenerator
{
	public function generateSelectGender()
	{
		$labels = array('Gender', 'Kobieta', 'M&#281;&#380;czyzna');
		$genders = DOMFactory::getSelect()->addName('gender');
		$options = '';
		for ($i = 0; $i < 3; $i++)
			$options .= $this->makeOption($i, $labels[$i], 'gender');
		$genders->addContent($options);
		return $genders;
	}
}

?>