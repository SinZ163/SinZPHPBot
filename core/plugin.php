<?php

class Plugin extends Bot {

    private $modules = array();

    function _construct() {
        
    }

    /*
     * Loads a plugin
     * 
     * @return bool
     */

    public function load($plugin) {
        
    }

    /*
     * Loaded Plugin List
     * 
     * @return array
     */

    public function loaded() {
        
    }

    /*
     * Plugin Register
     * 
     * Registers a plugin
     * 
     * @return void
     */

    public function register($class) {
        $this->modules[] = $class;
        $class->_construct($this);
    }

    /*
     * Plugin Event
     * 
     * Not exactly sure what this does
     * 
     * @return void
     */

    public function event($name) {
        $name = strtolower($name);

        $args = func_get_args();
        $args = array_splice($args, 1);
        foreach ($this->modules as $module) {
            if (method_exists($module, $name)) {
                call_user_func_array(array($module, $name), $args);
            }
        }
    }

}
