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

use App\Jpro\Model\JproMother;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 孕妈管理Mapper类
 */
class JproMotherMapper extends AbstractMapper
{
    /**
     * @var JproMother
     */
    public $model;

    public function assignModel()
    {
        $this->model = JproMother::class;
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

        // 姓
        if (isset($params['surname']) && filled($params['surname'])) {
            $query->where('surname', 'like', '%' . $params['surname'] . '%');
        }

        // 名
        if (isset($params['name']) && filled($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        // 年龄
        if (isset($params['age']) && filled($params['age']) && is_array($params['age']) && count($params['age']) == 2) {
            $query->whereBetween(
                'age',
                [$params['age'][0], $params['age'][1]]
            );
        }

        // 身体状态
        if (isset($params['body_status']) && filled($params['body_status'])) {
            $query->where('body_status', '=', $params['body_status']);
        }

        // 怀孕次数
        if (isset($params['gravida']) && filled($params['gravida']) && is_array($params['gravida']) && count($params['gravida']) == 2) {
            $query->whereBetween(
                'gravida',
                [$params['gravida'][0], $params['gravida'][1]]
            );
        }

        // 手术情况
        if (isset($params['operation']) && filled($params['operation'])) {
            $query->where('operation', 'like', '%' . $params['operation'] . '%');
        }

        // 食物过敏
        if (isset($params['food_allergy']) && filled($params['food_allergy'])) {
            $query->where('food_allergy', 'like', '%' . $params['food_allergy'] . '%');
        }

        // 药物过敏
        if (isset($params['drug_allergy']) && filled($params['drug_allergy'])) {
            $query->where('drug_allergy', 'like', '%' . $params['drug_allergy'] . '%');
        }

        // 并发症
        if (isset($params['complication']) && filled($params['complication'])) {
            $query->where('complication', 'like', '%' . $params['complication'] . '%');
        }

        // 身高
        if (isset($params['height']) && filled($params['height'])) {
            $query->where('height', '=', $params['height']);
        }

        // 体重
        if (isset($params['weight']) && filled($params['weight'])) {
            $query->where('weight', '=', $params['weight']);
        }

        // 上次月经时间
        if (isset($params['last_menstrual_time']) && filled($params['last_menstrual_time']) && is_array($params['last_menstrual_time']) && count($params['last_menstrual_time']) == 2) {
            $query->whereBetween(
                'last_menstrual_time',
                [$params['last_menstrual_time'][0], $params['last_menstrual_time'][1]]
            );
        }

        // 到达格鲁吉亚时间
        if (isset($params['arrive_time']) && filled($params['arrive_time']) && is_array($params['arrive_time']) && count($params['arrive_time']) == 2) {
            $query->whereBetween(
                'arrive_time',
                [$params['arrive_time'][0], $params['arrive_time'][1]]
            );
        }

        // 流血量
        if (isset($params['bleed_amount']) && filled($params['bleed_amount'])) {
            $query->where('bleed_amount', '=', $params['bleed_amount']);
        }

        // 小孩数量
        if (isset($params['children_amount']) && filled($params['children_amount']) && is_array($params['children_amount']) && count($params['children_amount']) == 2) {
            $query->whereBetween(
                'children_amount',
                [$params['children_amount'][0], $params['children_amount'][1]]
            );
        }

        // 多少天一次月经
        if (isset($params['menstrual_freq']) && filled($params['menstrual_freq'])) {
            $query->where('menstrual_freq', '=', $params['menstrual_freq']);
        }

        // 标签
        if (isset($params['tag']) && filled($params['tag'])) {
            $query->where('tag', '=', $params['tag']);
        }

        // 标签备注
        if (isset($params['tag_remark']) && filled($params['tag_remark'])) {
            $query->where('tag_remark', 'like', '%' . $params['tag_remark'] . '%');
        }

        // 医院
        if (isset($params['hospital_id']) && filled($params['hospital_id'])) {
            $query->where('hospital_id', '=', $params['hospital_id']);
        }

        // 医生
        if (isset($params['doctor_id']) && filled($params['doctor_id'])) {
            $query->where('doctor_id', '=', $params['doctor_id']);
        }

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

        $records = container()->get(JproCheckRecordMapper::class)->getModel()
            ->select(['id', 'mother_id', 'hospital_id', 'doctor_id', 'check_time', 'remark', 'created_by'])
            ->whereIn('mother_id', array_column($items, 'id'))
            ->orderByDesc('check_time')
            // ->groupBy('mother_id')
            ->get()->toArray();
        $records = array_column($records, null, 'mother_id');

        foreach ($items as &$item) {
            if (isset($records[$item['id']])) {
                $records[$item['id']]['check_time'] = substr($records[$item['id']]['check_time'], 0, 10);
                $item['last_check_record'] = $records[$item['id']];
            } else {
                $item['last_check_record'] = null;
            }

        }
        return $items;
    }
}