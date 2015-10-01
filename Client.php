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

    public function send($fileDirectory){




        $this->manager->sendMessage($message);
    }
}