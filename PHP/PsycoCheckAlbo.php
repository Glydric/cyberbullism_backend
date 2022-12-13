<?php
function isValid($nome, $cognome, $email)
{

    if ($email == "" || $nome == "" || $cognome == "")
        return FALSE;
        
    $profileUrl = get_profile_url($nome, $cognome);

    if ($profileUrl == "")
        return FALSE;

    $request = curl_init($profileUrl);
    curl_setopt_array(
        $request,
        [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ],
    );
    $reply = curl_exec($request);

    if ($reply == false)
        die("some error " . curl_getinfo($request)["http_code"]);
    curl_close($request);

    return strcasecmp($email, get_email_from($reply)) == 0;
}
function get_profile_url($nome, $cognome)
{
    $url =
        'https://areariservata.psy.it/open-api/albo-nazionale/cerca';
    $profileUrl = "https://areariservata.psy.it/albo/iscritto/";

    $body = "{
        \"cognome\": \"$cognome\",
        \"nome\": \"$nome\",
        \"ordine\": null,
        \"provincia\": null,
        \"convenzioni\": null,
        \"limit\": 5
    }";
    // \"offset\": 0,
    // \"pageIndex\": 0,

    $request = curl_init($url);
    curl_setopt_array(
        $request,
        [
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
        ],
    );
    $reply = curl_exec($request);
    curl_close($request);
    $jsonData = json_decode($reply, true);

    if ($jsonData["count"] == 0)
        return "";

    $user = $jsonData["data"][0];

    $profileId = preg_replace('/ /s', '', $user["nome"] . "_" . $user["cognome"] . "_" . $user["idPersona"]);
    return $profileUrl . $profileId;
}
function get_email_from($html)
{
    $doc = new DOMDocument();
    // This will make a warning caused by HTML5 parsing that we don't care
    // LIBXML_NOERROR is used to not showing the error
    // better understanding in https://stackoverflow.com/questions/10712503/how-to-make-html5-work-with-domdocument
    $doc->loadHtml($html, LIBXML_NOERROR);
    return $doc
        ->getElementById("page")
        ->getElementsByTagName("a")
        ->item(0)
        ->textContent;
}
// isValid($_POST["nome"], $_POST["cognome"], $_POST["email"]);
// if (isValid("cristina", "bamonti", "mariabamonti@psypec.it"))
//     echo "oK";
// else
//     echo "not valid";
