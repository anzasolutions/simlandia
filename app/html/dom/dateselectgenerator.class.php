<?php

/**
 * Generate select date dropdown.
 * @author anza
 * @since 20-11-2010
 */
class DateSelectGenerator extends SelectGenerator
{
	/**
	 * Combine 3 select date drop-down components. 
	 * @author anza
	 * @return string
	 */
	public function getSelectDate()
	{
		return $this->getYears() . SPACE . $this->getMonths() . SPACE . $this->getDays();
	}
	
	private function getDays()
	{
		$days = DOMFactory::getSelect()->addEvent('onfocus', 'genDays();')->addName('day')->addId('day')->addClass('regDateDays');
		$options = $this->makeOption('', 'Day', 'day');
		for ($i = 1; $i < 32; $i++)
			$options .= $this->makeOption($i, $i, 'day');
		$days->addContent($options);
		return $days;
	}
	
	private function getMonths()
	{
		$months = DOMFactory::getSelect()->addName('month')->addId('month')->addClass('regDateMonths');
		$options = $this->makeOption('', 'Month', 'month');
		for ($i = 1; $i < 13; $i++)
			$options .= $this->makeOption($i, $this->getMonthName($i - 4), 'month');
		$months->addContent($options);
		return $months;
	}
	
	/**
	 * Get next month after provided index.
	 * @author anza
	 * @param integer $i Current month index
	 * @return string
	 */
	private function getMonthName($i)
	{
//		setlocale(LC_ALL, 'plk');
		return iconv('ISO-8859-2', 'UTF-8', strftime('%B', strtotime('+' . $i . ' month')));
	}
	
	private function getYears()
	{
		$years = DOMFactory::getSelect()->addName('year')->addId('year')->addClass('regDateYears');
		$options = $this->makeOption('', 'Year', 'year');
		for ($i = 2000; $i > (2000 - 80); $i--)
			$options .= $this->makeOption($i, $i, 'year');
		$years->addContent($options);
		return $years;
	}
}

?>