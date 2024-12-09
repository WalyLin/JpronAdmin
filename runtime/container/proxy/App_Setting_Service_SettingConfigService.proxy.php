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

use App\Setting\Mapper\SettingConfigMapper;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Listener\DeleteListenerEvent;
use Hyperf\DbConnection\Annotation\Transactional;
use Mine\Abstracts\AbstractService;
use Mine\Annotation\DependProxy;
use Mine\Interfaces\ServiceInterface\ConfigServiceInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
#[DependProxy(values: [ConfigServiceInterface::class])]
class SettingConfigService extends AbstractService implements ConfigServiceInterface
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    /**
     * @var SettingConfigMapper
     */
    public $mapper;
    private EventDispatcherInterface $dispatcher;
    public function __construct(SettingConfigMapper $mapper, EventDispatcherInterface $eventDispatcher)
    {
        $this->__handlePropertyHandler(__CLASS__);
        $this->mapper = $mapper;
        $this->dispatcher = $eventDispatcher;
    }
    /**
     * 按key获取配置，并缓存.
     */
    #[Cacheable(prefix: 'system:config:value', value: '_#{key}', ttl: 600, listener: 'system-config-update')]
    public function getConfigByKey(string $key) : ?array
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['key'], 'keys' => compact(['key']), 'variadic' => ''], function (string $key) use($__function__, $__method__) {
            return $this->mapper->getConfigByKey($key);
        });
    }
    /**
     * 按组的key获取一组配置信息.
     */
    public function getConfigByGroupKey(string $groupKey) : ?array
    {
        return $this->mapper->getConfigByGroupKey($groupKey);
    }
    /**
     * 清除缓存.
     */
    #[CacheEvict(prefix: 'system:config:value', value: '_#{key}', all: true)]
    public function clearCache() : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return true;
        });
    }
    /**
     * 更新配置.
     */
    #[CacheEvict(prefix: 'system:config:value', value: '_#{key}')]
    public function updated(string $key, array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['key', 'data'], 'keys' => compact(['key', 'data']), 'variadic' => ''], function (string $key, array $data) use($__function__, $__method__) {
            return $this->mapper->updateConfig($key, $data);
        });
    }
    /**
     * 按 keys 更新配置.
     */
    #[Transactional]
    public function updatedByKeys(array $data) : bool
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['data'], 'keys' => compact(['data']), 'variadic' => ''], function (array $data) use($__function__, $__method__) {
            foreach ($data as $name => $value) {
                $this->dispatcher->dispatch(new DeleteListenerEvent('system-config-update', [(string) $name]));
                $this->mapper->updateByKey((string) $name, $value);
            }
            return true;
        });
    }
}