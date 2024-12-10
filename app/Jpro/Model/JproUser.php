<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;

/**
 * @property int $id 
 * @property string $nickname 昵称
 * @property int $sex 性别 1男 2女 3未知
 * @property int $age 年龄
 * @property int $status 状态 1正常 2禁用
 * @property string $remark 备注
 * @property int $created_by 创建者
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 */
class JproUser extends MineModel
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_user';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'nickname', 'sex', 'age', 'status', 'remark', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'sex' => 'integer', 'age' => 'integer', 'status' => 'integer', 'created_by' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
