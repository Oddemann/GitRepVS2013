<?php
require_once('../../../wp-load.php'); 
//include_once "/Classes/usercodeToId.php";
//include_once "/Classes/CommonValues.php";
include_once ClassIncluder.php;
global $wpdb;
$fileref = $_REQUEST['fileref'];


$userob= new usercodeToId();

$q = 'SELECT ud.id, ud.userref, ud.internName, ud.filetype, ud.category, ud.viewableMedic,ud.filename, ud.filesize';
$q.= ' FROM wmc_user_document AS ud';
$q.= ' WHERE '.$userob->meddicSqlPart.'ud.id ='.$fileref .' AND ud.userref =  '.$userob->userid.';';

$row= $wpdb->get_row($q);
if ($row == null)
    die('Error: Database error (wrong use of database)');

$cv= new CommonValues();
$internFile=$cv->PathAndName($row->internName);

/*
$internFile='C:\Users\Public\Pictures\Sample Pictures\desert.jpg';
if (file_exists($internFile)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="desert.jpg"');//.$row->filename);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize(internName));
    readfile($internFile) ;
    exit;
}*/

$local_file = $cv->PathAndName($row->internName);

$download_file = $row->filename;

// set the download rate limit (=> 20,5 kb/s)
$download_rate = 220.5;
if(file_exists($local_file) && is_file($local_file))
{
    header('Cache-control: private');
    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize($local_file));
    header('Content-Disposition: attachment; filename='.$download_file);  
          // viss filen skal vises i browservindu, ta vekk: attachment;  

    flush();
    $file = fopen($local_file, "r");
    while(!feof($file))
    {
        // send the current file part to the browser
        print fread($file, round($download_rate * 1024));
        // flush the content to the browser
        flush();
        // sleep one second
        sleep(1); // trengs denne?
    }
    fclose($file);
}
else {
    die('Error: The file '.$local_file.' does not exist!');
}

?>