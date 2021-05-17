<?php
/**
 * xls
 * User: zzk
 * Date: 2021/5/14
 */
namespace zhouzeken\import\lib;
class Xls implements IImport
{
    private $config = [
        'file_path'       => '',
        'table_data'      => '',
        'table_header'    => '',
        'table_name'      => ''
    ];
    public function __construct($config=[])
    {
        $this->config = array_merge($this->config,$config);
    }

    //导入
    public function import(){
        try{
            $params = $this->config;
            if(is_file($params['file_path']) == false){
                //throw new \Exception('文件不存在');
            }

            $fp = fopen($params['file_path'],'r');
            if($fp == false){
                throw new \Exception('文件读取失败');
            }

            $list = [];
            while (($data = fgetcsv($fp)) !== false) {
                foreach ($data as $bk=>$bv){
                    $data[$bk] = Common::gbkToUtf($bv);
                }
                $list[] = $data;
            }

            fclose($fp);
            return ['list'=>[$list]];

        }catch (\Exception $e){
            return ['error'=>$e->getMessage()];
        }
    }

    //导出
    public function export(){
        $params = $this->config;
        $filename = Common::createFile('xls',$params['table_name']);
        $header = (array)$params['table_header'];
        $header = implode("\t",$header);

        $fileData = '';
        if(!empty($header)){
            $fileData .= Common::utfToGbk($header) . "\n";
        }

        $arr = (array)$params['table_data'];
        foreach ($arr as $k=>$v){
            $tmp = implode("\t",$v);
            $fileData .= Common::utfToGbk($tmp)."\n";
        }
        // 头信息设置
        header('Content-Type:application/vnd.ms-excel');
        header("Content-Disposition:attachment;filename=" . $filename);
        echo $fileData;
        exit;
    }
}