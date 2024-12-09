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

use App\Setting\Mapper\SettingCrontabMapper;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Mine\Abstracts\AbstractService;
use Mine\Annotation\DeleteCache;
use Mine\Crontab\MineCrontab;
use Mine\Crontab\MineExecutor;
use Mine\MineModel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
class SettingCrontabService extends AbstractService
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SettingCrontabMapper
     */
    public $mapper;
    private MineExecutor $mineExecutor;
    public function __construct(SettingCrontabMapper $mapper, MineExecutor $mineExecutor)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
        $this->mineExecutor = $mineExecutor;
    }
    /**
     * 保存.
     */
    public function save(array $data) : mixed
    {
        return parent::save($data);
    }
    /**
     * 更新.
     */
    #[CacheEvict(prefix: 'setting:crontab:read', value: '_#{id}')]
    public function update(mixed $id, array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id', 'data'], 'keys' => compact(['id', 'data']), 'variadic' => ''], function (mixed $id, array $data) use($__function__, $__method__) {
            return parent::update($id, $data);
        });
    }
    #[CacheEvict(prefix: 'setting:crontab:read', all: true)]
    public function delete(array $ids) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['ids'], 'keys' => compact(['ids']), 'variadic' => ''], function (array $ids) use($__function__, $__method__) {
            return parent::delete($ids);
        });
    }
    #[Cacheable(prefix: 'setting:crontab:read', value: '_#{id}', ttl: 600)]
    public function read(mixed $id, array $column = ['*']) : ?MineModel
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id', 'column'], 'keys' => compact(['id', 'column']), 'variadic' => ''], function (mixed $id, array $column = ['*']) use($__function__, $__method__) {
            return parent::read($id, $column);
        });
    }
    /**
     * 立即执行一次定时任务
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function run(mixed $id) : ?bool
    {
        $crontab = new MineCrontab();
        $model = $this->read($id);
        $crontab->setCallback($model->target);
        $crontab->setType((string) $model->type);
        $crontab->setEnable(true);
        $crontab->setCrontabId($model->id);
        $crontab->setName($model->name);
        $crontab->setParameter($model->parameter ?: '');
        $crontab->setRule($model->rule);
        return $this->mineExecutor->execute($crontab, true);
    }
    #[DeleteCache('crontab')]
    public function changeStatus(mixed $id, string $value, string $filed = 'status') : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id', 'value', 'filed'], 'keys' => compact(['id', 'value', 'filed']), 'variadic' => ''], function (mixed $id, string $value, string $filed = 'status') use($__function__, $__method__) {
            return parent::changeStatus($id, $value, $filed);
        });
    }
}