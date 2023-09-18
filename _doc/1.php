
<?php

$ch = curl_init("http://www.example.com/");
$fp = fopen("example_homepage.txt", "w");
$fpi = fopen("example_info.txt", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
if(curl_error($ch)) {
    $info = curl_getinfo($ch);
    fwrite($fp, curl_error($ch));
    echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
} else {
    echo "hi";
}
curl_close($ch);
fclose($fp);
fclose($fpi);
?>
