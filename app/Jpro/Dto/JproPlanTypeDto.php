<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 事件类型管理Dto （导入导出）
 */
#[ExcelData]
class JproPlanTypeDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "上级分类", index: 1)]
    public string $pid;

    #[ExcelProperty(value: "类型名称", index: 2)]
    public string $name;

    #[ExcelProperty(value: "备注", index: 3)]
    public string $remark;

    #[ExcelProperty(value: "可以查看角色", index: 4)]
    public string $role;

    #[ExcelProperty(value: "状态", index: 5)]
    public string $status;

    #[ExcelProperty(value: "created_at", index: 6)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 7)]
    public string $updated_at;

    #[ExcelProperty(value: "deleted_at", index: 8)]
    public string $deleted_at;


}