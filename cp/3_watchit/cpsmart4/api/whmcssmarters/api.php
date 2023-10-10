<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$sqlite3 = new SQLite3('../.cockpit-0001.db');

//Banners
if (isset($_GET['type'])) {
    if (isset($_GET['type']) && $_GET['type'] == 'vod') {
        $sql = "SELECT * FROM banners_whmcssmarters where type = 'vod';";
    }

    if (isset($_GET['type']) && $_GET['type'] == 'series') {
        $sql = "SELECT * FROM banners_whmcssmarters where type = 'series';";
    }

    $banner_data = $sqlite3->query($sql);

    $bannerList = array();
    $count = 0;
    while ($row = $banner_data->fetchArray()) {
        array_push($bannerList, new BannerData('' . $row['id'], $row['title'], $row['type'], $row['path']));

        $count++;
    }

    $images = array();
    foreach ($bannerList as $banner) {
        array_push($images, $banner->path);
    }

    echo json_response($images);

    function json_response($images = null)
    {
        global $count;
        return json_encode(array(
            'result' => 'success', // success or not?
            'totalrecords' => $count,
            'images' => $images
        ));
    }

    class BannerData
    {
        public $id;
        public $title;
        public $type;
        public $path;

        public function __construct($id, $title, $type, $path)
        {
            $this->id = $id;
            $this->title = $title;
            $this->type = $type;
            $this->path = $path;
        }
    }

    // V4 API
} else {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $action = $data['action'];

    switch ($action) {
        case 'get_advertisemnt_status':
            $result = $sqlite3->query("SELECT COUNT(*) AS count FROM ads_whmcssmarters");
            $row = $result->fetchArray();
            $advertisementCount = $row['count'];
        
            echo json_encode([
                "result" => "success",
                "sc" => psudo_sc(),
                "add_viewable_rate" => ($advertisementCount >= 1) ? '15' : '0',
                "add_status" => ($advertisementCount >= 1) ? '1' : '0'
            ]);
            break;

        case 'get-advertisement':
        case 'gtadasdvsdasmnt=':
            $query = $sqlite3->query("SELECT * FROM ads_whmcssmarters");
        
            $modifiedAdvertisements = [];
            while ($advertisement = $query->fetchArray(SQLITE3_ASSOC)) {
                $modifiedAdvertisement = [
                    'type' => $advertisement['type'],
                    'pages' => 'dashboard',
                    'images' => ($advertisement['type'] == 'image') ? [$advertisement['path']] : [],
                    'text' => ($advertisement['type'] == 'message') ? $advertisement['description'] : ''
                ];
                $modifiedAdvertisements[] = $modifiedAdvertisement;
            }
        
            $totalRecords = count($modifiedAdvertisements);
            if ($totalRecords > 0) {
                echo json_encode([
                    "result" => "success",
                    "sc" => psudo_sc(),
                    "message" => 'Data retrieved successfully',
                    "totalrecords" => $totalRecords,
                    "data" => $modifiedAdvertisements
                ]);
            } else {
                echo json_encode([
                    "result" => "success",
                    "sc" => psudo_sc(),
                    "message" => 'No advertisements found',
                    "totalrecords" => 0,
                    "data" => []
                ]);
            }
            break;

        case 'add-device':
            $deviceid = $data['deviceid'] ?? '';
            $deviceusername = $data['deviceusername'] ?? '';

            $stmt = $sqlite3->prepare("INSERT OR REPLACE INTO devices(deviceid, deviceusername) VALUES (?, ?)");
            $stmt->bindParam(1, $deviceid);
            $stmt->bindParam(2, $deviceusername);
            $stmt->execute();
            echo json_encode([
                "result" => "success",
                "sc" => psudo_sc(),
                "message" => "Details Updated Successfully"
            ]);
            break;

        case 'syhtrwqedfjhg=':
            echo '123';
            break;

        case 'check-maintainencemode':
        case 'hddgfhfghs=':
            $result = $sqlite3->querySingle("SELECT title, body, mode FROM maintenance_whmcssmarters WHERE id=1", true);

            echo json_encode([
                "result" => "success",
                "sc" => psudo_sc(),
                "maintenancemode" => $result['mode'] ?? 'off',
                "message" => $result['title'] ?? '',
                "footercontent" => $result['body'] ?? ''
            ]);
            break;

        case 'addreport':
        case 'djfhkgsdfhjksdfjkh=':
            $stmt = $sqlite3->prepare("INSERT INTO reports_whmcssmarters (username, macaddress, section, section_category, report_title, report_sub_title, report_cases, report_custom_message, stream_name, stream_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bindParam(1, $data['username']);
            $stmt->bindParam(2, $data['macaddress']);
            $stmt->bindParam(3, $data['section']);
            $stmt->bindParam(4, $data['section_category']);
            $stmt->bindParam(5, $data['report_title']);
            $stmt->bindParam(6, $data['report_sub_title']);
            $stmt->bindParam(7, $data['report_cases']);
            $stmt->bindParam(8, $data['report_custom_message']);
            $stmt->bindParam(9, $data['stream_name']);
            $stmt->bindParam(10, $data['stream_id']);

            $stmt->execute();

            echo json_encode([
                "result" => "success",
                "sc" => psudo_sc(),
                "message" => "Report added successfully"
            ]);
            break;

        case 'addclientfeedback':
        case 'qqqcdffghq=':
            $stmt = $sqlite3->prepare("INSERT INTO feedback_whmcssmarters (username, macaddress, feedback_content) VALUES (?, ?, ?)");

            $stmt->bindParam(1, $data['username']);
            $stmt->bindParam(2, $data['macaddress']);
            $stmt->bindParam(3, $data['feedback']);

            $stmt->execute();

            echo json_encode([
                "result" => "success",
                "message" => "Feedback sent successfully!"
            ]);
            break;

        case 'get-announcements':
        case 'sjdfgjhksdgfk=':
            $announcements = [];
            $result = $sqlite3->query("SELECT * FROM announcements_whmcssmarters ORDER BY created_on DESC");
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $announcements[] = $row;
            }

            $responseData = [];
            foreach ($announcements as $announcement) {
                $stmt = $sqlite3->prepare("SELECT 1 FROM announcement_views_whmcssmarters WHERE announcement_id = ? AND deviceid = ?");
                $stmt->bindParam(1, $announcement['id']);
                $stmt->bindParam(2, $data['deviceid']);
                $res = $stmt->execute();
                $seen = $res->fetchArray(SQLITE3_ASSOC) ? 1 : 0;

                if ($seen === 0) {
                    $stmt = $sqlite3->prepare("INSERT INTO announcement_views_whmcssmarters (announcement_id, deviceid) VALUES (?, ?)");
                    $stmt->bindParam(1, $announcement['id']);
                    $stmt->bindParam(2, $data['deviceid']);
                    $stmt->execute();
                }

                $announcement['seen'] = $seen;
                $responseData[] = $announcement;
            }

            echo json_encode([
                "result" => "success",
                "sc" => psudo_sc(),
                "message" => count($responseData) ? "Announcements fetched" : "No announcements",
                "totalrecords" => count($responseData),
                "data" => $responseData
            ]);
            break;

        case 'read-announcement':
        case 'QEDMSDdfasd=':
            $stmt = $sqlite3->prepare("INSERT INTO announcement_views_whmcssmarters (announcement_id, deviceid) VALUES (?, ?)");
            $stmt->bindParam(1, $data['announcement_id']);
            $stmt->bindParam(2, $data['deviceid']);
            $stmt->execute();
            break;

        case 'get-ovpnzip':
        case 'hytjsadkjlhA=':
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'];
            $directory = dirname($_SERVER['PHP_SELF']);

            echo json_encode([
                "result" => "success",
                "sc" => psudo_sc(),
                "message" => "Data retrieved successfully",
                "vpnstatus" => "on",
                "link" => $protocol . $host . $directory . "/vpn.php"
            ]);
            break;

        default:
            echo json_encode(['result' => 'error', 'message' => 'Invalid action']);
            break;
    }
}

function psudo_sc()
{
    $randomBytes = random_bytes(16);
    return bin2hex($randomBytes);
}
