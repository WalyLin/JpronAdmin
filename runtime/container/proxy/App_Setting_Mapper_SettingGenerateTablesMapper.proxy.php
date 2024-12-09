<?php

declare (strict_types=1);
/**
 * This file is part of MineAdmin.
 *
 * @link     https://www.mineadmin.com
 * @document https://doc.mineadmin.com
 * @contact  root@imoi.cn
 * @license  https://github.com/mineadmin/MineAdmin/blob/master/LICENSE
 */
namespace App\Setting\Mapper;

use App\Setting\Model\SettingGenerateTables;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\Transaction;
/**
 * 生成业务信息表查询类
 * Class SettingGenerateTablesMapper.
 */
class SettingGenerateTablesMapper extends AbstractMapper
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        if (method_exists(parent::class, '__construct')) {
            parent::__construct(...func_get_args());
        }
        $this->__handlePropertyHandler(__CLASS__);
    }
    /**
     * @var SettingGenerateTables
     */
    public $model;
    public function assignModel()
    {
        $this->model = SettingGenerateTables::class;
    }
    /**
     * 删除业务信息表和字段信息表.
     * @throws \Exception
     */
    #[Transaction]
    public function delete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['ids'], 'keys' => compact(['ids']), 'variadic' => ''], function (array $ids) use($__function__, $__method__) {
            /**
             * @var SettingGenerateTables $model
             */
            foreach ($this->model::query()->whereIn('id', $ids)->get() as $model) {
                if ($model) {
                    $model->columns()->delete();
                    $model->delete();
                }
            }
            return true;
        });
    }
    /**
     * 搜索处理器.
     */
    public function handleSearch(Builder $query, array $params) : Builder
    {
        if (isset($params['table_name']) && filled($params['table_name'])) {
            $query->where('table_name', 'like', '%' . $params['table_name'] . '%');
        }
        if (isset($params['minDate']) && filled($params['minDate']) && isset($params['maxDate']) && filled($params['maxDate'])) {
            $query->whereBetween('created_at', [$params['minDate'] . ' 00:00:00', $params['maxDate'] . ' 23:59:59']);
        }
        return $query;
    }
}