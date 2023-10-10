<?php
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

echo json_response($noteData);
/** is this correct? */

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
        'response' => $message
    ));
}