<?php
/**
 * 只针对一条数据进行处理
 *
 * @package multarray
 * @author tim <tim@tim-PC>
 * @version 0.1
 * @copyright (C) 2018 tim <tim@tim-PC>
 * @license MIT
 */

namespace MultArray;

class RowArray{
    private $data=[];
    private $is_mult = false;
    public function __construct($data){

        $this->data = $data;
        $this->is_mult = $this->isMultArray($data);
    }
    public function getKvArray(){
        $render = $this->data;
        if($this->is_mult){
            $render = $this->muilarray_to_kv($this->data);
        }
        return $render;
    }
    public function getMultArray(){
        $render = $this->data;
        if(!$this->is_mult){
            $render = $this->kv_to_muilarray($this->data);
        }
        return $render;

    }

    public function isMultArray(&$data){
        $render = false;
        if(is_array($data)){
            foreach($data as &$row){
                if(is_array($row)){
                    $render = true;
                    break;
                }
            }
        }
        return $render;
    }
    private function muilarray_to_kv($data){
        $render = [];
        $this->_object_to_kv($data, $render);
        return $render;
    }
    private function _object_to_kv($data, &$rs, $header=''){

        foreach((array)$data as $k =>$v){
            if($header){
                $h=$header.'['.$k.']';
            }else{
                $h = $k;
            }
            if(!is_object($v)&& !is_array($v)){
                $rs[$h] = $v;
                continue;
            }
            $this->_object_to_kv($v, $rs, $h);
        }
    }
    private function kv_to_muilarray($data){
        $render = [];
        foreach($data as $k=>$v){
            preg_match('/^([^\[]+)(.+)?$/', $k, $match);
            $count = count($match);
            if($count==3){
                list(,$base, $sub) = $match;
            }elseif($count==2){
                $sub = null;
                list(,$base) = $match;
            }else{
                continue;
            }
            if($sub){
                preg_match_all('/\[([^\]]+)\]/i',$sub, $_m);
                $c = count($_m);
                if($c==2){
                    if(!isset($render[$base])){
                        $render[$base] = [];
                    }
                    $this->_sub_array($_m[1], $v, $render[$base]);
                    continue;
                }
            }

            $render[$base] = $v;
        }
        return $render;
    }
    public function _sub_array($sub, $v, &$base){
        $render = $base;
        $tmp = &$render;
        foreach($sub as $k){

            if(!isset($tmp[$k])){
                $tmp[$k]=null;
            }
            $tmp = &$tmp[$k];
        }
        $tmp = $v;
        $base = $render;
    }
}
