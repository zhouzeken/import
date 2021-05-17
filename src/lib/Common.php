<?php
namespace zhouzeken\import\lib;
class Common
{

    /**
     * 字符转换（utf-8 => GBK）
     */
    public static function utfToGbk($data){
        return iconv('utf-8', 'GBK', $data);
    }

    /**
     * 字符转换（GBK => utf-8）
     */
    public static function gbkToUtf($data){
        return iconv('GBK', 'utf-8', $data);
    }

    /**
     * 生成文件名
     */
    public static function createFile($suffix,$file=false){
        if(empty($file)){
            $file = date('YmdHis',time()).rand(10000,99999).'.'.$suffix;
        }else{
            $file = $file.'.'.$suffix;
        }
        $file = self::utfToGbk($file);
        return $file;
    }
}