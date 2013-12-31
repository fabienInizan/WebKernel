<?php

// Dependencies inclusion
require_once('lib/settings/exceptions/ResolverException_FileNotFound.php');
require_once('lib/settings/exceptions/ResolverException_InvalidClassName.php');
require_once('lib/settings/exceptions/ResolverException_InvalidFile.php');
require_once('lib/settings/exceptions/ResolverException_PathNotFound.php');

/**
 * File system resolver
 *
 * Should be extended by sub-resolvers.
 * 
 * @package		spiral
 * @subpackage	core.utils.resolvers
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
abstract class Resolver_FileSystem
{
	/**
	 * Path where files are located
	 * 
	 * @var	string
	 */
	private $_path;
	
	/**
	 * Class prefix
	 * 
	 * @var	string
	 */
	private $_classPrefix;
	
	/**
	 * Class suffix
	 * 
	 * @var	string
	 */
	private $_classSuffix;
	
	/**
	 * File prefix
	 * 
	 * @var	string
	 */
	private $_filePrefix;
	
	/**
	 * File suffix
	 * 
	 * @var	string
	 */
	private $_fileSuffix;
	
	/**
	 * Constructor
	 * 
	 * @param	string		$path				Path where files are located
	 * @param	string		$classPrefix		Class prefix
	 * @param	string		$classSuffix		Class suffix
	 * @param	string		$filePrefix			File prefix
	 * @param	string		$fileSuffix			File suffix
	 * @return	void
	 */
	public function __construct($path, $classPrefix = '', $classSuffix = '', $filePrefix = '', $fileSuffix = '.class.php')
	{
		$this->_path = $path;
		$this->_classPrefix = $classPrefix;
		$this->_classSuffix = $classSuffix;
		$this->_filePrefix = $filePrefix;
		$this->_fileSuffix = $fileSuffix;
	}
	
	/**
	 * Check if file exists
	 * 
	 * @param	string		$path		Path to the file
	 * @return	void
	 */
	protected function _checkFileExists($path)
	{
		if(!file_exists($path))
			throw new ResolverException_FileNotFound($path);
	}
	
	/**
	 * Check if path exists
	 * 
	 * @param	string		$path		Path to the file
	 * @return	void
	 */
	protected function _checkPathExists($path)
	{
		if(!is_dir($path))
			throw new ResolverException_PathNotFound($path);
	}
	
	/**
	 * Create an object of the specified class
	 * 
	 * Try to load the correct file before creating instance. 
	 * 
	 * @param	string		$class		Class of the object to create
	 * @param	string		$subPath	Sub path
	 * @return	void
	 */
	protected function _createObject($class, $subPath = null)
	{
		$this->_loadClass($class, $subPath);
		
		$class = $this->_prepareClassName($class);
		return new $class();
	}
	
	/**
	 * Returns class prefix
	 * 
	 * @return	string
	 */
	protected function _getClassPrefix()
	{
		return $this->_classPrefix;
	}
	
	/**
	 * Returns class suffix
	 * 
	 * @return	string
	 */
	protected function _getClassSuffix()
	{
		return $this->_classSuffix;
	}
	
	/**
	 * Returns file prefix
	 * 
	 * @return	string
	 */
	protected function _getFilePrefix()
	{
		return $this->_filePrefix;
	}
	
	/**
	 * Returns file suffix
	 * 
	 * @return	string
	 */
	protected function _getFileSuffix()
	{
		return $this->_fileSuffix;
	}
	
	/**
	 * Returns path
	 * 
	 * @return	string
	 */
	protected function _getPath()
	{
		return $this->_path;
	}
	
	/**
	 * Load a class
	 * 
	 * @param	string		$class		Class to load
	 * @param	string		$subPath	Sub path
	 * @return	void
	 * 
	 * @throws	ResolverException_InvalidClassName
	 * @throws	ResolverException_InvalidFile
	 */
	protected function _loadClass($class, $subPath = null)
	{
		$class = $this->_prepareClassName($class);
		
		// If class already loaded, do nothing
		if(class_exists($class))
			return;

		// Check class name
		if(!preg_match('/^[a-z][a-z0-9_]*$/i', $class))
			throw new ResolverException_InvalidClassName($class);

		$this->_loadFile($class, $subPath);

		// If class still does not exists it means that the file is invalid
		if(!class_exists($class))
			throw new ResolverException_InvalidFile($class);
	}
	
	/**
	 * Load a file
	 * 
	 * @param	string		$fileName	File name
	 * @param	string		$subPath	Sub path
	 * @return	void
	 * 
	 * @throws	ResolverException_FileNotFound
	 */
	protected function _loadFile($fileName, $subPath = null)
	{
		$path = $this->_prepareFilePath($fileName, $subPath);

		$this->_checkFileExists($path);
		
		require_once($path);
	}
	
	/**
	 * Prepares the class name
	 * 
	 * @param	string		$className		Class name
	 * @return	string
	 */
	protected function _prepareClassName($className)
	{
		return $this->_getClassPrefix().$className.$this->_getClassSuffix();
	}
	
	/**
	 * Prepares the path to the file
	 * 
	 * @param	string		$fileName		File name
	 * @param	string		$subPath		Sub path
	 * @return	string
	 */
	protected function _prepareFilePath($fileName, $subPath = null)
	{
		return $this->_preparePath($subPath).$this->_getFilePrefix().$fileName.$this->_getFileSuffix();
	}
	
	/**
	 * Prepares the path with the sub path
	 * 
	 * @param	string		$subPath		Sub path
	 * @return	string
	 */
	protected function _preparePath($subPath)
	{
		$path = $this->_getPath().'/';
		
		if(!empty($subPath))
			$path .= $subPath.'/';
			
		return $path;
	}
}

?>