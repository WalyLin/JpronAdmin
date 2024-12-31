<?php
declare(strict_types=1);
/**
 * MineAdmin is committed to providing solutions for quickly building web applications
 * Please view the LICENSE file that was distributed with this source code,
 * For the full copyright and license information.
 * Thank you very much for using MineAdmin.
 *
 * @Author X.Mo<root@imoi.cn>
 * @Link   https://gitee.com/xmo/MineAdmin
 */

namespace App\Jpro\Mapper;

use App\Jpro\Model\JproBuilding;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 楼栋管理Mapper类
 */
class JproBuildingMapper extends AbstractMapper
{
    /**
     * @var JproBuilding
     */
    public $model;

    public function assignModel()
    {
        $this->model = JproBuilding::class;
    }

    /**
     * 搜索处理器
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    public function handleSearch(Builder $query, array $params): Builder
    {
        
        // 
        if (isset($params['id']) && filled($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        // 楼栋名称
        if (isset($params['title']) && filled($params['title'])) {
            $query->where('title', 'like', '%'.$params['title'].'%');
        }

        // 地址
        if (isset($params['address']) && filled($params['address'])) {
            $query->where('address', 'like', '%'.$params['address'].'%');
        }

        // 房间数量
        if (isset($params['room_num']) && filled($params['room_num'])) {
            $query->where('room_num', '=', $params['room_num']);
        }

        // 状态
        if (isset($params['status']) && filled($params['status'])) {
            $query->where('status', '=', $params['status']);
        }

        // 备注
        if (isset($params['remark']) && filled($params['remark'])) {
            $query->where('remark', 'like', '%'.$params['remark'].'%');
        }

        // 
        if (isset($params['created_at']) && filled($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween(
                'created_at',
                [ $params['created_at'][0], $params['created_at'][1] ]
            );
        }

        // 
        if (isset($params['updated_at']) && filled($params['updated_at']) && is_array($params['updated_at']) && count($params['updated_at']) == 2) {
            $query->whereBetween(
                'updated_at',
                [ $params['updated_at'][0], $params['updated_at'][1] ]
            );
        }

        return $query;
    }

    public function handlePageItems(array $items): array
    {
        foreach ($items as &$item) {
            $item['room_count'] = $item->rooms->count();
        }
        return $items;
    }
}