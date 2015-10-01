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
$manager->connectToServer("localhost", 7000);

$manager->sendMessage("HEELOOOO");