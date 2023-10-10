<?php
include_once './assets/includes/db.php';
include_once './assets/includes/config.php';

$sql = "SELECT `title` FROM panel;";
$result = $sqlite3->query($sql);
$panel_title = $result->fetchArray();
?>
<meta charset="utf-8" />
<title><?php echo $USER_PROFILE_PANEL_EDITS ? $panel_title[0] : $USER_PROFILE_PANEL_TITLE; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="CP Master 20 Panel" name="description" />
<meta content="IPTV Apps" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico">

<?php
// header("Set-Cookie: cross-site-cookie=Lax; SameSite=None; Secure");
