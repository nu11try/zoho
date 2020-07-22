<?php
require_once "utils/leadClass.php";

header( 'Refresh:10; URL=http://zoho/' );

$firstName = $_POST["First_Name"];
$lastName = $_POST["Last_Name"];
$email = $_POST["Email"];
$phone = $_POST["Phone"];
$income = $_POST["Income"];

$lead = new LeadClass($firstName, $lastName, $email, $phone, $income);
$result = $lead->searchContact();
if (!$result) {
    $result = json_decode($lead->searchData(), true);
    if ($result["INFO"] == "ISSET_LEAD") {
        $result = $lead->convertLead($result["ID"]);
        echo "Обращение конвертировано в сделку!";
    }
    else {
        $result = json_decode($lead->insertLead(), true);
        if ($result["data"][0]["code"] == "SUCCESS") echo "Обращение добавлено";
        else echo "Ошибка при создании обращения! Попробуйте позже!";
    }
}
else echo "Контакт с таким email уже есть!";