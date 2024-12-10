<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 人员额外信息分类表Dto （导入导出）
 */
#[ExcelData]
class JproExtraInfoTypeDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "名称", index: 1)]
    public string $name;

    #[ExcelProperty(value: "备注", index: 2)]
    public string $remark;

    #[ExcelProperty(value: "可以查看的角色", index: 3)]
    public string $role;

    #[ExcelProperty(value: "状态 1-正常 2-禁用", index: 4)]
    public string $status;

    #[ExcelProperty(value: "created_at", index: 5)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 6)]
    public string $updated_at;

    #[ExcelProperty(value: "deleted_at", index: 7)]
    public string $deleted_at;


}