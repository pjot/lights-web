<?php
if ($_SERVER['HTTP_USER_AGENT'] !== 'pjotLightsApp')
{
	header("HTTP/1.0 404 Not Found");
	exit;
}
require_once 'Autoload.php';
$app = new Application;
$app->run();
