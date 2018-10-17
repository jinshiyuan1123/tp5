<?php
/**
 * 利用trait实现php多继承
 * 提高了代码的复用性
 *
 */
namespace demo1{

    trait demo1{

        public function m1(){

            return __METHOD__;
        }

    }

}

namespace demo2{

    trait demo2{

        public function m2(){

            return __METHOD__;
        }

    }

}

namespace demo{

    use demo1\demo1;
    use demo2\demo2;

    class demo{
        use demo1,demo2;
        public function dm1(){

            return __METHOD__;

        }

        public function dm2(){

            return $this->m1();

        }

        public function dm3(){

            return $this->m2();
        }
    }

    $demo=new demo();

    echo $demo->dm1();

    echo '<br/>';

    echo $demo->dm2();

    echo '<br/>';

    echo $demo->dm3();
}

