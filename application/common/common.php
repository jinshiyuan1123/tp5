<?php


namespace app\common;


class common
{

    private $name;

    public function __construct($name)
    {
        $this->name=$name;
    }

    public function setName($name)
    {
        $this->name=$name;
    }

    public function getName(){

        return "方法名是".__METHOD__."属性是".$this->name;

    }
}