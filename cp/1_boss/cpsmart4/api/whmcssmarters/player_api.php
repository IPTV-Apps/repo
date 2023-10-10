<?php
date_default_timezone_set('UTC');

$db = new SQLite3('../../api/.cockpit-0001.db');

$db->exec("CREATE TABLE IF NOT EXISTS login_requests(dns TEXT, username TEXT, password TEXT)");

if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
} else if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
} else if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
}

$sql = 'SELECT * FROM xc_domains_whmcssmarters;';
$domain_data = $db->query($sql);

$sql = 'SELECT * FROM login_requests;';
$login_requests = $db->query($sql);

foreach($_GET as $key => $value) 
{ 
    $end .= $key . "=" . $value . "&"; 
}
$post_url = $end;

while ($logins_row = $login_requests->fetchArray()) {
    if ($username == $logins_row['username'] && $password == $logins_row['password']) {
        $redirect_url = $logins_row['dns'] . '/player_api.php?' . $post_url;
        header("Location: " . $redirect_url);
    }
}

while ($domain_row = $domain_data->fetchArray()) 
{
    $domain_string = "";
    if ($domain_row['ssl'] == 'true') {
        $domain_string = "https://";
    } else {
        $domain_string = "http://";
    }
    $domain_string .= $domain_row['dns'];
    $domain_string .= ":" . $domain_row['port'];
    $api_call = $domain_string . '/player_api.php?username=' . @$username . '&password=' . @$password;
    $api_request = call_api($api_call);
    if (@$api_request["result"] == "success") {
        if (isset($api_request["data"] -> user_info -> auth)) {
            if ($api_request["data"] -> user_info -> auth != 0) {
                if ($api_request["data"] -> user_info -> status == "Active") {
                    $redirect_url = $domain_string . '/player_api.php?' . $post_url;
                    $db->exec("INSERT INTO login_requests('dns', 'username', 'password') VALUES ('" . $domain_string . "', '" . $username . "', '" . $password . "');");
                    header("Location: " . $redirect_url);
                }
            }
        }
    } else {
        echo json_response(null);
    }
}

function call_api($api_url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $result = json_decode(curl_exec($ch));

    if (!empty($result)) 
    {
        $returndata = $result;
        return ["result" => "success", "data" => $returndata];
    }
}

function json_response($message = null)
{
    header_remove();
    http_response_code(200);
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    header('Status: 200');
    return json_encode(array(
        'user_info' => $message
    ));
}