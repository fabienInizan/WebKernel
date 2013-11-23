<?php

interface HttpResponse
{
	public function send();
	public function addHeader($header);
	public function getContent();
	public function setContent($content);
}

?>