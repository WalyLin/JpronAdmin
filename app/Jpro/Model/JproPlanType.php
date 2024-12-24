<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;

/**
 * @property int $id 
 * @property int $pid 父级ID
 * @property string $name 类型名称
 * @property string $remark 备注
 * @property string $role 可以查看的角色
 * @property int $status 状态 1-正常 2-禁用
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 */
class JproPlanType extends MineModel
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_plan_type';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'pid', 'name', 'remark', 'role', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'pid' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function plans(){
        return $this->hasMany(JproPlan::class,'plan_type','id');    
    }
}
