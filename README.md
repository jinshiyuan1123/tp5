ThinkPHP 5.1
获取配置
获取全部配置 $config=Config::get();
获取app下的配置项 $conapp=Config::get('app');
获取一级配置项 $configfirst=Config::pull('log');
获取二级配置项 $configsecond=Config::get('app.app_debug');
app默认，可以不写 $configsecond=Config::get('app_dubug');
判断是否有这个配置项 $confighas=Config::has('defalut_lang');
查询database下的配置内容 $configdata=Config::pull('database');
动态改变配置项 Config::set('app_debug',false);
也可以使用助手函数config来动态设置和获取配置项
设置 config('app_debug',false);
获取 config('app_debug');
php经典三大模式
单例模式 namespace singleTon { class single { public $siteName; private static $instance;

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
工厂模式 namespace Factory {

      use singleTon\single;
      class Factory
      {
          public static function create($siteName)
          {
              return single::singleTon($siteName);
          }
      }
  }
对象注册树 namespace RegisterTree {

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

对象访问 namespace run {

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
trait类
利用trait类实现php多继承，提高了代码的复用性 trait类 demo1

namespace demo1{
    trait demo1{
        public function m1(){
            return __METHOD__;
        }
    }
}
trait类 demo2

namespace demo2{
    trait demo2{
        public function m2(){
            return __METHOD__;
        }
    }
}
利用trait类实现多继承

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
打印结果

demo\demo::dm1
demo1\demo1::m1
demo2\demo2::m2
trait类访问优先级
如果当前类有这个方法，则访问当前类；

如果当前类没有这个方法，则访问trait类；

如果trait类没有这个方法，则访问父类同名方法

trait demo1{ public function m2(){ return METHOD; } } trait demo2{ public function m1(){ return METHOD; }

} class demoP{ public function m(){ return METHOD;

 }
} class demo extends demoP{} $demo= new demo(); echo $demo->m();

输出结果

demoP::m
依赖注入
任何URL的访问，最终都是定位到控制器，由控制器中的某个具体方法执行
一个控制器对应着一个类，如果这些控制器需要统一管理，怎么办？
使用容器进行管理，还可以将类的实例进行管理，传递给类方法，自动触发依赖注入
依赖注入： 将对象类型的数据，以参数的形式传递给方法的参数列表
URL访问 以get形式将数据传递给控制器指定方法中
依赖注入

public function getMethod(\app\common\common $common)
{

    $common->setName('guomin');

    return $common->getName();

}
app\common\common类

namespace app\common;
class common
{

    private $name;
    public function setName($name)
    {
        $this->name=$name;
    }

    public function getName(){

        return "方法名是".__METHOD__."属性是".$this->name;

    }
}
绑定类和闭包到容器中

use think\Container;
先use think\Container这个类

public function bindClass(){


        Container::set('common','\app\common\common');

        $common=Container::get('common',['name'=>'leee']);

        return $common->getName();
    }
绑定一个闭包到容器中

public function bindClosure(){

    Container::set('demo',function($demo){
        return $demo;
    });

    return Container::get('demo',['demo'=>'demo的值在这里显示']);
}
Facade静态代理
创建一个类app\common\testfacade.php namespace app\common;

 	class testfacade{
 	    public function index($name='think PHP'){
 	        return $name;
 	    }
 	}
新建文件夹facade,在此文件夹下创建testfacade.php namespace app\facade; use think\Facade; class testfacade extends Facade

 {
     protected static function getFacadeClass()
     {
         //使用动态绑定时，下面这句代码可以不写
      //   return 'app\common\testfacade';
 
     }
 }
使用静态代理

 use app\common\testfacade;
 use think\facade; 
 public function facade(){
     //常规调用方法
    // $testfacade=new testfacade();

     //return $testfacade->index();

     //静态代理调用方法

   // return \app\facade\testfacade::index('guomin');

     //使用动态绑定的方法绑定到facade

     Facade::bind('app\facade\testfacade','app\common\testfacade');

     return \app\facade\testfacade::index('aaa');
 		
  }
