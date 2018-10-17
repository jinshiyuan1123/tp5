<?php

/**
 * trait类中方法同名问题
 *
 * 如果多个trait类中的方法重名 怎么解决
 */



trait demo1{

    public function m(){

        return __METHOD__;

    }
}


trait demo2{

    public function m(){

        return __METHOD__;
    }

}


class demo{

    use demo1,demo2{

        demo1::m insteadof demo2;

        demo2::m as demo2m;

    }

    public function md(){

        return __METHOD__;

    }

    public function test1(){

        return $this->m();

    }

    public function test2(){

        return $this->demo2m();

    }

}


$demo= new demo();

echo $demo->m();

echo "<hr/>";

echo $demo->test1();

echo "<hr/>";

echo $demo->demo2m();

?>