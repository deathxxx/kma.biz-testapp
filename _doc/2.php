
<?php
// Create a cURL handle
$ch = curl_init('http://www.example.com/');

// Execute
curl_exec($ch);

// Check if any error occurred
if (!curl_errno($ch)) {
    $info = curl_getinfo($ch);
    echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
    echo 'Took ', $info['size_download'], ' size ', $info['url'], "\n";
}

// Close handle
curl_close($ch);
?>
