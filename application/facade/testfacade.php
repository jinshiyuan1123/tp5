<?php
/*********************************************************************\
 *  Copyright (c) 1998-2013, TH. All Rights Reserved.
 *  Author :guomin
 *  FName  :testfacade.php
 *  Time   :2018/4/14  14:24
 *  Remark :
 * \*********************************************************************/


namespace app\facade;

use think\Facade;

class testfacade extends Facade

{
    protected static function getFacadeClass()
    {
        //使用动态绑定时，下面这句代码可以不写
     //   return 'app\common\testfacade';

    }
}