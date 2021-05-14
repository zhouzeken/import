<?php
/**
 * csv
 * User: zzk
 * Date: 2021/5/14
 */
namespace zhouzeken\import\lib;
class Csv implements IImport
{
    private $config = [];
    public function __construct($config=[])
    {
        $this->config = array_merge($this->config,$config);
    }

    //导入
    public function import(){

    }

    //导出
    public function export(){
        echo '12321';
    }
}