<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 就诊记录Dto （导入导出）
 */
#[ExcelData]
class JproCheckRecordDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "孕妈id", index: 1)]
    public string $mother_id;

    #[ExcelProperty(value: "检查详情", index: 2)]
    public string $detail;

    #[ExcelProperty(value: "医院", index: 3)]
    public string $hospital_id;

    #[ExcelProperty(value: "医生", index: 4)]
    public string $doctor_id;

    #[ExcelProperty(value: "检查时间", index: 5)]
    public string $check_time;

    #[ExcelProperty(value: "备注", index: 6)]
    public string $remark;

    #[ExcelProperty(value: "扩展信息", index: 7)]
    public string $extra;

    #[ExcelProperty(value: "创建者", index: 8)]
    public string $created_by;

    #[ExcelProperty(value: "created_at", index: 9)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 10)]
    public string $updated_at;

    #[ExcelProperty(value: "deleted_at", index: 11)]
    public string $deleted_at;


}