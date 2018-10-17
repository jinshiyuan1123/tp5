<?php

/**
 * trait优先级
 *
 * 如果当前类有这个方法 ，则访问当前类
 * 如果当前类没有这个方法，则访问trait类
 * 如果trait类中没有这个方法，则访问父类同名方法
 */



trait demo1{

    public function m2(){

        return __METHOD__;

    }
}


trait demo2{

    public function m1(){

        return __METHOD__;
    }

}

class demoP{

    public function m(){

        return __METHOD__;

    }
}


class demo extends demoP{

    use demo1,demo2;

//    public function m(){
//
//        return __METHOD__;
//    }
}


$demo= new demo();

echo $demo->m();

?>