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
namespace App\Setting\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Mine\Annotation\Auth;
use Mine\Middlewares\CheckModuleMiddleware;
use Mine\MineController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * setting 公共方法控制器
 * Class CommonController.
 */
#[Controller(prefix: 'setting/common'), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class CommonController extends MineController
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
    /**
     * 返回模块信息及表前缀
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getModuleList')]
    public function getModuleList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            $this->mine->scanModule();
            return $this->success($this->mine->getModuleInfo());
        });
    }
}