<?php
if (file_exists('ovpn.zip')) {
	unlink('ovpn.zip');
}
$zip = new ZipArchive();
$zip->open("ovpn.zip",  ZipArchive::CREATE);
foreach (glob('../../assets/data/ovpn/*.ovpn') as $file) {
    if (file_exists($file)) {
        $zip->addFromString(basename($file),  file_get_contents($file));
    }
}
$zip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=ovpn.zip');
header('Content-Length: ' . filesize("ovpn.zip"));
readfile("ovpn.zip");
?>