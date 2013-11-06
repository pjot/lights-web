<?php
require dirname(__FILE__) . '/../smarty/Smarty.class.php';
class Template extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        $this->clearAllCache();
        $this->setTemplateDir(dirname(__FILE__) . '/../Templates');
        $this->setCacheDir(dirname(__FILE__) . '/../Cache/Smarty/Cache');
        $this->setCompileDir(dirname(__FILE__) . '/../Cache/Smarty/Compiled');
    }
}
