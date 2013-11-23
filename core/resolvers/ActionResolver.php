<?php

interface ActionResolver
{
	public function resolveAction(HttpRequest $httpRequest);
}

?>