<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Acm_userdb;
class Display extends Controller{


    public function show(){

        $contents='欢迎学习thinkphp 5框架';

        return $this->display($contents);
        //等价于
        //return $this->view->dispaly();
        //或者使用静态代理方法
        //return View::display($contents);
    }



    public function assignData(){

       // $this->view->assign('name','guomin');

      //  $this->view->assign('age','18');


        //或者使用批量赋值

        $this->view->assign(
            [
                'name'=>'guomin',
                'age'=>18
            ]
        );

        //输出数组
        $goods=[
            'name'=>'Mi',
            'price'=>3999,
            'size'=>5.5
        ];
        $this->view->assign('goods',$goods);


        //输出对象

        $obj=new \stdClass();
        $obj->product='computer';
        $obj->price=1599;
        $this->view->assign('obj',$obj);

        //输出常量
        define('SITE_NAME','www.baidu.com');


        //在模板中输出数据

        //模板默认目录位于当前模块的view目录
        //模板文件默认位于以当前控制器同名的文件夹下
        //模板文件名称默认与控制器方法一致

        return $this->view->fetch();
    }


    public function showData(){

        $res=Acm_userdb::paginate(5);

        $this->view->assign('res',$res);

        return $this->view->fetch();
    }

    public function layUi(){


        return $this->view->fetch();
    }

    public function extendUi(){
        return $this->view->fetch();
    }

}