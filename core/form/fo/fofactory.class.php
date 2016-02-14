<?php

/**
 * Producing Form Objects.
 * @author anza
 * @version 12-06-2011
 */
class FOFactory
{
	const FO = 'FO';
	
	/**
	 * Create requested Form Object.
	 * @author anza
	 * @param string $form Name of Form Object to be created.
	 * @throws FormNotFoundException When impossible to find class of Form Object.
	 * @return New Form Object if its class exists.
	 */
	public static function build($form)
	{
		try
		{
			$fo = $form.self::FO;
			if (class_exists($fo))
				return new $fo();
		}
		catch (LogicException $e)
		{
			throw new FormNotFoundException(Bundle::get('form.validation.form.not.found', $fo));
		}
	}
}

?>