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

use App\Jpro\Model\JproPlan;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\Transaction;
use Mine\MineModel;

/**
 * 事件管理Mapper类
 */
class JproPlanMapper extends AbstractMapper
{
    /**
     * @var JproPlan
     */
    public $model;

    public function assignModel()
    {
        $this->model = JproPlan::class;
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

        // 用户id
        if (isset($params['user_id']) && filled($params['user_id'])) {
            $query->where('user_id', '=', $params['user_id']);
        }

        // 事件类型
        if (isset($params['plan_type']) && filled($params['plan_type'])) {
            $query->where('plan_type', 'like', '%' . $params['plan_type'] . '%');
        }

        // 事件详情
        if (isset($params['detail']) && filled($params['detail'])) {
            $query->where('detail', '=', $params['detail']);
        }

        // 备注
        if (isset($params['remark']) && filled($params['remark'])) {
            $query->where('remark', 'like', '%' . $params['remark'] . '%');
        }

        // 计划时间
        if (isset($params['time']) && filled($params['time']) && is_array($params['time']) && count($params['time']) == 2) {
            $query->whereBetween(
                'time',
                [$params['time'][0], $params['time'][1]]
            );
        }

        // 允许查看角色
        if (isset($params['role']) && filled($params['role'])) {
            $query->where('role', 'like', '%' . $params['role'] . '%');
        }

        // 状态
        if (!empty($params['status']) && filled($params['status'])) {
            $query->where('status', '=', $params['status']);
        }

        // 
        if (isset($params['created_at']) && filled($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween(
                'created_at',
                [$params['created_at'][0], $params['created_at'][1]]
            );
        }

        // 
        if (isset($params['updated_at']) && filled($params['updated_at']) && is_array($params['updated_at']) && count($params['updated_at']) == 2) {
            $query->whereBetween(
                'updated_at',
                [$params['updated_at'][0], $params['updated_at'][1]]
            );
        }

        // 
        if (isset($params['deleted_at']) && filled($params['deleted_at']) && is_array($params['deleted_at']) && count($params['deleted_at']) == 2) {
            $query->whereBetween(
                'deleted_at',
                [$params['deleted_at'][0], $params['deleted_at'][1]]
            );
        }

        return $query;
    }

    public function handlePageItems(array $items): array
    {
        foreach ($items as &$item) {
            $item['username_and_nickname'] = $item->user->username . "(" . $item->user->nickname . ")";
            $item['plan_type_name'] = $item->planType->name ?? '';
            unset($item->user, $item->planType);
        }
        return $items;
    }


    #[Transaction]
    public function save(array $data): mixed
    {
        $data['created_by'] = $data['user_id'] ?? 0;
        return parent::save($data);
    }

    /**
     * 更新.
     */
    #[Transaction]
    public function update(mixed $id, array $data): bool
    {
        $data['created_by'] = $data['user_id'] ?? 0;
        return parent::update($id, $data);
    }

}