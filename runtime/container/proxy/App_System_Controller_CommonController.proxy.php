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
namespace App\System\Controller;

use App\System\Service\SystemDeptService;
use App\System\Service\SystemLoginLogService;
use App\System\Service\SystemNoticeService;
use App\System\Service\SystemOperLogService;
use App\System\Service\SystemPostService;
use App\System\Service\SystemRoleService;
use App\System\Service\SystemUploadFileService;
use App\System\Service\SystemUserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Mine\Annotation\Auth;
use Mine\Middlewares\CheckModuleMiddleware;
use Mine\MineController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * 公共方法控制器
 * Class CommonController.
 */
#[Controller(prefix: 'system/common'), Auth]
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
    #[Inject]
    protected SystemUserService $userService;
    #[Inject]
    protected SystemDeptService $deptService;
    #[Inject]
    protected SystemRoleService $roleService;
    #[Inject]
    protected SystemPostService $postService;
    #[Inject]
    protected SystemNoticeService $noticeService;
    #[Inject]
    protected SystemLoginLogService $loginLogService;
    #[Inject]
    protected SystemOperLogService $operLogService;
    #[Inject]
    protected SystemUploadFileService $service;
    /**
     * 获取用户列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getUserList')]
    public function getUserList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->userService->getPageList($this->request->all()));
        });
    }
    /**
     * 通过 id 列表获取用户基础信息.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('getUserInfoByIds')]
    public function getUserInfoByIds() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->userService->getUserInfoByIds((array) $this->request->input('ids', [])));
        });
    }
    /**
     * 获取部门树列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getDeptTreeList')]
    public function getDeptTreeList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->deptService->getSelectTree());
        });
    }
    /**
     * 获取角色列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getRoleList')]
    public function getRoleList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->roleService->getList());
        });
    }
    /**
     * 获取岗位列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getPostList')]
    public function getPostList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->postService->getList());
        });
    }
    /**
     * 获取公告列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getNoticeList')]
    public function getNoticeList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->noticeService->getPageList($this->request->all()));
        });
    }
    /**
     * 获取登录日志列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getLoginLogList')]
    public function getLoginLogPageList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->loginLogService->getPageList(array_merge($this->request->all(), ['username' => user()->getUsername()])));
        });
    }
    /**
     * 获取操作日志列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('getOperationLogList')]
    public function getOperLogPageList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->operLogService->getPageList(array_merge($this->request->all(), ['username' => user()->getUsername()])));
        });
    }
    #[GetMapping('getResourceList')]
    public function getResourceList() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getPageList($this->request->all()));
        });
    }
    /**
     * 清除所有缓存.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('clearAllCache')]
    public function clearAllCache() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            $this->userService->clearCache((string) user()->getId());
            return $this->success();
        });
    }
}