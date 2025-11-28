<?php

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Endpoint;

class TelicoEndpoint extends Endpoint {

    /**
     * Constructor
     */
    public function __construct()
    {
        // Call the parent constructor
        parent::__construct();

        // Set the global variable
        global $CONFIG;

        // Initialize Config
        $this->Config->add('telico');

        // Retrieve the namespace
        $namespace = $this->Request->getNamespace();

        // Set Properties
        switch($this->Request->getNamespace()){
            default:
                $this->Public = false;
                $this->Level = 4;
                break;
        }
    }
}
