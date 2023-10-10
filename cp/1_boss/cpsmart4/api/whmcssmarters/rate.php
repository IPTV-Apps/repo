<?php
$sqlite3 = new SQLite3('../.cockpit-0001.db');
$sql = "SELECT * FROM rate_whmcssmarters;";
$rateus_data = $sqlite3->query($sql);

header("Location: " . $rateus_data->fetchArray()['rateus_url']);