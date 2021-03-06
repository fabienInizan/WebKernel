<?php

/**
 * Collection of elements
 *
 * @package		spiral
 * @subpackage	core.utils.collection
 * @author		Frédéric Sureau <frederic.sureau@gmail.com>
 */
interface Collection
{
	/**
	 * Getter
	 *
	 * Alias of getElement
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function __get($name);
	
	/**
	 * Isset
	 *
	 * Alias of hasElement
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function __isset($name);
	
	/**
	 * Setter
	 *
	 * Alias of setElement
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 */
	public function __set($name, $value);
	
	/**
	 * Unset
	 *
	 * Alias of removeElement
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 */
	public function __unset($name);
	
	/**
	 * Return element value
	 *
	 * @param	string	$name	Element name
	 * @return	mixed
	 */
	public function getElement($name);
	
	/**
	 * Return elements
	 *
	 * @return	array
	 */
	public function getElements();
	
	/**
	 * Return if element exists
	 *
	 * @param	string	$name	Element name
	 * @return	bool
	 */
	public function hasElement($name);
	
	/**
	 * Remove an element
	 *
	 * @param	string	$name	Element name
	 * @return	void
	 */
	public function removeElement($name);
	
	/**
	 * Set element value
	 *
	 * @param	string	$name	Element name
	 * @param	mixed	$value	Element value
	 * @return	void
	 */
	public function setElement($name, $value);
	
	/**
	 * Sets the values of multiple elements
	 *
	 * @param	array	$elements	Elements
	 * @return	void
	 */
	public function setElements($elements);
}

?>