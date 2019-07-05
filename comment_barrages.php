<?php
/**
 * Created by PhpStorm.
 * User: wwj
 * Date: 2019/7/5
 * Time: 23:21
 */
$barrages=
    array(
        array(
            'info'   => '第一条弹幕',
            'href'   => 'http://www.yaseng.org',

        ),
        array(
            'info'   => '第二条弹幕',
//            'img'    => 'static/img/yaseng.png',
            'href'   => 'http://www.yaseng.org',
            'color'  =>  '#ff6600'

        ),
        array(
            'info'   => '第三条弹幕',
//            'img'    => 'static/img/mj.gif',
            'href'   => 'http://www.yaseng.org',
            'bottom' => 70 ,

        ),
        array(
            'info'   => '第四条弹幕',
            'href'   => 'http://www.yaseng.org',
            'close'  =>false,

        ),

    );


echo   json_encode($barrages);