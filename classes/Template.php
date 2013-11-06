<?php
require dirname(__FILE__) . '/../smarty/Smarty.class.php';
class Template extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir('Templates');
        $this->setCacheDir('Cache/Smarty/Cache');
        $this->setCompileDir('Cache/Smarty/Compiled');
    }
}
