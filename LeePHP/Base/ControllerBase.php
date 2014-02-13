<?php
namespace LeePHP\Base;

use LeePHP\Interfaces\ISwoole;
use LeePHP\Interfaces\IController;
use LeePHP\Base\Base;
use LeePHP\Bootstrap;
use LeePHP\Protocol\DataParser;

/**
 * 控制器基类。
 *
 * @author Lei Lee <web.developer.network@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2013, Lei Lee
 */
class ControllerBase extends Base implements IController {
    /**
     * ISwoole 实例。
     *
     * @var ISwoole
     */
    protected $serv;

    /**
     * 当前客户端文件描述符。
     *
     * @var int
     */
    protected $fd = 0;

    /**
     * 当前控制器命令项。
     *
     * @var array
     */
    protected $cmd_data;

    /**
     * 构造函数。
     * 
     * @param Bootstrap $ctx  指定上下文对象。
     * @param ISwoole $serv   指定 Swoole 服务实例。
     * @param int $fd         指定客户端文件描述符。
     * @param array $cmd_data 指定当前命令数据。
     */
    function __construct($ctx, $serv, $fd, &$cmd_data) {
        parent::__construct($ctx);

        $this->serv     = $serv;
        $this->fd       = $fd;
        $this->cmd_data = $cmd_data;
    }

    /**
     * 析构函数。
     */
    function __destruct() {
        parent::__destruct();

        unset($this->serv, $this->cmd_data);
    }

    /**
     * 初始化事件。
     */
    function initialize() {
        
    }

    /**
     * 内存释放。
     */
    function dispose() {
        
    }

    /**
     * 发送数据给客户端。
     * 
     * @param array $data 指定数据集合。
     */
    protected function send($data) {
        $this->serv->send($this->fd, DataParser::std($this->cmd_data[2], $this->cmd_data[3], $data));
    }

    /**
     * 发送错误信息给客户端。
     * 
     * @param int $errno
     * @param string $errstr
     */
    protected function error($errno, $errstr) {
        $this->serv->send($this->fd, DataParser::std($this->cmd_data[2], $this->cmd_data[3], NULL, $errno, $errstr));
    }
}