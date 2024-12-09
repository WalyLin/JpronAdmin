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
namespace App\System\Mapper;

use App\System\Model\SystemDictData;
use App\System\Model\SystemDictType;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;
use Mine\Annotation\Transaction;
/**
 * Class SystemUserMapper.
 */
class SystemDictTypeMapper extends AbstractMapper
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
     * @var SystemDictType
     */
    public $model;
    public function assignModel()
    {
        $this->model = SystemDictType::class;
    }
    #[Transaction]
    public function update(mixed $id, array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id', 'data'], 'keys' => compact(['id', 'data']), 'variadic' => ''], function (mixed $id, array $data) use($__function__, $__method__) {
            parent::update($id, $data);
            SystemDictData::where('type_id', $id)->update(['code' => $data['code']]) > 0;
            return true;
        });
    }
    #[Transaction]
    public function realDelete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['ids'], 'keys' => compact(['ids']), 'variadic' => ''], function (array $ids) use($__function__, $__method__) {
            foreach ($ids as $id) {
                $model = $this->model::withTrashed()->find($id);
                if ($model) {
                    $model->dictData()->forceDelete();
                    $model->forceDelete();
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
        if (isset($params['code']) && filled($params['code'])) {
            $query->where('code', 'like', '%' . $params['code'] . '%');
        }
        if (isset($params['name']) && filled($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }
        if (isset($params['status']) && filled($params['status'])) {
            $query->where('status', $params['status']);
        }
        return $query;
    }
}