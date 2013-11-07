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

    protected static $names = [
        self::ORANGE => 'Orange',
        self::GREEN => 'Green',
        self::CEILING => 'Ceiling',
    ];

    protected $light;

    public static function getStatus()
    {
        $rows = shell_exec('tdtool -l');
        $currents = [];
        foreach (explode("\n", $rows) as $row)
        {
            if (preg_match('/^(\d+)/', $row, $matches))
            {
                $light = new Light;
                $light->id = $matches[0];
                $light->name = self::$names[$light->id];
                $type = self::$lights[$light->id];
                $light->type = $type;
                if ($type === self::DIMMER && preg_match('/OFF$/', $row))
                {
                    $light->value = 'OFF';
                    $type = self::TOGGLER;
                }
                preg_match(self::$statusRegex[$type], $row, $matches);
                $light->setValue($matches[1]);
                $currents[] = $light;	
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
        error_log('sending: ' . $command);
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
