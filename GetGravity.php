<?php
function calcGravity($testo)
{
    $url = "https://language.googleapis.com/v1/documents:analyzeSentiment";
    $key = array(
        "Content-Type: application/json; charset=utf-8",
        "X-goog-api-key: AIzaSyDuVXPsVUUAUKlLrZlR4jZqv2aCp3lnG5s"
    );
    $text = preg_replace('/[\"]+/s', "'", $testo);
    $body = "{
        'document':{
            'type':'PLAIN_TEXT',
            'content':\"$text\"
        },
        'encodingType':'UTF8'
        }";

    $request = curl_init($url);
    curl_setopt_array(
        $request,
        [
            CURLOPT_HTTPHEADER => $key,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true
        ]
    );
    $reply = curl_exec($request);
    $score = json_decode($reply, true)["documentSentiment"]["score"];

    if ($score > 0)
        return '0';
    if ($score > -0.5)
        return '1';

    return '2';

    curl_close($request);
}
?>