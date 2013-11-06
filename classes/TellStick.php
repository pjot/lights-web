<?php

class TellStick
{
    const ORANGE = 1;
    const GREEN = 2;
    const CEILING = 3;

	const TOGGLER = 'toggler';
	const DIMMER = 'dimmer';

	protected static $lights = [
		self::ORANGE => self::TOGGLER,
		self::GREEN => self::TOGGLER,
		self::CEILING => self::DIMMER,
	];

	protected static $statusRegex = [
		self::TOGGLER => '/(\w+)$/',
		self::DIMMER => '/DIMMED:(\d+)$/',
	];
    protected $light;

    public static function getStatus()
    {
	$lights = shell_exec('tdtool -l');
	$lights = explode("\n", $lights);
	$currents = [];
	foreach ($lights as $light)
	{
		if (preg_match('/^(\d+)/', $light, $matches))
		{
			$current_light = $matches[0];
			$type = self::$lights[$current_light];
			if ($type === self::DIMMER && preg_match('/OFF$/', $light))
			{
				$type = self::TOGGLER;
			}
			preg_match(self::$statusRegex[$type], $light, $matches);
			$current = new stdClass;
			$current->id = $current_light;
			$current->status = $matches[1];
			$currents[] = $current;	
		}
	}
	return $currents;
    }

    public function __construct($light)
    {
        $this->light = $light;
    }

    protected function sendCommand($cmd)
    {
        $command = sprintf('tdtool %s', $cmd);
        shell_exec($command);
    }

    public function turnOn()
    {
        $command = sprintf('--on %s', $this->light);
        $this->sendCommand($command);
    }

    public function turnOff()
    {
        $command = sprintf('--off %s', $this->light);
        $this->sendCommand($command);
    }

    public function dim($level)
    {
	$level = floor(255 * $level / 100);
        $command = sprintf('--dimlevel %s --dim %s', $level, $this->light);
        $this->sendCommand($command);
    }
}
