<?php
namespace app\admin\controller;

use \think\Controller;
use \think\Db;
class Data extends Controller{

    /*
     * Db类操作单条记录
     */
    public function find(){

        /*
         * where条件查询
        $find=Db::table('acm_userdb')
            ->field(['id'=>'编号','userName'=>'登录名称','realName'=>'真实姓名'])
            ->where('id',1)
            ->find();
        */

        /*
         * 主键查询
         * */
        $find=Db::table('acm_userdb')
            ->field(['id'=>'编号','userName'=>'登录名称','realName'=>'真实姓名'])
            ->find(1);


        dump($find);

    }

    /*
     * 多条查询
     */
    public function select(){

        $select=Db::table('acm_userdb')
            ->field(['id'=>'编号','userName'=>'登录名称','realName'=>'真实姓名'])
            ->where(
                [
                    ['id','<',38],
                ]
            )->select();


        dump($select);
    }

    public function create(){

        $data=[
            'userName'=>'金毛狮王',
            'realName'=>'谢逊',
            'passwd'=>1234565,
            'phone'=>17092559941
        ];

       // $insertId=Db::table('acm_userdb')->insert($data);
        //返回新增主键
        $insertId=Db::table('acm_userdb')->insertGetId($data);

        dump($insertId);
    }

    public function createAll(){
        $data = [
            [
                'userName' => '金毛狮王1',
                'realName' => '谢逊',
                'passwd' => 1234565,
                'phone' => 17092559941
            ],
            [
                'userName' => '金毛狮王2',
                'realName' => '谢逊',
                'passwd' => 1234565,
                'phone' => 17092559941
            ],
            [
                'userName' => '金毛狮王3',
                'realName' => '谢逊',
                'passwd' => 1234565,
                'phone' => 17092559941
            ]
        ];

        $insertId=Db::table('acm_userdb')->insertAll($data);//int(3)

        dump($insertId);
    }

    public function update(){

        //$id=Db::table('acm_userdb')->where('id',37)->update(['realName'=>'Lee']);
        $id=Db::table('acm_userdb')->update(['realName'=>'Lee','id'=>117]);
        return $id;
    }


    public function delete(){

        $id=Db::table('acm_userdb')->where('id',117)->delete();

        return $id;

    }

    /*
     * 原生查询
     */

    public function query(){

        $sql="SELECT * FROM acm_userdb WHERE id IN (1,37,38,39)";

        $result=Db::query($sql);

        dump($result);
    }
}
?>
