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
namespace App\Setting\Controller\Modules;

use App\Setting\Request\ModuleRequest;
use App\Setting\Service\ModuleService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\OperationLog;
use Mine\Annotation\Permission;
use Mine\Middlewares\CheckModuleMiddleware;
use Mine\MineController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * 本地模块管理
 * Class ModuleController.
 */
#[Controller(prefix: 'setting/module'), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class ModuleController extends MineController
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct(\Mine\Mine $mine, \Mine\MineRequest $request, \Mine\MineResponse $response)
    {
        if (method_exists(parent::class, '__construct')) {
            parent::__construct(...func_get_args());
        }
        $this->__handlePropertyHandler(__CLASS__);
    }
    #[Inject]
    protected ModuleService $service;
    /**
     * 本地模块列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('index'), Permission('setting:module, setting:module:index')]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getPageList($this->request->all()));
        });
    }
    /**
     * 新增本地模块.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('save'), Permission('setting:module:save'), OperationLog]
    public function save(ModuleRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (ModuleRequest $request) use($__function__, $__method__) {
            $this->service->createModule($request->validated());
            return $this->success();
        });
    }
    /**
     * 启停用模块.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('modifyStatus'), Permission('setting:module:status'), OperationLog]
    public function modifyStatus(ModuleRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (ModuleRequest $request) use($__function__, $__method__) {
            return $this->service->modifyStatus($request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 安装模块.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('install'), Permission('setting:module:install'), OperationLog]
    public function install() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->installModuleData($this->request->input('name')) ? $this->success() : $this->error();
        });
    }
    /**
     * 卸载删除模块.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Throwable
     */
    #[DeleteMapping('delete'), Permission('setting:module:delete'), OperationLog]
    public function delete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->uninstallModule($this->request->input('name')) ? $this->success() : $this->error();
        });
    }
}