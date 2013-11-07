<?php

class Application
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

    public function lights()
    {
        $t = new Template;
		$t->assign('lights', TellStick::getStatus());
		$t->display('lights.html');
    }

    public function ajax()
    {
        $light = isset($_GET['light']) ? $_GET['light'] : 'main';
        $action = $_GET['action'];
        $tellstick = new TellStick($light);
        $tellstick->$action($_GET['arguments']);
    }

    public function main()
    {
		$t = new Template;
		$t->display('main.html');
    }
}
