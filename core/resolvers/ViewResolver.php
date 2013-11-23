<?php

interface ViewResolver
{
	public function resolveView(HttpRequest $httpRequest, ActionResponse $actionResponse);
}

?>