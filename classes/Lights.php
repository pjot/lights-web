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
        $tellstick->$action($_GET['arguments']);
    }

    public function main()
    {
		$t = new Template();
		$lights = TellStick::getStatus();
		foreach ($lights as $light)
		{
			switch ($light->id)
			{
				case '1':
					$t->assign('orange', $light->status);
					break;
				case '2':
					$t->assign('green', $light->status);
					break;
				case '3';
					$t->assign('ceiling', ceil(100 * $light->status / 255));
					break;
			}
		}
		$t->display('main.html');
    }
}
