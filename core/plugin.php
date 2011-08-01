<?php

class Plugin extends Bot {

    private $plugins = array();
    
    function __construct() {
        
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
        foreach(get_declared_classes() as $lplug){
            $bot->raw($lplug);
        }
    }

    /*
     * Plugin Register
     * 
     * Registers a plugin
     * 
     * @return void
     */

    public function register($class) {
        $this->plugins[] = $class;
        $class->__construct($this);
    }

    /*
     * Plugin Event
     * 
     * Checks for a function that matches the command
     * 
     * @return void
     */

    public function event($prefix, $plugin, $command, $args) {
        $plugin = strtolower($plugin);
        $command = strtolower($command);
        echo $plugin;
        
        $args = func_get_args();
        $args = array_splice($args, 1);
        foreach($this->plugins as $plugin) {
            if(class_exists($plugin) && method_exists($plugin, $command)) {
                call_user_func_array(array($plugin, $name));
            }
        }
    }

}
