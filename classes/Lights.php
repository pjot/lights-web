<?php

class Lights
{
	public function run()
	{
		$t = new Template();
		$t->assign('title', 'eipen schnaur');
		$t->display('main.html');
	}
}
