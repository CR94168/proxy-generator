<?php
echo "Starting...\n";
$proxy_list = [
    [
        'address' => 'https://raw.githubusercontent.com/clarketm/proxy-list/master/proxy-list-raw.txt',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/clarketm/proxy-list/master/proxy-list-raw.txt',
        'type' => 'socks4'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/clarketm/proxy-list/master/proxy-list-raw.txt',
        'type' => 'socks5'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/TheSpeedX/PROXY-List/master/http.txt',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/TheSpeedX/SOCKS-List/master/socks4.txt',
        'type' => 'socks4'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/TheSpeedX/SOCKS-List/master/socks5.txt',
        'type' => 'socks5'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/ShiftyTR/Proxy-List/master/proxy.txt',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/sunny9577/proxy-scraper/master/proxies.txt',
        'type' => 'http'
    ]
];

$data = "";
foreach ($proxy_list as $proxy) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $proxy['address']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = explode("\n", $output);

    foreach ($output as $line) {
        $line = $proxy['type'] . '://' . $line . "\n";
        $data .= $line;
    }
}
file_put_contents('proxy.txt', $data);
echo "Finished! \n";
