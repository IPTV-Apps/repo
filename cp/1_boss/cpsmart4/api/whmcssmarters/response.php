<?php
$sqlite3 = new SQLite3('../.cockpit-0001.db');
$sql = "SELECT * FROM ads_whmcssmarters;";
$ad_data = $sqlite3->query($sql);

$adList = array();
$count = 0;
while ($row = $ad_data->fetchArray()) {
    array_push($adList, new AdData('' . $row['id'], $row['title'], $row['type'], $row['link'], $row['description'], $row['orderby'], $row['position'], $row['extension'], $row['createdon'], $row['path'], $row['orignal'], $row['thumbpath']));

    $count++;
}
echo json_response($adList);

function json_response($message = null)
{
    global $count;
    return json_encode(array(
        'result' => 'success', // success or not?
        'data' => array(
            'vertical' => array(
                'adds' => $message,
                'count' => $count
            )
        )
    ));
}

class AdData {
    public $id;
    public $title;
    public $type;
    public $link;
    public $description;
    public $orderby;
    public $position;
    public $extension;
    public $createdon;
    public $path;
    public $orignal;
    public $thumbpath;

    public function __construct($id, $title, $type, $link, $description, $orderby, $position, $extension, $createdon, $path, $orignal, $thumbpath)
    {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->link = $link;
        $this->description = $description;
        $this->orderby = $orderby;
        $this->position = $position;
        $this->extension = $extension;
        $this->createdon = $createdon;
        $this->path = $path;
        $this->orignal = $orignal;
        $this->thumbpath = $thumbpath;
    }

}