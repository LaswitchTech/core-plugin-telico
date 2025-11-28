<?php

// Import additionnal class into the global namespace
use LaswitchTech\Core\Abstracts\Command;

class TelicoCommand extends Command {

    /**
     * Constructor
     */
    public function __construct()
    {
        // Call Parent Constructor
        parent::__construct();
    }

    /**
     * Make a call via telico
     */
    public function callAction()
    {
        // Retrieve parameters
        $number = $this->Request->getArguments(3);
        $line = $this->Request->getArguments(4);

        // Check if parameters are provided
        if(empty($number) || empty($line)){
            echo "Usage: php telico.php call <number> <line>\n";
            return;
        }

        // Call the Telico Helper
        var_dump($this->Helper->Telico->call($number, $line));
    }

    /**
     * Send an SMS via telico
     */
    public function sendAction()
    {
        // Retrieve parameters
        $number = $this->Request->getArguments(3);
        $message = $this->Request->getArguments(4);

        // Check if parameters are provided
        if(empty($number) || empty($message)){
            echo "Usage: php telico.php send <number> <message>\n";
            return;
        }

        // Call the Telico Helper
        var_dump($this->Helper->Telico->send($number, $message));
    }

    /**
     * Get all conversations via telico
     */
    public function getAllAction()
    {
        // Call the Telico Helper
        var_dump($this->Helper->Telico->getAll());
    }

    /**
     * Get a specific conversation via telico
     */
    public function getAction()
    {
        // Retrieve parameters
        $id = $this->Request->getArguments(3);

        // Check if parameters are provided
        if(empty($id)){
            echo "Usage: php telico.php get <conversation_id>\n";
            return;
        }

        // Call the Telico Helper
        var_dump($this->Helper->Telico->get($id));
    }
}
