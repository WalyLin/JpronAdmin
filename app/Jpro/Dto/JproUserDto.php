<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 人员管理Dto （导入导出）
 */
#[ExcelData]
class JproUserDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "昵称", index: 1)]
    public string $nickname;

    #[ExcelProperty(value: "性别", index: 2)]
    public string $sex;

    #[ExcelProperty(value: "年龄", index: 3)]
    public string $age;

    #[ExcelProperty(value: "状态 1正常 2禁用", index: 4)]
    public string $status;

    #[ExcelProperty(value: "备注", index: 5)]
    public string $remark;

    #[ExcelProperty(value: "创建者", index: 6)]
    public string $created_by;

    #[ExcelProperty(value: "created_at", index: 7)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 8)]
    public string $updated_at;

    #[ExcelProperty(value: "deleted_at", index: 9)]
    public string $deleted_at;


}