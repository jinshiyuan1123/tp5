<?php
namespace app\validate;
use think\Validate;
class User extends Validate{

    protected $rule=[
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
}