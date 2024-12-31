<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use Mine\MineModel;

/**
 * @property int $id 
 * @property string $title 房间名称
 * @property int $building_id 关联所属楼栋id
 * @property int $max_num 房间最大人数
 * @property int $status 状态 1正常 2禁用
 * @property string $remark 备注
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class JproRoom extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_room';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'title', 'building_id', 'max_num', 'status', 'remark', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'building_id' => 'integer', 'max_num' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    /**
     * 定义 building 关联
     * @return \Hyperf\Database\Model\Relations\belongsTo
     */
    public function building(): \Hyperf\Database\Model\Relations\belongsTo
    {
        return $this->belongsTo(\App\Jpro\Model\JproBuilding::class, 'id', 'building_id');
    }

    public function mothers()
    {
        return $this->hasMany(JproMother::class, 'room_id', 'id');
    }
}
