<?php
$inputParams = "apikey={Your_API_Key}&apisecret={Your_API_Secret}&";
$inputParams .= "first_name=Tom&";
$inputParams .= "last_name=Smith&";
$inputParams .= "email=tom.smith@gmail.com&";
$inputParams .= "phone=(212) 555-7864&";
$inputParams .= "membership_level_id=2&";

$apiCallUrl = "https://{Your_API_URL}?q=/createMember";
$ch = curl_init($apiCallUrl);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $inputParams);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

echo "RAW Response: ".$result."<br />";
$data = json_decode($result);
echo "<pre>";
var_dump($data->response_data);
echo "</pre>";
?>