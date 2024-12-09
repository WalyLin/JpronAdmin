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
namespace App\Setting\Service;

use App\Setting\Mapper\SettingConfigGroupMapper;
use Mine\Abstracts\AbstractService;
use Mine\Annotation\Transaction;
class SettingConfigGroupService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SettingConfigGroupMapper
     */
    public $mapper;
    /**
     * SettingConfigGroupService constructor.
     */
    public function __construct(SettingConfigGroupMapper $mapper)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
    }
    /**
     * 删除配置组和其所属配置.
     */
    #[Transaction]
    public function deleteConfigGroup(mixed $id) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id'], 'keys' => compact(['id']), 'variadic' => ''], function (mixed $id) use($__function__, $__method__) {
            return $this->mapper->deleteGroupAndConfig($id);
        });
    }
}