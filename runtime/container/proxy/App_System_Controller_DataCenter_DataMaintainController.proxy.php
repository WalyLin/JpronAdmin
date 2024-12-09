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
namespace App\System\Controller\DataCenter;

use App\System\Service\DataMaintainService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\OperationLog;
use Mine\Annotation\Permission;
use Mine\Middlewares\CheckModuleMiddleware;
use Mine\MineController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * Class DataMaintainController.
 */
#[Controller(prefix: 'system/dataMaintain'), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class DataMaintainController extends MineController
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
    protected DataMaintainService $service;
    /**
     * 列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('index'), Permission('system:dataMaintain, system:dataMaintain:index')]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getPageList($this->request->all()));
        });
    }
    /**
     * 详情.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('detailed'), Permission('system:dataMaintain:detailed')]
    public function detailed() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getColumnList($this->request->input('table', null)));
        });
    }
    /**
     * 优化表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('optimize'), Permission('system:dataMaintain:optimize'), OperationLog]
    public function optimize() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            $tables = $this->request->input('tables', []);
            return $this->service->optimize($tables) ? $this->success() : $this->error();
        });
    }
    /**
     * 清理表碎片.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('fragment'), Permission('system:dataMaintain:fragment'), OperationLog]
    public function fragment() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            $tables = $this->request->input('tables', []);
            return $this->service->fragment($tables) ? $this->success() : $this->error();
        });
    }
}