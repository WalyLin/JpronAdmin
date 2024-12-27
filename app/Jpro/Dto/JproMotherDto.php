<?php
namespace App\Jpro\Dto;

use Mine\Interfaces\MineModelExcel;
use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;

/**
 * 孕妈管理Dto （导入导出）
 */
#[ExcelData]
class JproMotherDto implements MineModelExcel
{
    #[ExcelProperty(value: "id", index: 0)]
    public string $id;

    #[ExcelProperty(value: "姓名", index: 1)]
    public string $name;

    #[ExcelProperty(value: "年龄", index: 2)]
    public string $age;

    #[ExcelProperty(value: "身体状态", index: 3)]
    public string $body_status;

    #[ExcelProperty(value: "怀孕次数", index: 4)]
    public string $gravida;

    #[ExcelProperty(value: "手术情况", index: 5)]
    public string $operation;

    #[ExcelProperty(value: "食物过敏", index: 6)]
    public string $food_allergy;

    #[ExcelProperty(value: "药物过敏", index: 7)]
    public string $drug_allergy;

    #[ExcelProperty(value: "并发症", index: 8)]
    public string $complication;

    #[ExcelProperty(value: "身高", index: 9)]
    public string $height;

    #[ExcelProperty(value: "体重", index: 10)]
    public string $weight;

    #[ExcelProperty(value: "上次月经时间", index: 11)]
    public string $last_menstrual_time;

    #[ExcelProperty(value: "到达格鲁吉亚时间", index: 12)]
    public string $arrive_time;

    #[ExcelProperty(value: "流血量", index: 13)]
    public string $bleed_amount;

    #[ExcelProperty(value: "小孩数量", index: 14)]
    public string $children_amount;

    #[ExcelProperty(value: "多少天一次月经", index: 15)]
    public string $menstrual_freq;

    #[ExcelProperty(value: "标签", index: 16)]
    public string $tag;

    #[ExcelProperty(value: "标签备注", index: 17)]
    public string $tag_remark;

    #[ExcelProperty(value: "医院", index: 18)]
    public string $hospital_id;

    #[ExcelProperty(value: "医生", index: 19)]
    public string $doctor_id;

    #[ExcelProperty(value: "备注", index: 20)]
    public string $remark;

    #[ExcelProperty(value: "扩展信息", index: 21)]
    public string $extra;

    #[ExcelProperty(value: "创建者", index: 22)]
    public string $created_by;

    #[ExcelProperty(value: "created_at", index: 23)]
    public string $created_at;

    #[ExcelProperty(value: "updated_at", index: 24)]
    public string $updated_at;

    #[ExcelProperty(value: "deleted_at", index: 25)]
    public string $deleted_at;


}