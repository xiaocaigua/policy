<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2019-02-20
 * Time: 11:31
 *
 */

namespace EasySwoole\Policy;


class Policy
{
    protected $root;

    function __construct()
    {
        /*
         * *表示通配,根节点
        */
        $this->root = new PolicyNode("*");
    }

    /*
     *
     */
    public function addPath(string $path,string $allow = PolicyNode::EFFECT_ALLOW)
    {
        $list = explode('/',trim($path,'/'));
        $temp = $this->root;
        foreach ($list as $path){
            $temp = $temp->addChild($path);
        }
        $temp->setAllow($allow);
    }

    public function check(string $path)
    {
        $node = $this->root->search($path);
        if($node){
            return $node->isAllow();
        }else{
            return PolicyNode::EFFECT_UNKNOWN;
        }
    }

    public function toArray()
    {
        return $this->root->toArray();
    }
}

