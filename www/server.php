<?php

use Swoole\Websocket\Frame;
use Swoole\Websocket\Server;


$server = new Server("0.0.0.0", 80);
/*
$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});
//*/
$server->on('message', function($server, $frame) {
        //echo "received message: {$frame->data}\n";
        $conexoes = $server->connections;
        $origem = $frame->fd;
        foreach($conexoes as $conexao){
                if($conexao === $origem) continue;

                $server->push($conexao, json_encode(['type' => 'chat', 'text' => $frame->data]));
        }
   // $server->push($frame->fd, json_encode(["connect", "Swoole-websocket-php"]));
});
/*
$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});
// */
$server->start();
