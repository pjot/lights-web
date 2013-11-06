<?php

class Lights
{
	public function run()
    {
        $method = isset($_GET['method']) ? $_GET['method'] : 'main';
        if ( ! method_exists($this, $method))
        {
            $method = 'main';
        }
        $this->$method();
	}


    public function ajax()
    {
        $light = isset($_GET['light']) ? $_GET['light'] : 'main';
        $action = $_GET['action'];
        $tellstick = new TellStick($light);
        $tellstick->$action();
    }

    public function main()
    {
		$t = new Template();
		$t->assign('title', 'eipen schnaur');
		$t->display('main.html');
    }
}
