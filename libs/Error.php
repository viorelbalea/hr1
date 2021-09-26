<?php

class Error
{

    private $mErrors = array();
    private $smarty;

    public function __construct($smarty)
    {
        $this->smarty = $smarty;
        require_once $this->smarty->_get_plugin_filepath('function', 'translate');
    }

    public function setError($error)
    {
        $this->mErrors[] = smarty_function_translate(array('label' => $error), $this->smarty) . '!';
    }

    public function getErrors()
    {
        return implode('<br>', $this->mErrors);
    }
}

?>