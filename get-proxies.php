<?php
error_reporting(E_ERROR | E_PARSE);
if (!isset($_GET['key'])) {
    if (!$_GET['key'] === '5d82d1e9ad53b32634c6b2c6a75b033e') {
        die('Invalid key');
    }
    die('Invalid key');
}
include_once 'source.php';
$data = "";
$count = 0;
$counter = ['http' => 0, 'https' => 0, 'socks4' => 0, 'socks5' => 0];
foreach ($proxy_list as $proxy) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $proxy['address']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = explode("\n", $output);
    $counter[$proxy['type']] += count($output);
    foreach ($output as $line) {
        if (empty($line)) {
            continue;
        }

        //$line = $proxy['type'] . '://' . $line . "\n";
        //$data .= $line;
        echo $line . "</br>";
    }
}
