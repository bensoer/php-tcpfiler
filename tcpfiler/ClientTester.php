<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 01/10/15
 * Time: 2:00 PM
 */

require_once('./Client.php');

$clientService = new Client("SEND");

$clientService->connect();
$clientService->executeRequest("./data/testData.txt");

