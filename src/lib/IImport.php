<?php
namespace zhouzeken\import\lib;
interface IImport
{
    //导入
    public function import();

    //导出
    public function export();
}