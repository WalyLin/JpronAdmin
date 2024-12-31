<?php

declare(strict_types=1);

namespace App\Jpro\Model;

use Mine\MineModel;

/**
 * @property int $id 
 * @property string $title 楼栋名称
 * @property string $address 地址
 * @property int $room_num 房间数量
 * @property int $status 状态 1正常 2禁用
 * @property string $remark 备注
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class JproBuilding extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'jpro_building';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'title', 'address', 'room_num', 'status', 'remark', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'room_num' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function rooms()
    {
        return $this->hasMany(JproRoom::class, 'building_id', 'id');
    }
}
