<?php 
session_start();
$key = ini_get('session.upload_progress.prefix').'progression';
 
if(!empty($_SESSION[$key]))
{
    $data = $_SESSION[$key];
    $bytes_processed = $data['bytes_processed'];
    $content_length = $data['content_length'];
    $pourcentage = round($bytes_processed * 100 / $content_length, 2);
}
else
{
    $pourcentage = 100;
}
 
echo json_encode($pourcentage);
?>