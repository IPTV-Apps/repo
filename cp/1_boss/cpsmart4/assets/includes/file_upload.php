<?php

$sqlite3 = new SQLite3('../../api/.cockpit-0001.db');

$file_name = $_FILES['file']['name'];
$file_size = $_FILES['file']['size'];
$file_tmpName  = $_FILES['file']['tmp_name'];
$file_type = $_FILES['file']['type'];

$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

$upload_path = "../../assets/data/ovpn/" . basename($file_name);

$ext_allowed = ['ovpn'];

$message = "";
$errors = [];

if (isset($_POST['submit'])) {

    if (!in_array($file_extension, $ext_allowed)) {
        $errors[] = "This file extension is not allowed. Please upload a OVPN file";
    }

    if ($file_size > 43000000) {
        $errors[] = "File exceeds maximum size (43MB)";
    }

    if (empty($errors)) {
        $uploaded = move_uploaded_file($file_tmpName, $upload_path);

        if ($uploaded) {
            $sql = "INSERT INTO `ovpn_whmcssmarters` (";
            $sql .= "`create_time`, ";
            $sql .= "`file_name`, ";
            $sql .= "`file_size`, ";
            $sql .= "`file_type`) ";
            $sql .= "VALUES (";
            $sql .= "\"" . date("Y-m-d h:i:s") . "\", ";
            $sql .= "\"" . $file_name . "\", ";
            $sql .= "\"" . $file_size . "\", ";
            $sql .= "\"" . $file_type . "\");";
            if ($sqlite3->exec($sql) === true) {
                $message = "File added successfully.";
                header("Location: ../../whmcssmarters_ovpn.php");
            }
        } else {
            $message = "An error occurred. Please contact the your Reseller.";
            header("Location: ../../whmcssmarters_ovpn.php");
        }
    } else {
        foreach ($errors as $error) {
            $message = $error . "\n";
            header("Location: ../../whmcssmarters_ovpn.php");
        }
    }
}
