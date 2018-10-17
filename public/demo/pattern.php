<?php
/*********************************************************************\
 *  Copyright (c) 1998-2013, TH. All Rights Reserved.
 *  Author :guomin
 *  FName  :pattern.php
 *  Time   :2018/4/14  10:01
 *  Remark :php三大经典设计模式
 * \*********************************************************************/

namespace singleTon {
    /**
     * Class single 单例模式
     * @package singleTon
     */
    class single
    {
        public $siteName;
        private static $instance;

        private function __construct($siteName)
        {
            $this->siteName = $siteName;
        }

        private function __clone()
        {
            trigger_error('Clone is not allowed', E_USER_ERROR);
        }

        static public function singleTon($siteName = '百度')
        {
            if (!isset(self::$instance)) {
                self::$instance = new self($siteName);
            }
            return self::$instance;
        }

    }
}


namespace Factory {

    use singleTon\single;

    //工厂模式
    class Factory
    {
        public static function create($siteName)
        {
            return single::singleTon($siteName);
        }
    }
}

namespace RegisterTree {
    //对象注册数
    /**
     * Class RegisterTree
     * @package RegisterTree
     * @method
     */
    class RegisterTree
    {
        //创建对象池
        private static $objs = [];

        //生成对象并上树
        public static function set($alis, $obj)
        {
            self::$objs[$alis] = $obj;
        }


        //从树上面取下对象
        public static function get($alas)
        {
            return self::$objs[$alas];
        }


        //销毁对象

        public static function _unset($alas)
        {
            unset(self::$objs[$alas]);
        }
    }
}

namespace run {

    use Factory\Factory;
    use RegisterTree\RegisterTree;

    $factory = Factory::create('谷歌');

    //创建对象
    RegisterTree::set('site', $factory);

    //获取对象
    $obj = RegisterTree::get('site');

    //访问对象值

    $siteName=$obj->siteName;

    var_dump($siteName);
}
