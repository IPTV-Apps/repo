<?php
$sqlite3 = new SQLite3('../.cockpit-0001.db');
$sql = "SELECT ovpn_user, ovpn_pass FROM vpn_cred_whmcssmarters;";
$result = $sqlite3->query($sql);

$file = fopen('ovpnfile.txt', 'w');

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    fwrite($file, $row['ovpn_user'] . "\n");
    fwrite($file, $row['ovpn_pass']);
}
fclose($file);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="ovpnfile.txt"');
readfile("ovpnfile.txt");

?>