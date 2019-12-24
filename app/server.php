<?php

use App\Manager\DataCenter;

require_once __DIR__ . '/../vendor/autoload.php';

class Server
{
    const HOST = '0.0.0.0';
    const PORT = 8811;
    const FRONT_PORT = 8812;

    const CONFIG = [
        'worker_num' => 4,
        'enable_static_handler'=>true,
        'document_root'=> '/Users/yx/service/HideAndSeek/frontend'
    ];
    private $ws;

    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);
        $this->ws->listen(self::HOST, self::FRONT_PORT, SWOOLE_SOCK_TCP);

        $this->ws->set(self::CONFIG);
        $this->ws->on('start', [$this, 'onStart']);
        $this->ws->on('workerStart', [$this, 'onWorkerStart']);
        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
        $this->ws->on('close', [$this, 'onClose']);
        $this->ws->start();
    }

    public function onStart($server)
    {
        //低版本linux系统和os x不支持修改进程名称
        //swoole_set_process_name('hide-and-seek');
        echo sprintf(
            "master start (listening on %s:%d)\n",
            self::HOST,
            self::PORT
        );
    }

    public function onWorkerStart($server, $workerId)
    {
        echo "server: onWorkStart,worker_id:{$server->worker_id}\n";

    }

    public function onOpen($server, $request)
    {
        DataCenter::log(sprintf('client open fd :%d',$request->fd));
        $server->push($request->fd, '已成功连接服务器');
    }

    public function onClose($server, $fd)
    {
        DataCenter::log(sprintf('client close fd :%d', $fd));
    }

    public function onMessage($server, $request)
    {
        DataCenter::log(sprintf('client open fd：%d，message：%s', $request->fd, $request->data));
        //$server->push($request->fd, 'test success');
    }
}
new Server();
