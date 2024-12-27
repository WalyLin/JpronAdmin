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

use App\Jpro\Model\JproCheckRecord;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 就诊记录Mapper类
 */
class JproCheckRecordMapper extends AbstractMapper
{
    /**
     * @var JproCheckRecord
     */
    public $model;

    public function assignModel()
    {
        $this->model = JproCheckRecord::class;
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

        // 孕妈id
        if (isset($params['mother_id']) && filled($params['mother_id'])) {
            $query->where('mother_id', '=', $params['mother_id']);
        }

        // 检查详情
        if (isset($params['detail']) && filled($params['detail'])) {
            $query->where('detail', '=', $params['detail']);
        }

        // 医院
        if (isset($params['hospital_id']) && filled($params['hospital_id'])) {
            $query->where('hospital_id', '=', $params['hospital_id']);
        }

        // 医生
        if (isset($params['doctor_id']) && filled($params['doctor_id'])) {
            $query->where('doctor_id', '=', $params['doctor_id']);
        }

        // 检查时间
        if (isset($params['check_time']) && filled($params['check_time'])) {
            $query->where('check_time', '=', $params['check_time'] . ' 00:00:00');
        }
        // if (isset($params['check_time']) && filled($params['check_time']) && is_array($params['check_time']) && count($params['check_time']) == 2) {
        //     $query->whereBetween(
        //         'check_time',
        //         [$params['check_time'][0], $params['check_time'][1]]
        //     );
        // }

        // 备注
        if (isset($params['remark']) && filled($params['remark'])) {
            $query->where('remark', 'like', '%' . $params['remark'] . '%');
        }

        // 扩展信息
        if (isset($params['extra']) && filled($params['extra'])) {
            $query->where('extra', '=', $params['extra']);
        }

        // 创建者
        if (isset($params['created_by']) && filled($params['created_by'])) {
            $query->where('created_by', '=', $params['created_by']);
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

    public function handlePageItems($items)
    {
        foreach ($items as &$item) {
            $item['check_time'] = substr($item['check_time'], 0, 10);
        }
        return $items;
    }
}