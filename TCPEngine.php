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

    public function createSocket(){
        $this->socketPointer = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if($this->socketPointer == false){
            die("Can't create a socket");
        }else{
            print("Socket Created\n");
        }
    }



}