<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.10.15
 * Time: 22:23
 */
require_once 'HTTP/Request2.php';
require_once './classes/Gosuslugi.php';
require_once './classes/Auth.php';
require_once './classes/User.php';

$user = new \classes\User();
$user->getUserPage();