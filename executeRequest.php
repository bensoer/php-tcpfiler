<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 04/10/15
 * Time: 3:41 PM
 */

ob_start();
error_reporting(-1);
require_once('./tcpfiler/Client.php');

function getAndMoveFileData($fileName = null){

    $origFileName = "";
    if($fileName == null){
        $origFileName = $_FILES['file_upload']["name"];
    }else{
        $origFileName = $fileName;
    }

    $tmpFileName = $_FILES['file_upload']["tmp_name"];

    //move the file with its original name to the client's data folder
    move_uploaded_file($tmpFileName, "./tcpfiler/data/$origFileName");

    return $origFileName;
}


$fileName = null;
$mode = "";

if(isset($_POST['file_name']) && (!empty($_POST['file_name']))){

    $value = $_POST['file_name'];
    if(strip_tags($_POST['file_name']) != $value){
        die("Injection Attempt Detecting. Aborting All Processing");
    }else{
        $fileName = $_POST['file_name'];
    }
}else{
    die("An Invalid File Name Was Given. Please Enter A Valid File Name and Try Again");
}

if(isset($_POST["mode_switch"])){
    $mode = "SEND";
    $confirmedFileName = getAndMoveFileData($fileName);

    $client = new Client($mode);
    $client->connect();
    $client->executeRequest("./tcpfiler/data/$confirmedFileName");

    $fileName = $confirmedFileName;

}else{
    $mode = "GET";

    $client = new Client($mode);
    $client->connect();
    $fileContents = $client->executeRequest($fileName, true);

    echo "<hr>";
    echo "<br><br><br>";

    echo "<p>" . $fileContents . "</p>";

    ob_clean();

    if (file_exists("./tcpfiler/uploads/$fileName")) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize("./tcpfiler/uploads/$fileName"));
        readfile("./tcpfiler/uploads/$fileName");
        exit;
    }

}

ob_flush();





