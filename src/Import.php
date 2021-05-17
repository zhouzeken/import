<?php
/**
 * 导入导出统一出口类
 * User: zzk
 * Date: 2021/5/14
 */
namespace zhouzeken\import;
class Import
{
    public static $config = [
        'type'            => 'csv',
        'file_path'       => '',
        'table_data'      => '',
        'table_header'    => '',
        'table_name'      => ''
    ];

    public static $instance = null;

    public function __construct($config=[])
    {
        self::$config = array_merge(self::$config,$config);
    }

    public static function getInstance(){
        if(!is_null(self::$instance)){
            return self::$instance;
        }

        if(empty(self::$config['file_path'])){
            $type = self::$config['type'];
        }else{
            $type = substr(strrchr(self::$config['file_path'], '.'), 1);
        }
        switch ($type){
            case 'csv':
                self::$instance = new \zhouzeken\import\lib\Csv(self::$config);
                break;
            case 'xls':
                self::$instance = new \zhouzeken\import\lib\Xls(self::$config);
                break;
            case 'xlsx':
                self::$instance = new \zhouzeken\import\lib\Xlsx(self::$config);
                break;
            case 'doc':
                self::$instance = new \zhouzeken\import\lib\Doc(self::$config);
                break;
            case 'docx':
                self::$instance = new \zhouzeken\import\lib\Docx(self::$config);
                break;
            default:
                self::$instance = new \zhouzeken\import\lib\Csv(self::$config);
                break;
        }
        return self::$instance;
    }

    //导入
    public function import(){
        $obj = self::getInstance();
        $res = $obj->import();
        return $res;
    }

    //导出
    public function export(){
        $obj = self::getInstance();
        $obj->export();
    }
}