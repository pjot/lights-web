<?php

class Light
{
    public $id;
    public $name;
    public $level;
    public $value = 'ON';
    public $type;

    public function setValue($value)
    {
        if ($this->isDimmer())
        {
            $this->level = floor($value * 100 / 255);
        }
        else
        {
            $this->value = $value;
        }
    }

    public function isOn()
    {
        return $this->value !== 'OFF';
    }

    public function isOff()
    {
        return $this->value === 'OFF';
    }

    public function isDimmer()
    {
        return $this->type === TellStick::DIMMER;
    }
    
}
