<?php

interface ActionResponse
{

	/**
	 * Get target element
	 * @param	string	$name	name of the element
	 * @return	mixed	target element
	 */
	public function getElement($name);

	/**
	 * Get all elements
	 *
	 * @return	array
	 */
	public function getElements();

	/**
	 * Get template identifier
	 * @return	string	template identifier
	 */
	public function getTemplateId();

	/**
	 * Get layout
	 * @return	string	layout id
	 */
	public function getLayout();

	/**
	 * Get template type
	 * @return	string	template type
	 */
	public function getTemplateType();

	/**
	 * Set target element to given value
	 * @param	string	$name	name of the element
	 * @param	mixed	$value	value of the element
	 *
	 * @return	void
	 */
	public function setElement($name, $value);

	/**
	 * Set template identifier to given parameter
	 *
	 * @param	string	$value	value of the element
	 *
	 * @return	void
	 */
	public function setTemplateId($value);

	/**
	 * Set layout id
	 *
	 * @param	string	$layout	layout id
	 *
	 * @return	void
	 */
	public function setLayout($layout);

	/**
	 * Set template type to given parameter
	 *
	 * @param	string	$value	value of the element
	 *
	 * @return	void
	 */
	public function setTemplateType($value);

	/**
	 * Add elements to the response
	 *
	 * @param	string	$value	value of the element
	 *
	 * @return	void
	 */
	public function addElements($elements);
}

?>