<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 楼栋管理Dto （导入导出）
 */
#[ExcelData]
class JproBuildingDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "楼栋名称", index: 1)]
    public string $title;

    #[ExcelProperty(value: "地址", index: 2)]
    public string $address;

    #[ExcelProperty(value: "房间数量", index: 3)]
    public string $room_num;

    #[ExcelProperty(value: "状态", index: 4)]
    public string $status;

    #[ExcelProperty(value: "备注", index: 5)]
    public string $remark;

    #[ExcelProperty(value: "created_at", index: 6)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 7)]
    public string $updated_at;


}