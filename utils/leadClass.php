<?php

require_once "utils/curlClass.php";

class LeadClass
{
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $income;
    private $result;

    private $curl;

    public function __construct($firstName, $lastName, $email, $phone, $income)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->income = $income;

        $this->curl = new CurlClass();
    }

    public function searchData()
    {
        $this->result = $this->curl->curlInitAndStart("https://www.zohoapis.com/crm/v2/Leads/search?criteria=(Phone:equals:" . $this->phone . ")", "GET");
        $buf = json_decode($this->result, true);
        if (is_null($buf)) $json_res = array("INFO" => "NO_ISSET_LEAD");
        else $json_res = array("INFO" => "ISSET_LEAD", "ID" => $buf["data"][0]["id"]);
        return json_encode($json_res, JSON_UNESCAPED_UNICODE);
    }

    public function searchContact()
    {
        $this->result = $this->curl->curlInitAndStart("https://www.zohoapis.com/crm/v2/Contacts/search?criteria=(Email:equals:" . $this->email . ")", "GET");
        $buf = json_decode($this->result, true);
        if (is_null($buf)) return false;
        else return true;
    }

    public function insertLead()
    {
        $file = __DIR__ . "\json_template\addLeads.json";
        $json = file_get_contents($file);

        $json = str_replace("#f", $this->firstName, $json);
        $json = str_replace("#l", $this->lastName, $json);
        $json = str_replace("#e", $this->email, $json);
        $json = str_replace("#p", $this->phone, $json);
        $json = str_replace("#i", $this->income, $json);

        $data_string = json_encode(json_decode($json), JSON_UNESCAPED_UNICODE);

        $this->result = $this->curl->curlInitAndStart("https://www.zohoapis.com/crm/v2/Leads", "POST", $data_string);
        return $this->result;
    }

    public function convertLead($id)
    {
        $file = __DIR__ . "\json_template\convertLead.json";
        $json = file_get_contents($file);

        $json = str_replace("#n", $id, $json);

        $data_string = json_encode(json_decode($json), JSON_UNESCAPED_UNICODE);

        $this->result = $this->curl->curlInitAndStart("https://www.zohoapis.com/crm/v2/Leads/" . $id . "/actions/convert", "POST", $data_string);
        return $this->result;
    }
}
