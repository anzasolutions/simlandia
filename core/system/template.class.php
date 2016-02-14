<?php

/**
 * Render template for display.
 * @author anza
 * @since 03-10-2010
 */
class Template extends Container
{
    private static $instance;
    
	private function __construct()
	{
	}
	
	public static function getInstance()
    {
    	if (!self::$instance)
    	{
    		self::$instance = new self();
    	}
    	return self::$instance;
    }

	/**
	 * Display template file.
	 * @param string $template
	 */
	public function show($template)
	{
		try
		{
			$file = $this->getTemplate($template);
			$this->checkFileExists($file);
			$this->render($file);
		}
		catch (FileNotFoundException $e)
		{
			$e->getTraceAsString();
		}
	}
	
	/**
	 * Generates pathfile of given template.
	 * @param string $template
	 * @return string
	 */
	public function getTemplate($path, $subPath = null)
	{
		if ($subPath != null)
		{
			$path .= SLASH . $subPath;
		}
		return PATH_TEMPLATES . $path . EXT_HTML;
	}
	
	/**
	 * Check if template file exists.
	 * @param string $file
	 * @throws FileNotFoundException
	 */
	private function checkFileExists($file)
	{
		if (!file_exists($file))
		{
			throw new FileNotFoundException($file);
		}
	}
	
	/**
	 * Render template file with variables.
	 * @param string $file
	 */
	private function render($file)
	{
		foreach ($this->values as $key => $value)
		{
			$$key = $value;
		}
		include $file;
	}
}

?>
