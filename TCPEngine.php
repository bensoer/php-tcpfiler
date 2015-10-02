<?php

/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 01/10/15
 * Time: 11:33 AM
 */
class TCPEngine
{


    private $socketPointer;
    private $sessionSocketPointer;
    private $isServer = false;


    public function createSocket(){
        $this->socketPointer = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if($this->socketPointer == false){
            die("Can't create a socket");
        }else{
            print("Socket Created\n");
        }
    }

    public function makeBind($port){

        if(!socket_bind($this->socketPointer, "127.0.0.1", $port)){
            die("Can't bind name to socket");
        }else{
            print("Port Binding Complete\n");
        }

    }

    public function initiateListen($maxRequestQueue = 5){
        socket_listen($this->socketPointer, $maxRequestQueue);
        print("TCP Engine Now Listening\n");
    }

    public function startSession(){

        $this->isServer = true;
        $this->sessionSocketPointer = socket_accept($this->socketPointer);

        if($this->sessionSocketPointer == false){
            print("ERROR\n");
            print(socket_last_error($this->socketPointer));
            die("Can't Accept Client\n");
        }else{
            print("Session Initiated. Now Ready To Transmit\n");
        }


    }

    public function disconnect(){
        if($this->isServer){
            socket_shutdown($this->sessionSocketPointer);
            socket_close($this->sessionSocketPointer);
        }else{
            socket_shutdown($this->socketPointer);
            socket_close($this->socketPointer);
        }
    }

    public function connectToServer($host, $port){

        $hostAddress = gethostbyname($host);
        if($hostAddress === $host){
            die("Unable to resolve host");
        }else{
            print("Hostname Resolved\n");
        }

        if(!socket_connect($this->socketPointer,$hostAddress,$port)){
            die("Failed to Connect to Server");
        }else{
            print("Connection Established\n");
        }
    }

    public function sendMessage($message){

        print("Sending Message\n");
        if($this->isServer){
            socket_send($this->sessionSocketPointer, $message, strlen($message), 0);
            $this->sendDoneMessage();
        }else{
            socket_send($this->socketPointer, $message, strlen($message), 0);
            $this->sendDoneMessage();
        }
    }

    public function sendDoneMessage(){

        $done = "DOnE!";

        if($this->isServer){
            socket_send($this->sessionSocketPointer, $done, strlen($done), 0);
        }else{
            socket_send($this->socketPointer, $done, strlen($done), 0);
        }

    }

    public function receiveMessage(){

        $socket = $this->isServer ? $this->sessionSocketPointer : $this->socketPointer;

        $totalMessage = "";

        while(1){
            $message = "";
            $bitsorerror = socket_recv($socket, $message, 2048, 0);
            if($bitsorerror == false){
                die("There was an error recieving the bits");
            }

            $position = strpos($message, "DOnE!");
            if($position === false){
                //done could not be found
                print("The done was not found. Keep Going\n");
                $totalMessage = $totalMessage . $message;
            }else{
                //the done was found
                $content = substr($message, 0, $position);
                print("Done was found, Were done\n");
                $totalMessage = $totalMessage . $content;
                break;
            }


        }

        return $totalMessage;

    }






}