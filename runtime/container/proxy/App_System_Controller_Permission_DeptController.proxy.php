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
namespace App\System\Controller\Permission;

use App\System\Request\SystemDeptRequest;
use App\System\Service\SystemDeptService;
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
use Mine\Annotation\RemoteState;
use Mine\Middlewares\CheckModuleMiddleware;
use Mine\MineController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * Class DeptController.
 */
#[Controller(prefix: 'system/dept'), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class DeptController extends MineController
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
    protected SystemDeptService $service;
    /**
     * 部门树列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('index'), Permission('system:dept, system:dept:index')]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getTreeList($this->request->all()));
        });
    }
    /**
     * 回收站部门树列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('recycle'), Permission('system:dept:recycle')]
    public function recycleTree() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getTreeListByRecycle($this->request->all()));
        });
    }
    /**
     * 前端选择树（不需要权限）.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('tree')]
    public function tree() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getSelectTree());
        });
    }
    #[GetMapping('getLeaderList'), Permission('system:dept, system:dept:index')]
    public function getLeaderList()
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getLeaderList($this->request->all()));
        });
    }
    /**
     * 新增部门.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('save'), Permission('system:dept:save'), OperationLog]
    public function save(SystemDeptRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemDeptRequest $request) use($__function__, $__method__) {
            return $this->success(['id' => $this->service->save($request->all())]);
        });
    }
    /**
     * 新增部门领导
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('addLeader'), Permission('system:dept:update'), OperationLog('新增部门领导')]
    public function addLeader(SystemDeptRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemDeptRequest $request) use($__function__, $__method__) {
            return $this->service->addLeader($request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 删除部门领导
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[DeleteMapping('delLeader'), Permission('system:dept:delete'), OperationLog('删除部门领导')]
    public function delLeader(SystemDeptRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemDeptRequest $request) use($__function__, $__method__) {
            return $this->service->delLeader($request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 更新部门.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('update/{id}'), Permission('system:dept:update'), OperationLog]
    public function update(int $id, SystemDeptRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id', 'request'], 'keys' => compact(['id', 'request']), 'variadic' => ''], function (int $id, SystemDeptRequest $request) use($__function__, $__method__) {
            return $this->service->update($id, $request->all()) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量删除部门到回收站.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[DeleteMapping('delete'), Permission('system:dept:delete')]
    public function delete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->delete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量真实删除部门 （清空回收站）.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[DeleteMapping('realDelete'), Permission('system:dept:realDelete'), OperationLog]
    public function realDelete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            $data = $this->service->realDel((array) $this->request->input('ids', []));
            return is_null($data) ? $this->success() : $this->success(t('system.exists_children_ctu', ['names' => implode(',', $data)]));
        });
    }
    /**
     * 单个或批量恢复在回收站的部门.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('recovery'), Permission('system:dept:recovery')]
    public function recovery() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->recovery((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 更改部门状态
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('changeStatus'), Permission('system:dept:changeStatus'), OperationLog]
    public function changeStatus(SystemDeptRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemDeptRequest $request) use($__function__, $__method__) {
            return $this->service->changeStatus((int) $request->input('id'), (string) $request->input('status')) ? $this->success() : $this->error();
        });
    }
    /**
     * 数字运算操作.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('numberOperation'), Permission('system:dept:update'), OperationLog]
    public function numberOperation() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->numberOperation((int) $this->request->input('id'), (string) $this->request->input('numberName'), (int) $this->request->input('numberValue', 1)) ? $this->success() : $this->error();
        });
    }
    /**
     * 远程万能通用列表接口.
     */
    #[PostMapping('remote'), RemoteState(true)]
    public function remote() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getRemoteList($this->request->all()));
        });
    }
}