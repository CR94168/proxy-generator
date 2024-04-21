<?php
// Define colors
define('COLOR_RED', "\033[0;31m");
define('COLOR_GREEN', "\033[0;32m");
define('COLOR_YELLOW', "\033[0;33m");
define('COLOR_BLUE', "\033[0;34m");
define('COLOR_CYAN', "\033[0;36m");
define('COLOR_ORANGE', "\033[38;5;208m");
define('COLOR_PURPLE', "\033[0;35m");
define('COLOR_GRAY', "\033[0;37m");
define('COLOR_BOLD', "\033[1m");
define('COLOR_UNDERLINE', "\033[4m");
define('COLOR_BLINK', "\033[5m");
define('COLOR_INVERT', "\033[7m");
define('COLOR_HIDDEN', "\033[8m");
define('COLOR_MAGENTA', "\033[0;35m");
define('COLOR_WHITE', "\033[0;37m");
define('COLOR_BOLD_RED', "\033[1;31m");
define('COLOR_BOLD_GREEN', "\033[1;32m");
define('COLOR_BOLD_YELLOW', "\033[1;33m");
define('COLOR_BOLD_BLUE', "\033[1;34m");
define('COLOR_BOLD_CYAN', "\033[1;36m");
define('COLOR_BOLD_PURPLE', "\033[1;35m");
define('COLOR_BOLD_GRAY', "\033[1;37m");
define('COLOR_BOLD_MAGENTA', "\033[1;35m");
define('COLOR_BOLD_WHITE', "\033[1;37m");
define('COLOR_RESET', "\033[0m");


echo COLOR_ORANGE . "Starting...\n" . COLOR_RESET;
$limit = isset($argv[1]) && $argv[1] === '--limit' && isset($argv[2]) ? intval($argv[2]) : 999999999999999999;

if ($limit !== 999999999999999999) {
    echo COLOR_ORANGE . "Limit : " . COLOR_BOLD_MAGENTA . $limit . "\n";
}

$proxy_list = [
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
        'address' => 'https://api.proxyscrape.com/v2/?request=getproxies&protocol=http&timeout=5000&country=all&ssl=all&anonymity=all',
        'type' => 'http'
    ],
    [
        'address' => 'https://api.proxyscrape.com/v2/?request=getproxies&protocol=socks4&timeout=5000&country=all&ssl=all&anonymity=all',
        'type' => 'socks4'
    ],
    [
        'address' => 'https://api.proxyscrape.com/v2/?request=getproxies&protocol=socks5&timeout=5000&country=all&ssl=all&anonymity=all',
        'type' => 'socks5'
    ],
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
        'address' => 'https://raw.githubusercontent.com/ShiftyTR/Proxy-List/master/proxy.txt',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/ShiftyTR/Proxy-List/master/http.txt',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/ShiftyTR/Proxy-List/master/socks4.txt',
        'type' => 'socks4'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/ShiftyTR/Proxy-List/master/socks5.txt',
        'type' => 'socks5'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/ShiftyTR/Proxy-List/master/https.txt',
        'type' => 'https'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/sunny9577/proxy-scraper/master/proxies.txt',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/andigwandi/free-proxy/main/proxy_list.txt',
        'type' => 'http'
    ],

    [
        'address' => 'https://www.proxy-list.download/api/v1/get?type=socks4',
        'type' => 'socks4'
    ],
    [
        'address' => 'https://www.proxy-list.download/api/v1/get?type=http',
        'type' => 'http'
    ],
    [
        'address' => 'https://raw.githubusercontent.com/opsxcq/proxy-list/master/list.txt',
        'type' => 'http'
    ],
    // [
    //     'address' => 'https://www.proxyscan.io/download?type=http',
    //     'type' => 'http'
    // ],
    // [
    //     'address' => 'https://www.proxyscan.io/download?type=https',
    //     'type' => 'https'
    // ],
    // [
    //     'address' => 'https://www.proxyscan.io/download?type=socks4',
    //     'type' => 'socks4'
    // ],
    // [
    //     'address' => 'https://www.proxyscan.io/download?type=socks5',
    //     'type' => 'socks5'
    // ],
];

$data = "";
$count = 0;
$counter = ['http' => 0, 'https' => 0, 'socks4' => 0, 'socks5' => 0];
foreach ($proxy_list as $proxy) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $proxy['address']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    if ($count >= $limit) {
        break;
    }

    $output = explode("\n", $output);
    $counter[$proxy['type']] += count($output);
    foreach ($output as $line) {
        if ($count >= $limit) {
            break;
        }

        if (empty($line)) {
            continue;
        }

        $line = $proxy['type'] . '://' . $line . "\n";
        $data .= $line;
        $count++;
        echo COLOR_ORANGE . "Fetching proxies.... " . COLOR_BOLD_CYAN . $count . COLOR_RESET . "\r";
    }
}
echo "\n";
echo COLOR_GREEN . "Total: " . COLOR_BOLD_CYAN . $count . COLOR_RESET . " proxies\n";
echo COLOR_BOLD_BLUE . "HTTP: " . COLOR_BOLD_CYAN . $counter['http'] . COLOR_RESET . " proxies\n";
echo COLOR_BOLD_BLUE . "HTTPS: " . COLOR_BOLD_CYAN . $counter['https'] . COLOR_RESET . " proxies\n";
echo COLOR_BOLD_PURPLE . "SOCKS4: " . COLOR_BOLD_CYAN . $counter['socks4'] . COLOR_RESET . " proxies\n";
echo COLOR_BOLD_CYAN . "SOCKS5: " . COLOR_BOLD_CYAN . $counter['socks5'] . COLOR_RESET . " proxies\n";
file_put_contents('proxy.txt', $data);
echo COLOR_ORANGE . "Finished!" . COLOR_RESET .  "\n";
echo COLOR_GREEN . "Saved to proxy.txt\n" . COLOR_RESET;
