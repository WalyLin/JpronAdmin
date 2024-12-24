<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use App\System\Model\SystemDept;
use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;
use App\System\Model\SystemUser;
/**
 * @property int $id 
 * @property int $user_id 用户id
 * @property string $plan_type 事件类型
 * @property string $detail 事件详情
 * @property string $remark 备注
 * @property string $time 计划时间
 * @property string $role 可以查看的角色
 * @property int $created_by 创建者 
 * @property int $status 状态 1未开始 2执行中 3完毕 4取消
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 */
class JproPlan extends MineModel
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_plan';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'user_id', 'plan_type', 'detail', 'remark', 'time', 'role', 'status', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'user_id' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];


    public function user(){
        return $this->belongsTo(SystemUser::class,'user_id','id');
    }

    public function planType(){
        return $this->belongsTo(JproPlanType::class,'plan_type','id');
    }

    public function depts(): BelongsToMany{
        return $this->belongsToMany(SystemDept::class,'jpro_plan_dept','plan_id','dept_id');
    }
}
