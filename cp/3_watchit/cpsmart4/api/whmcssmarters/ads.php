<?php
if (isset($_GET['ad-type']) && $_GET['ad-type'] == 'rtxadview') {
    try {
        $db = new SQLite3('../.cockpit-0001.db');
        
        $sql = "SELECT * FROM ads_whmcssmarters WHERE TRIM(type) LIKE 'image%';";
        $advertisement_img_query = $db->query($sql);

        if ($advertisement_img_query->fetchArray(SQLITE3_ASSOC)) {
            $adUrls = array();
            while ($row = $advertisement_img_query->fetchArray(SQLITE3_ASSOC)) {
                $adUrls[] = array('AdUrl' => $row['path']);
            }
            $jsonData = json_encode($adUrls);
            $page = '/api/webview/rtxmediaslideshow.php?data=' . base64_encode($jsonData);
        } else {
            $page = '/api/webview/rtxmoviebanner.php';
        }

        $db->close();
    } catch (Exception $e) {
        die("Database connection failed: " . $e->getMessage());
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . explode('/api', $_SERVER['REQUEST_URI'])[0] . $page);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    echo $output;
}
?>