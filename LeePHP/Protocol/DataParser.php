<?php
namespace LeePHP\Protocol;

use LeePHP\Utility\Encoder;
use LeePHP\C;

/**
 * 客户端数据解析器。
 *
 * @author Lei Lee <web.developer.network@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2013, Lei Lee
 */
class DataParser {
    /**
     * 构建标准输出数据结构。
     * 
     * @param int $cmd
     * @param array $data
     * @param int $errno
     * @param string $errstr
     * @return string
     */
    static function std($cmd, $data=[], $errno = 0, $errstr = NULL){
        $d = array(
            'errno' => $errno,
            'errmsg'   => $errstr,
            '_id' => $cmd
        );

        if (!empty($data)) {
            $d = array_merge($d,$data);
        }
        
        return self::encode($d);
    }
    
    /**
     * 将发送回客户端的数据打包。
     * 
     * @param array $data_out
     * @return string
     */
    static function encode($data_out) {
        $s = Encoder::encode($data_out, Encoder::JSON);
        //$l = strlen($s);
        return $s.C::PACKAGE_EOF;
        //return pack('cNa*', false, $l, $s);
    }

    /**
     * 解析客户端传入的数据字符串。
     * 
     * @param string $data_str
     * @return array
     */
    static function decode($data_str) {
        $len = strlen($data_str);

        //$s = substr($data_str, 0, $len - 4);
        $s = $data_str;

        $d = Encoder::decode($s, Encoder::JSON);

        return $d;
    }
}
