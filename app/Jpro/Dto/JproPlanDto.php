<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 事件管理Dto （导入导出）
 */
#[ExcelData]
class JproPlanDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "用户id", index: 1)]
    public string $user_id;

    #[ExcelProperty(value: "事件类型", index: 2)]
    public string $plan_type;

    #[ExcelProperty(value: "事件详情", index: 3)]
    public string $detail;

    #[ExcelProperty(value: "备注", index: 4)]
    public string $remark;

    #[ExcelProperty(value: "计划时间", index: 5)]
    public string $time;

    #[ExcelProperty(value: "允许查看角色", index: 6)]
    public string $role;

    #[ExcelProperty(value: "状态", index: 7)]
    public string $status;

    #[ExcelProperty(value: "created_at", index: 8)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 9)]
    public string $updated_at;

    #[ExcelProperty(value: "deleted_at", index: 10)]
    public string $deleted_at;


}