<?php
    use Workerman\Worker;
    use Workerman\Lib\Timer;
    require_once './Workerman/Autoloader.php';

    // 初始化一个worker容器，监听1234端口
    $worker = new Worker('websocket://0.0.0.0:1234');

    /*
     * 注意这里进程数必须设置为1，否则会报端口占用错误
     * (php 7可以设置进程数大于1，前提是$inner_text_worker->reusePort=true)
     */
    $worker->count = 1;

    $worker->onMessage = function($connection,$data){
        echo 'Receive message : '.$data."\n";
        //$connection->send('Hello,world!');
    };

    $worker->onConnect= function($connection){
        echo 'Connection opened.'."\n";
    };

    $worker->onClose = function($connection){
        echo 'Connection closed.'."\n";
    };

    $worker->onError = function($connection,$code,$msg){
        echo "Error $code : $msg."."\n";
    };

    $worker->onWorkerStart = function($worker){
        Timer::add(1,function()use($worker){
            $cpu_status = mt_rand(1,100);
            foreach($worker->connections as $connection){
                $connection->send(json_encode(array('type'=>'cpu_status','data'=>$cpu_status)));
            }
        });
    };

    Worker::runAll();
