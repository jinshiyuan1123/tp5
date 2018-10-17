<?php
namespace app\admin\controller;
use think\Controller;
use app\validate\User as Users;
use app\facade\User;
use think\Facade\Validate;
class Validatedata extends Controller{

    public function index(){

        $data=[
            'name'=>'guomin',
            'email'=>'424242qq.com',
            'password'=>'222222',
            'mobile'=>17092559941
        ];

        $validate=new Users();
        if(!$validate->check($data)){
            return $validate->getError();
        }else{
            return '通过';
        }


        /*
        //静态代理
       if(!User::check($data)) {
           return User::getError();
       }else{
           return '通过';
       }
       */
        /**
         * 一、验证器总结
         * 1.验证器是一个自定义的类，必须继承于框架的验证类think\Validate类
         * 2.验证器类可以创建在application目录下的任何一个可以访问的目录下面
         * 3.这个访问指的是控制器的访问，不是外url的访问，只需要指定正确的命名空间
         * 4.验证器其实就是完成框架think\Validate类中属性protected $rule[]初始化
         * 5.控制器中可以使用check()完成验证
         * 6.还可以创建一个自定义的静态代理，来统一验证方法的调用方式
         * 二、独立验证
         * 1.使用的是验证类think\Validate中的rule方法
         * 2.rule方法实际上就是完成当前类的属性protected $rule初始化
         */
    }

    public function validates(){
        //验证数据
        $data=[
            'name'=>'guomin',
            'email'=>'424242qq.com',
            'password'=>'222222',
            'mobile'=>17092559941
        ];


        //验证规则
        $validate='app\validate\User';
        $res=$this->validate($data,$validate);
        if(true!==$res){
            return $res;
        }else{

            return '通过';

        }
    }


    public function validateByRule(){

        $rule=[
            'name'=>[
                'require',
                'min'=>5,
                'max'=>10
            ],
            'email'=>[
                'require',
                'email'=>'email'
            ],
            'password'=>[
                'require',
                'min'=>5,
                'max'=>10,
                'alphaNum'
            ],
            'mobile'=>[
                'require',
                'mobile'=>'mobile'
            ]
        ];
        $data=[
            'name'=>'guomin',
            'email'=>'424242qq.com',
            'password'=>'222222',
            'mobile'=>17092559941
        ];
        Validate::rule($rule);
        if(!Validate::check($data)){

           return Validate::getError();
        }else{

            return '验证通过';
        }

    }
}