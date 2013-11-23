<?php

require_once('core/view/View.php');

class View_Layout implements View
{
	private $_layoutView;
	private $_contentView;

	public function __construct(View $layoutView, View $contentView)
	{
		$this->_layoutView = $layoutView;
		$this->_contentView = $contentView;
	}

	public function render(array $elements)
	{
		$content = $this->_contentView->render($elements)->getContent();

		return $this->_layoutView->render(array('content'=>$content));
	}
}

?>