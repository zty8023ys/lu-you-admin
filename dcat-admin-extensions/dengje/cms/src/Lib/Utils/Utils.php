<?php
namespace Dengje\Cms\Lib\Utils;


class Utils{
    /**
     * 时间日期格式化为多少天前
     * @param sting|intval $date_time
     * @param intval $type 1、'Y-m-d H:i:s' 2、时间戳
     * @return string
     */
    public static function format_datetime($date_time,$type=1,$format=''){
        if($type == 1){
            $timestamp = strtotime($date_time);
        }elseif($type == 2){
            $timestamp = $date_time;
            $date_time = date('Y-m-d H:i:s',$date_time);
        }
        if(!empty($format)){
            return date($format,$timestamp);
        }
        $difference = time()-$timestamp;
        if($difference <= 180){
            return '刚刚';
        }elseif($difference <= 3600){
            return ceil($difference/60).'分钟前';
        }elseif($difference <= 86400){
            return ceil($difference/3600).'小时前';
        }elseif($difference <= 2592000){
            return ceil($difference/86400).'天前';
        }elseif($difference <= 31536000){
            return ceil($difference/2592000).'个月前';
        }else{
            return ceil($difference/31536000).'年前';
            //return $date_time;
        }
    }


}
