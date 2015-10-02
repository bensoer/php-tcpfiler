<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 01/10/15
 * Time: 11:35 AM
 */

require_once('./TCPEngine.php');

$manager = new TCPEngine();
$manager->createSocket();
$manager->makeBind(7000);
$manager->initiateListen();

while(1){

    $manager->startSession();

    $data = $manager->receiveMessage();

    if(substr($data,0,3) == "GET"){

        print("GET Request Received\n");

        $file = substr($data,4,strlen($data)-4);
        $fileContents = file_get_contents("./uploads/" . $file);

        $manager->sendMessage($fileContents);

    }

    if(substr($data,0,4) == "SEND"){

        print("SEND Request Received\n");

        $firstSpace = strpos($data, ' ', 6);

        $filename = substr($data, 5, $firstSpace - 5);

        print("Saving To File: " . $filename . "\n");

        $secondSpace = strpos($data, ' ', $firstSpace);
        $fileContents = substr($data, $secondSpace+1, strlen($data) - $secondSpace);

        print("Saving Contents: " . $fileContents . "\n");

        $fp = fopen("./uploads/" . $filename, "w") or die("Unable to open file");
        fwrite($fp, $fileContents);
        fclose($fp);
    }

}