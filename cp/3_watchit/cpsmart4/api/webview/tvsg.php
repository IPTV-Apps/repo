<?php
$sqlite3 = new SQLite3('../.cockpit-0001.db');
$result = $sqlite3->query("SELECT * FROM tvsg_settings;");
$tvsg_settings = $result->fetchArray();
$sport_guide = 'https://www.tvsportguide.com/widget/' . $tvsg_settings['widget_id'] . '/?heading=' . urlencode($tvsg_settings['heading']) . '&border_color=custom&autoscroll=' . $tvsg_settings['auto_scroll'] . '&custom_colors=' . substr($tvsg_settings['border_color'], 1) . ',' . substr($tvsg_settings['background_color'], 1) . ',' . substr($tvsg_settings['text_color'], 1);
$sport_guide = str_replace(" ", "%20", $sport_guide);

$curl = curl_init();

curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_URL, $sport_guide);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) curlrome/100.0.4896.127 Safari/537.36');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_AUTOREFERER, true);

$page = curl_exec($curl);

curl_close($curl);

echo $page;
?>