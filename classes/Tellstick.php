<?php

class Tellstick
{
    const ORANGE = 1;
    const GREEN = 2;
    const CEILING = 3;

    protected $light;

    public function __construct($light)
    {
        $this->light = $light;
    }

    protected function sendCommand($cmd)
    {
        $command = sprintf('tdtool %s');
        shell_exec($command);
    }

    public function turnOn()
    {
        $command = sprintf('--on %s', $this->light);
        $this->sendCommand($command);
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
}
