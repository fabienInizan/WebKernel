<?php

require_once('core/action/ActionResponse.php');

/**
 * Action response
 *
 * @package		SNIJ
 * @subpackage	core.responses
 */
class ActionResponse_Default implements ActionResponse
{
	/**
	 * Elements
	 *
	 * @var	array
	 */
	private $_elements;

	/**
	 * Template identifier
	 *
	 * @var	string
	 */
	private $_templateId;

	/**
	 * Layout identifier
	 *
	 * @var	string
	 */
	private $_layout;

	/**
	 * Templates type
	 *
	 * @var	string
	 */
	private $_templateType;

	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->_elements = array();
	}

	/**
	 * Get target element
	 * @param	string	$name	name of the element
	 * @return	mixed	target element
	 */
	public function __get($name)
	{
		return $this->getElement($name);
	}

	/**
	 * Set target element to given value
	 * @param	string	$name	name of the element
	 * @param	mixed	$value	value of the element
	 *
	 * @return	void
	 */
	public function __set($name, $value)
	{
		$this->setElement($name, $value);
	}

	/**
	 * Get target element
	 * @param	string	$name	name of the element
	 * @return	mixed	target element
	 */
	public function getElement($name)
	{
		return $this->_elements[$name];
	}

	/**
	 * Get all elements
	 *
	 * @return	array
	 */
	public function getElements()
	{
		return $this->_elements;
	}

	/**
	 * Get template identifier
	 * @return	string	template identifier
	 */
	public function getTemplateId()
	{
		return $this->_templateId;
	}

	/**
	 * Get layout
	 * @return	string	layout id
	 */
	public function getLayout()
	{
		return $this->_layout;
	}

	/**
	 * Get template type
	 * @return	string	template type
	 */
	public function getTemplateType()
	{
		return $this->_templateType;
	}

	/**
	 * Set target element to given value
	 * @param	string	$name	name of the element
	 * @param	mixed	$value	value of the element
	 *
	 * @return	void
	 */
	public function setElement($name, $value)
	{
		$this->_elements[$name] = $value;
	}

	/**
	 * Set template identifier to given parameter
	 *
	 * @param	string	$value	value of the element
	 *
	 * @return	void
	 */
	public function setTemplateId($value)
	{
		$this->_templateId = $value;
	}

	/**
	 * Set layout id
	 *
	 * @param	string	$layout	layout id
	 *
	 * @return	void
	 */
	public function setLayout($layout)
	{
		$this->_layout = $layout;
	}

	/**
	 * Set template type to given parameter
	 *
	 * @param	string	$value	value of the element
	 *
	 * @return	void
	 */
	public function setTemplateType($value)
	{
		$this->_templateType = $value;
	}

	/**
	 * Add elements to the response
	 *
	 * @param	string	$value	value of the element
	 *
	 * @return	void
	 */
	public function addElements($elements)
	{
		$this->_elements = array_merge($elements, $this->_elements);
	}
}

?>