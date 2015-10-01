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

    print($data);

}