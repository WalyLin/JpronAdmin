<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use Hyperf\Database\Model\Relations\HasMany;
use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;

/**
 * @property int $id 
 * @property string $name 姓名
 * @property int $age 年龄
 * @property int $body_status 身体状态
 * @property int $gravida 怀孕次数
 * @property string $operation 手术情况
 * @property string $food_allergy 食物过敏
 * @property string $drug_allergy 药物过敏
 * @property string $complication 并发症
 * @property string $height 身高
 * @property string $weight 体重
 * @property string $last_menstrual_time 上次月经时间
 * @property string $arrive_time 到达格鲁吉亚时间
 * @property int $bleed_amount 流血量
 * @property int $children_amount 小孩数量
 * @property int $menstrual_freq 多少天一次月经
 * @property string $tag 标签
 * @property string $tag_remark 标签备注
 * @property string $building_id 楼号 
 * @property string $room_id 房间号 
 * @property string $hep_b_date 乙肝疫苗注射日期
 * @property int $hospital_id 医院
 * @property int $doctor_id 医生
 * @property string $remark 备注
 * @property string $extra 扩展信息
 * @property int $created_by 创建者
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at  
 * @property-read null|\App\System\Model\SystemDept $hospital 
 * @property-read null|\App\System\Model\SystemUser $doctor 
 */
class JproMother extends MineModel
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_mother';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'name', 'age', 'surname', 'passport', 'hep_b', 'body_status', 'gravida', 'operation', 'food_allergy', 'drug_allergy', 'complication', 'height', 'weight', 'last_menstrual_time', 'arrive_time', 'bleed_amount', 'children_amount', 'menstrual_freq', 'tag', 'tag_remark', 'building_id', 'room_id', 'hep_b_date', 'hospital_id', 'doctor_id', 'remark', 'extra', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'age' => 'integer', 'body_status' => 'integer', 'gravida' => 'integer', 'height' => 'decimal:2', 'weight' => 'decimal:2', 'bleed_amount' => 'integer', 'children_amount' => 'integer', 'menstrual_freq' => 'integer', 'hospital_id' => 'integer', 'doctor_id' => 'integer', 'created_by' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];


    /**
     * 定义 hospital 关联
     * @return \Hyperf\Database\Model\Relations\hasOne
     */
    public function hospital(): \Hyperf\Database\Model\Relations\hasOne
    {
        return $this->hasOne(\App\System\Model\SystemDept::class, 'id', 'hospital_id');
    }

    /**
     * 定义 doctor 关联
     * @return \Hyperf\Database\Model\Relations\hasOne
     */
    public function doctor(): \Hyperf\Database\Model\Relations\hasOne
    {
        return $this->hasOne(\App\System\Model\SystemUser::class, 'id', 'doctor_id');
    }

    /**
     * 定义 checkRecord 关联
     * @return \Hyperf\Database\Model\Relations\hasMany
     */
    public function checkRecord(): HasMany
    {
        return $this->hasMany(JproCheckRecord::class, 'mother_id', 'id');
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
