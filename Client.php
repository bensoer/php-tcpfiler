<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 01/10/15
 * Time: 11:35 AM
 */


require_once("./TCPEngine.php");
class Client {

    private $mode;
    private $manager;

    public function __construct($mode){

        if($mode !== "SEND" && $mode !== "GET"){
            throw new InvalidArgumentException("Mode Must Be SEND or GET");
        }else{
            $this->mode = $mode;
        }

        $this->manager = new TCPEngine();


    }

    public function connect($host = "localhost", $port = 7000){

        $this->manager->createSocket();
        $this->manager->connectToServer($host, $port);
    }

    public function executeRequest($fileDirectory){


        $message = "";
        if($this->mode == "SEND"){
            $fileContents = file_get_contents($fileDirectory);
            $lastSlash = strrpos($fileDirectory, "/") + 1;
            $filename = substr($fileDirectory, $lastSlash, strlen($fileDirectory) - $lastSlash);
            print("Sending File: " . $filename . "\n");
            $message = "SEND " . $filename . " " . $fileContents;

            $this->manager->sendMessage($message);
        }

        if($this->mode == "GET"){
            print("Getting File Located In This Rel. Directory: " . $fileDirectory . "\n");
            $message = "GET " . $fileDirectory;

            $this->manager->sendMessage($message);

            $data = $this->manager->receiveMessage();

            print("Message Received");

            $lastSlash = strrpos($fileDirectory, "/");
            $filename = substr($fileDirectory, $lastSlash, strlen($fileDirectory) - $lastSlash);

            $fp = fopen("./data/" . $filename, "w") or die("Unable to open file");;
            fwrite($fp, $data);
            fclose($fp);
            //file_put_contents("./data/" . $filename, $data);

        }




    }
}