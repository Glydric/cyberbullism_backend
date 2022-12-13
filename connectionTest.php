<?php

//this file is used to simple check curl working and connection to other sites
$request = curl_init('https://www.google.com');
curl_setopt_array(
    $request,
    [
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
    ],
);
$reply = curl_exec($request);
curl_close($request);

$code = curl_getinfo($request)["http_code"];
if ($code == 200)
    echo "connection achieved";
else
    echo "connection ERROR " . $code;
