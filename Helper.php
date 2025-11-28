<?php

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Helper;

class TelicoHelper extends Helper {

    /**
     * Make a call via telico
     *
     * @param string $number
     * @param string $line
     * @return array
     */
    public function call(string $number, string $line): array
    {
        // Prepare the request
        $username = $this->Config->get('telico','username');
        $password = $this->Config->get('telico','voip_pass');
        $params = [
            "auth_username" => $username,
            "auth_password" => $password,
            "stype" => "phone",
            "snumber" => $line,
            "cnumber" => $number,
            "callerid1" => $this->Config->get('telico','callerid'),
            "callerid2" => $this->Config->get('telico','callerid'),
        ];
        $baseUrl = "https://as2.telico.ca/api/json/calls/make/";
        $url = $baseUrl . "?" . http_build_query($params);

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Return
        return json_decode($response, true);
    }

    /**
     * Send an SMS via telico
     *
     * @param string $number
     * @param string $message
     * @return array
     */
    public function send(string $number, string $message): array
    {
        // Prepare the request
        $username = $this->Config->get('telico','username');
        $password = $this->Config->get('telico','sms_pass');
        $params = [
            "source_did" => $this->Config->get('telico','callerid'),
            "destination" => $number,
            "message" => $message
        ];
        $baseUrl = "https://sms.telico.cloud/api/send_sms";
        $url = $baseUrl . "?" . http_build_query($params);

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Return
        return json_decode($response, true);
    }

    /**
     * Get all conversations via telico
     *
     * @return array
     */
    public function getAll(): array
    {
        // Prepare the request
        $username = $this->Config->get('telico','username');
        $password = $this->Config->get('telico','sms_pass');
        $params = [
            "did" => $this->Config->get('telico','callerid'),
        ];
        $baseUrl = "https://sms.telico.cloud/api/conversations";
        $url = $baseUrl . "?" . http_build_query($params);

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Return
        return json_decode($response, true);
    }

    /**
     * Get a specific conversation via telico
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        // Prepare the request
        $username = $this->Config->get('telico','username');
        $password = $this->Config->get('telico','sms_pass');
        $params = [
            "conversation_id" => $id,
        ];
        $baseUrl = "https://sms.telico.cloud/api/messages";
        $url = $baseUrl . "?" . http_build_query($params);

        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Return
        return json_decode($response, true);
    }
}
