<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;

/**
 * @property int $id 
 * @property int $mother_id 孕妈id
 * @property string $detail 检查详情
 * @property int $hospital_id 医院
 * @property int $doctor_id 医生
 * @property string $check_time 检查时间
 * @property string $remark 备注
 * @property string $extra 扩展信息
 * @property int $created_by 创建者
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @property-read null|\App\Jpro\Model\JproMother $mother 
 */
class JproCheckRecord extends MineModel
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_check_record';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'mother_id', 'detail', 'hospital_id', 'doctor_id', 'check_time', 'remark', 'extra', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'mother_id' => 'integer', 'hospital_id' => 'integer', 'doctor_id' => 'integer', 'created_by' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];



    /**
     * 定义 mother 关联
     * @return \Hyperf\Database\Model\Relations\belongsTo
     */
    public function mother(): \Hyperf\Database\Model\Relations\belongsTo
    {
        return $this->belongsTo(\App\Jpro\Model\JproMother::class, 'mother_id', 'id');
    }

    public function creating($event)
    {
        $this->created_by = $this->getAttribute('doctor_id') ?? 0;
    }

    public function updating($event)
    {
        $this->created_by = $this->getAttribute('doctor_id') ?? 0;
    }
}
