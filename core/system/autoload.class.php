<?php

/**
 * Manage autoloading fnuctionality.
 * @author anza
 * @version 2010-08-28
 */
final class Autoload
{
	private static $instance;
	
	private $xml = array();
	private $extensions = array(); // TODO: to be used as an official extensions container
	
	private function __construct()
	{
		$this->readPathFiles();
		$this->includePaths();
		$this->register();
	}
	
    /**
     * Create unique instance of Autoload as a singleton.
     * @author anza
     */
    public static function initialize()
    {
    	if (!self::$instance)
    		self::$instance = new self();
    	return self::$instance;
    }
	
	/**
	 * Register selected extensions prior to autoloading.
	 * Only files with registered extensions will be loaded. 
	 * @author anza
	 */
	private function register()
	{
		spl_autoload_extensions(EXT_PHP . COMMA . EXT_CLASS_PHP . COMMA . EXT_INTERFACE_PHP);
		spl_autoload_register();
	}
	
	/**
	 * Create classpath using loaded locations.
	 * @author anza
	 */
	private function includePaths()
	{
		foreach ($this->xml as $xml)
			foreach ($xml->location as $location)
				set_include_path(get_include_path() . SEMICOLON . $location->path . SLASH); // use COLON separator on *nix
	}
	
	/**
	 * Read XML file containing class locations.
	 * @author anza
	 */
	private function readPathFiles()
	{
		foreach ($this->findPathFiles() as $file)
			$this->xml[] = simplexml_load_file($file);
	}
	
	/**
	 * Find autoload path files within constants. 
	 * @author anza
	 * @return array $vals Autoload path files.
	 */
	private function findPathFiles()
	{
		$const = get_defined_constants(true);
		$load = $const['user'];
		$keys = preg_grep('/AUTOLOAD/', array_keys($load), 0);
		$vals = array();
		foreach ($keys as $key)
			$vals[$key] = $load[$key];
		return $vals;
	}
	
	// TODO: to be used as official setter for allowed extansions
	public function setExtension($extension)
	{
		$this->extensions[] = $extension;
	}
}

?>