<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 房间管理Dto （导入导出）
 */
#[ExcelData]
class JproRoomDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "房间名称", index: 1)]
    public string $title;

    #[ExcelProperty(value: "所属楼栋", index: 2)]
    public string $building_id;

    #[ExcelProperty(value: "可容纳人数", index: 3)]
    public string $max_num;

    #[ExcelProperty(value: "备注", index: 4)]
    public string $remark;

    #[ExcelProperty(value: "created_at", index: 5)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 6)]
    public string $updated_at;


}