<?php

if (isset($_GET['action']) && $_GET['action'] == 'dns') {
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
    // array_push($dnsList, $player_api_path);
    echo json_response(rtrim(implode(',', $dnsList), ','));
}
if (isset($_GET['action']) && $_GET['action'] == 'note') {
    $sqlite3 = new SQLite3('../.cockpit-0001.db');
    $sql = "SELECT * FROM note_whmcssmarters;";
    $note_data = $sqlite3->query($sql);

    while ($row = $note_data->fetchArray()) {
        $noteData[] = array(
            "Title" => $row['Title'],
            "Description" => $row['Description'],
            "CreateDate" => $row['CreateDate']
        );
    }

    echo json_response_note($noteData);
    /** is this correct? */
}

function json_response($message = null, $code = 200)
{
    header_remove();
    http_response_code($code);
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
    );
    header('Status: ' . $status[$code]);
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'su' => $message,
        'sc' => md5(str_replace('\\', '', $message . "*NB!@#12ZKWd*" . $_POST['r'])),
        'ndd' => ''
    ));
}

function json_response_note($message = null, $code = 200)
{
    header_remove();
    http_response_code($code);
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
    );
    header('Status: ' . $status[$code]);
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'response' => $message
    ));
}