<?php
session_start();

$name= $_GET['name'];

    // header('Content-Description: File Transfer');
    // header('Content-Type: application/force-download');
    // header("Content-Type: ".mime_content_type($name));
    // header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    // header('Content-Transfer-Encoding: binary');
    // header('Expires: 0');
    // header('Cache-Control: must-revalidate');
    // header('Pragma: public');
    // header('Content-Length: ' . filesize($name));
    // ob_clean();
    // flush();
    // readfile($file); //showing the path to the server where the file is to be download
    // exit;

$name = $_GET["name"];
$contenttype = "application/force-download";
header("Content-Type: " . $contenttype);
header("Content-Type: ".mime_content_type(basename($name)));
header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
readfile($name);
exit();

// if(!file_exists($name)){ // file does not exist
//     die('file not found');
// } else {
//     header("Cache-Control: public");
//     header("Content-Description: File Transfer");
//     header("Content-Disposition: attachment; filename=$name");
//     header("Content-Type: ".mime_content_type($name));
//     header("Content-Transfer-Encoding: binary");

//     // read the file from disk
//     readfile($name);
// }
?>