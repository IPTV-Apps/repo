<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function get_ip_address()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip)) {
                    return $ip;
                }
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED'])) {
        return $_SERVER['HTTP_X_FORWARDED'];
    }

    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_FORWARDED_FOR'];
    }

    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED'])) {
        return $_SERVER['HTTP_FORWARDED'];
    }

    return $_SERVER['REMOTE_ADDR'];
}

function validate_ip($ip)
{

    if (strtolower($ip) === 'unknown') {
        return false;
    }

    $ip = ip2long($ip);

    if (false !== $ip && -1 !== $ip) {
        $ip = sprintf('%u', $ip);

        if ($ip >= 0 && $ip <= 50331647) {
            return false;
        }

        if ($ip >= 167772160 && $ip <= 184549375) {
            return false;
        }

        if ($ip >= 2130706432 && $ip <= 2147483647) {
            return false;
        }

        if ($ip >= 2851995648 && $ip <= 2852061183) {
            return false;
        }

        if ($ip >= 2886729728 && $ip <= 2887778303) {
            return false;
        }

        if ($ip >= 3221225984 && $ip <= 3221226239) {
            return false;
        }

        if ($ip >= 3232235520 && $ip <= 3232301055) {
            return false;
        }

        if ($ip >= 4294967040) {
            return false;
        }
    }
    return true;
}

function get_operating_system()
{
    global $user_agent;

    $os_platform = "Unknown";
    $os_array    = array('/windows nt 10/i' => 'Windows', '/macintosh|mac os x/i' => 'Mac', '/linux/i' => 'Linux', '/ubuntu/i' => 'Linux', '/iphone/i' => 'iOS', '/ipad/i' => 'iOS', '/android/i' => 'Android', '/webos/i' => 'Android');

    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }

    return $os_platform;
}

function get_browser_type()
{
    global $user_agent;

    $browser = "Unknown";
    $browser_array = array('/msie/i' => 'Internet Explorer', '/firefox/i' => 'Firefox', '/safari/i' => 'Safari', '/chrome/i' => 'Chrome', '/edge/i' => 'Edge', '/opera/i' => 'Opera');

    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

$visitor_ip = get_ip_address();
$visitor_details = json_decode(file_get_contents("http://ipinfo.io/" . $visitor_ip . "/json"));
@$visitor_country = $visitor_details->country;
@$visitor_city = $visitor_details->city;
@$visitor_region = $visitor_details->region;
@$visitor_isp = $visitor_details->org;
$visitor_isp = preg_replace("/AS\d{1,}\s/", "", $visitor_isp);
@$visitor_location = $visitor_details->loc;
$visitor_browser = get_browser_type();
$visitor_os = get_operating_system();

$db = new SQLite3('./.cockpit-0001.db');

$sql = 'INSERT INTO snoop_logs(';
$sql .= 'ip, ';
$sql .= 'date) ';
$sql .= 'VALUES(';
$sql .= '"' . $visitor_ip . '", ';
$sql .= '"' . date("d/m/Y H:i:s") . '");';
$db->exec($sql);
?>

<link href="../assets/css/403.min.css" rel="stylesheet" type="text/css" />

<h1>403</h1>
<div>
    <p>> <span>ERROR CODE</span>: "<i>HTTP 403 Forbidden</i>"</p>
    <p>> <span>ERROR DESCRIPTION</span>: "<i>Access Denied. You Do Not Have The Permission To Access This Page On This
            Server</i>"</p>
    <p>> <span>BROWSER</span>: [<?php echo $visitor_browser; ?>]</p>
    <p>> <span>OPERATING SYSTEM</span>: [<?php echo $visitor_os; ?>]</p>
    <p>> <span>IP ADDRESS</span>: [<?php echo get_ip_address(); ?>]</p>
    <p>> <span>COUNTRY</span>: [<?php echo $visitor_country; ?>]</p>
    <p>> <span>REGION</span>: [<?php echo $visitor_region; ?>]</p>
    <p>> <span>CITY</span>: [<?php echo $visitor_city; ?>]</p>
    <p>> <span>LOCATION</span>: [<?php echo $visitor_location; ?>]</p>
    <p>> <span>ISP</span>: [<?php echo $visitor_isp; ?>]</p>
    <p>> <span>USER-AGENT</span>: [<?php echo $user_agent; ?>]</p>

    <p>> <span>YOUR INFORMATION HAS BEEN LOGGED. ❤</span></p>
</div>

<script src="../assets/js/403.js"></script>