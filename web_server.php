<?php 
    use \Workerman\Worker;
    use \Workerman\WebServer;
    require_once './Workerman/Autoloader.php';
    
    $webserver = new WebServer('http://0.0.0.0:8080');
    $webserver->addRoot('localhost','./htdocs/');
    $webserver->count = 2 ;

    Worker::runAll();

