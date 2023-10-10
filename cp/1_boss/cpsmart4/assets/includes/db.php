<?php
$sqlite3 = new SQLite3('./api/.cockpit-0001.db');

/* create table `profile` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS profile(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'profile_name TEXT, ';
$sql .= 'username TEXT, ';
$sql .= 'password TEXT, ';
$sql .= 'avatar_url TEXT);';
$sqlite3->exec($sql);

/* create table `panel` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS panel(';
$sql .= 'title TEXT, ';
$sql .= 'logo_light TEXT, ';
$sql .= 'logo_dark TEXT, ';
$sql .= 'logo_light_sm TEXT, ';
$sql .= 'logo_dark_sm TEXT, ';
$sql .= 'login_gif TEXT);';
$sqlite3->exec($sql);

/* create table `snoop_logs` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS snoop_logs(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'ip TEXT, ';
$sql .= 'date TEXT);';
$sqlite3->exec($sql);

/* create table `tvsg_settings` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS tvsg_settings(';
$sql .= 'widget_id TEXT, ';
$sql .= 'border_color TEXT, ';
$sql .= 'background_color TEXT, ';
$sql .= 'text_color TEXT, ';
$sql .= 'auto_scroll TEXT, ';
$sql .= 'heading TEXT);';
$sqlite3->exec($sql);

/* create table `xc_domains_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS xc_domains_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'name TEXT, ';
$sql .= 'ssl TEXT, ';
$sql .= 'dns TEXT, ';
$sql .= 'port TEXT);';
$sqlite3->exec($sql);

/* create table `banners_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS banners_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY AUTOINCREMENT, ';
$sql .= 'title TEXT, ';
$sql .= 'type TEXT, ';
$sql .= 'path TEXT);';
$sqlite3->exec($sql);

/* create table `ads_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS ads_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'title TEXT, ';
$sql .= 'type TEXT, ';
$sql .= 'link TEXT, ';
$sql .= 'description TEXT, ';
$sql .= 'orderby TEXT, ';
$sql .= 'position TEXT, ';
$sql .= 'extension TEXT, ';
$sql .= 'createdon TEXT, ';
$sql .= 'path TEXT, ';
$sql .= 'orignal TEXT, ';
$sql .= 'thumbpath TEXT);';
$sqlite3->exec($sql);

/* create table `note_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS note_whmcssmarters(';
$sql .= 'Title TEXT, ';
$sql .= 'Description TEXT, ';
$sql .= 'CreateDate TEXT);';
$sqlite3->exec($sql);

/* create table `update_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS update_whmcssmarters(';
$sql .= 'version_code TEXT, ';
$sql .= 'package_name TEXT, ';
$sql .= 'apk_url TEXT);';
$sqlite3->exec($sql);

/* create table `rate_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS rate_whmcssmarters(';
$sql .= 'rateus_url TEXT);';
$sqlite3->exec($sql);

/* create table `ovpn_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS ovpn_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'create_time TEXT, ';
$sql .= 'file_name TEXT, ';
$sql .= 'file_size TEXT, ';
$sql .= 'file_type TEXT);';
$sqlite3->exec($sql);

/* create table `vpn_cred_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS vpn_cred_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'ovpn_user TEXT, ';
$sql .= 'ovpn_pass TEXT);';
$sqlite3->exec($sql);

/* create table `maintenance_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS maintenance_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'title TEXT, ';
$sql .= 'body TEXT, ';
$sql .= 'mode TEXT);';
$sqlite3->exec($sql);

/* create table `advertisement_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS advertisement_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'status TEXT, ';
$sql .= 'viewable_rate TEXT, ';
$sql .= 'message TEXT);';
$sqlite3->exec($sql);

/* create table `reports_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS reports_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'username TEXT, ';
$sql .= 'macaddress TEXT, ';
$sql .= 'section TEXT, ';
$sql .= 'section_category TEXT, ';
$sql .= 'report_title TEXT, ';
$sql .= 'report_sub_title TEXT, ';
$sql .= 'report_cases TEXT, ';
$sql .= 'report_custom_message TEXT, ';
$sql .= 'stream_name TEXT, ';
$sql .= 'stream_id INTEGER);';
$sqlite3->exec($sql);

/* create table `feedback_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS feedback_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'username TEXT, ';
$sql .= 'macaddress TEXT, ';
$sql .= 'feedback_content TEXT);';
$sqlite3->exec($sql);

/* create table `announcements_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS announcements_whmcssmarters(';
$sql .= 'id INTEGER PRIMARY KEY AUTOINCREMENT, ';
$sql .= 'title TEXT NOT NULL, ';
$sql .= 'message TEXT NOT NULL, ';
$sql .= 'created_on TEXT NOT NULL);';
$sqlite3->exec($sql);

/* create table `announcement_views_whmcssmarters` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS announcement_views_whmcssmarters(';
$sql .= 'announcement_id INTEGER NOT NULL, ';
$sql .= 'deviceid TEXT NOT NULL, ';
$sql .= 'FOREIGN KEY (announcement_id) REFERENCES announcements_whmcssmarters(id));';
$sqlite3->exec($sql);

/* create table `devices` if not exists */
$sql = 'CREATE TABLE IF NOT EXISTS devices(';
$sql .= 'id INTEGER PRIMARY KEY, ';
$sql .= 'deviceid TEXT, ';
$sql .= 'deviceusername TEXT, ';
$sql .= 'added_on TEXT);';
$sqlite3->exec($sql);


/* get user count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM profile");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `admin` if not exists */
    $sql = 'INSERT INTO profile(';
    $sql .= 'id, ';
    $sql .= 'profile_name, ';
    $sql .= 'username, ';
    $sql .= 'password, ';
    $sql .= 'avatar_url) ';
    $sql .= 'VALUES(';
    $sql .= '1, ';
    $sql .= '"Admin", ';
    $sql .= '"admin", ';
    $sql .= '"admin", ';
    $sql .= '"https://bit.ly/panel_icon");';
    $sqlite3->exec($sql);

    /* inserts default images */
    $sql = 'INSERT INTO panel(';
    $sql .= 'logo_light, ';
    $sql .= 'logo_dark, ';
    $sql .= 'logo_light_sm, ';
    $sql .= 'logo_dark_sm, ';
    $sql .= 'login_gif) ';
    $sql .= 'VALUES(';
    $sql .= '"https://i.imgur.com/6wvFmRC.png", ';
    $sql .= '"https://i.imgur.com/IrhBb1p.png", ';
    $sql .= '"https://i.imgur.com/HgTuiLC.png", ';
    $sql .= '"https://i.imgur.com/HgTuiLC.png", ';
    $sql .= '"https://i.imgur.com/Kj3bflW.gif");';
    $sqlite3->exec($sql);
}

/* get xciptv tvsg settings data count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM tvsg_settings");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `default` tvsg settings data if not exists */
    /* TODO: Cleanup */
    $sql = "INSERT INTO tvsg_settings('widget_id', 'border_color', 'background_color', 'text_color', 'auto_scroll', 'heading') VALUES ('5cc316f797659', '#1d23dd', '#ffffff', '#000000', '1', 'Example Heading');";
    $sqlite3->exec($sql);
}

/* get smarters note settings data count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM note_whmcssmarters");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `default` note settings data if not exists */
    /* TODO: Cleanup */
    $sql = "INSERT INTO note_whmcssmarters('Title', 'Description', 'CreateDate') VALUES ('Example', 'Example Note', '2022-04-07 05:11:38');";
    $sqlite3->exec($sql);
}

/* get smarters vpn_cred settings data count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM vpn_cred_whmcssmarters");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `default` vpn_cred settings data if not exists */
    /* TODO: Cleanup */
    $sql = "INSERT INTO vpn_cred_whmcssmarters('id', 'ovpn_user', 'ovpn_pass') VALUES ('1', 'Username', 'Password');";
    $sqlite3->exec($sql);
}

/* get smarters rateus settings data count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM rate_whmcssmarters");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `default` note settings data if not exists */
    /* TODO: Cleanup */
    $sql = "INSERT INTO rate_whmcssmarters('rateus_url') VALUES ('https://iptvapps.net/services/');";
    $sqlite3->exec($sql);
}

/* get smarters update settings data count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM update_whmcssmarters");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `default` update settings data if not exists */
    /* TODO: Cleanup */
    $sql = "INSERT INTO update_whmcssmarters('version_code', 'package_name', 'apk_url') VALUES ('3.1.5.1', 'com.nst.iptvsmartersbox', 'https://example.com/app.apk');";
    $sqlite3->exec($sql);
}

/* get smarters maintenance whmcssmarters data count */
$result = $sqlite3->query("SELECT COUNT(*) AS count FROM maintenance_whmcssmarters");
$row = $result->fetchArray();
$row_count = $row['count'];
if ($row_count == 0) {
    /* insert `default` maintenance whmcssmarters data if not exists */
    $sql = "INSERT INTO maintenance_whmcssmarters('id', 'title', 'body', 'mode') VALUES ('1', 'We apologize for any inconvenience caused! Our App is presently undergoing maintenance to enhance your experience. We will be back up and running soon. Thank you for being so patient!', 'This App is under Working Plesae wait for sometime', 'off');";
    $sqlite3->exec($sql);
}

$sql = "SELECT * FROM profile ";
$sql .= "WHERE id = '1';";
$result = $sqlite3->query($sql);
$profile_data = $result->fetchArray();

$sql = "SELECT * FROM panel;";
$result = $sqlite3->query($sql);
$panel_data = $result->fetchArray();

$sql = "SELECT * FROM snoop_logs;";
$snoop_logs = $sqlite3->query($sql);

$sql = "SELECT * FROM tvsg_settings;";
$result = $sqlite3->query($sql);
$tvsg_settings = $result->fetchArray();

$sql = "SELECT * FROM xc_domains_whmcssmarters;";
$service_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM note_whmcssmarters;";
$result = $sqlite3->query($sql);
$note_whmcssmarters_data = $result->fetchArray();

$sql = "SELECT * FROM update_whmcssmarters;";
$result = $sqlite3->query($sql);
$update_whmcssmarters_data = $result->fetchArray();

$sql = "SELECT * FROM rate_whmcssmarters;";
$result = $sqlite3->query($sql);
$rateus_whmcssmarters_data = $result->fetchArray();

$sql = "SELECT * FROM ovpn_whmcssmarters;";
$ovpn_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM ads_whmcssmarters;";
$ads_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM banners_whmcssmarters;";
$banners_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM vpn_cred_whmcssmarters;";
$result = $sqlite3->query($sql);
$vpn_cred_whmcssmarters_data = $result->fetchArray();

$sql = "SELECT * FROM maintenance_whmcssmarters;";
$result = $sqlite3->query($sql);
$maintenance_whmcssmarters_data = $result->fetchArray();

$sql = "SELECT * FROM advertisement_whmcssmarters;";
$result = $sqlite3->query($sql);
$advertisement_whmcssmarters_data = $result->fetchArray();

$sql = "SELECT * FROM reports_whmcssmarters;";
$reports_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM feedback_whmcssmarters;";
$feedback_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM announcements_whmcssmarters;";
$announcements_whmcssmarters_data = $sqlite3->query($sql);

$sql = "SELECT * FROM announcement_views_whmcssmarters;";
$announcement_views_whmcssmarters_data = $sqlite3->query($sql);