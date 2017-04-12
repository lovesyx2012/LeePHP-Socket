<?php
$g_cmd_hash = array(
    1001 => array('Auth', 'login', 1001, '登录授权',
    	array(
            'username'  => array('String', '用户名'),
            'password' => array('String', '密码')
        )),
    1003 => array('Auth', 'logout', 1003, '退出登录', array(
            'username'  => array('String', '用户名')
        )),
    9999 => array('ApiList', 'all', 9999, '接口描述信息'),
);
