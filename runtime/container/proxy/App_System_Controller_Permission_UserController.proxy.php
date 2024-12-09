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

use App\System\Dto\UserDto;
use App\System\Request\SystemUserRequest;
use App\System\Service\SystemUserService;
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
use Mine\MineCollection;
use Mine\MineController;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * Class UserController.
 */
#[Controller(prefix: 'system/user'), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class UserController extends MineController
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
    protected SystemUserService $service;
    /**
     * 用户列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('index'), Permission('system:user, system:user:index')]
    public function index() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getPageList($this->request->all(), false));
        });
    }
    /**
     * 回收站列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('recycle'), Permission('system:user:recycle')]
    public function recycle() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->success($this->service->getPageListByRecycle($this->request->all()));
        });
    }
    /**
     * 新增一个用户.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('save'), Permission('system:user:save'), OperationLog]
    public function save(SystemUserRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemUserRequest $request) use($__function__, $__method__) {
            return $this->success(['id' => $this->service->save($request->all())]);
        });
    }
    /**
     * 获取一个用户信息.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('read/{id}'), Permission('system:user:read')]
    public function read(int $id) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id'], 'keys' => compact(['id']), 'variadic' => ''], function (int $id) use($__function__, $__method__) {
            return $this->success($this->service->read($id));
        });
    }
    /**
     * 更新一个用户信息.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('update/{id}'), Permission('system:user:update'), OperationLog]
    public function update(int $id, SystemUserRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['id', 'request'], 'keys' => compact(['id', 'request']), 'variadic' => ''], function (int $id, SystemUserRequest $request) use($__function__, $__method__) {
            return $this->service->update($id, $request->all()) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量删除用户到回收站.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[DeleteMapping('delete'), Permission('system:user:delete')]
    public function delete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->delete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量真实删除用户 （清空回收站）.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[DeleteMapping('realDelete'), Permission('system:user:realDelete'), OperationLog]
    public function realDelete() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->realDelete((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 单个或批量恢复在回收站的用户.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('recovery'), Permission('system:user:recovery'), OperationLog]
    public function recovery() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->recovery((array) $this->request->input('ids', [])) ? $this->success() : $this->error();
        });
    }
    /**
     * 更改用户状态
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('changeStatus'), Permission('system:user:changeStatus'), OperationLog]
    public function changeStatus(SystemUserRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemUserRequest $request) use($__function__, $__method__) {
            return $this->service->changeStatus((int) $request->input('id'), (string) $request->input('status')) ? $this->success() : $this->error();
        });
    }
    /**
     * 清除用户缓存.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('clearCache'), Permission('system:user:cache')]
    public function clearCache() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            $this->service->clearCache((string) $this->request->input('id', null));
            return $this->success();
        });
    }
    /**
     * 设置用户首页.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('setHomePage'), Permission('system:user:homePage')]
    public function setHomePage(SystemUserRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemUserRequest $request) use($__function__, $__method__) {
            return $this->service->setHomePage($request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 初始化用户密码
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PutMapping('initUserPassword'), Permission('system:user:initUserPassword'), OperationLog]
    public function initUserPassword() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->initUserPassword((int) $this->request->input('id')) ? $this->success() : $this->error();
        });
    }
    /**
     * 更改用户资料，含修改头像 (不验证权限).
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('updateInfo')]
    public function updateInfo(SystemUserRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemUserRequest $request) use($__function__, $__method__) {
            return $this->service->updateInfo(array_merge($request->all(), ['id' => user()->getId()])) ? $this->success() : $this->error();
        });
    }
    /**
     * 修改密码 (不验证权限).
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('modifyPassword')]
    public function modifyPassword(SystemUserRequest $request) : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['order' => ['request'], 'keys' => compact(['request']), 'variadic' => ''], function (SystemUserRequest $request) use($__function__, $__method__) {
            return $this->service->modifyPassword($request->validated()) ? $this->success() : $this->error();
        });
    }
    /**
     * 用户导出.
     * @throws Exception
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('export'), Permission('system:user:export'), OperationLog]
    public function export() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->export($this->request->all(), UserDto::class, '用户列表');
        });
    }
    /**
     * 用户导入.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    #[PostMapping('import'), Permission('system:user:import')]
    public function import() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return $this->service->import(UserDto::class) ? $this->success() : $this->error();
        });
    }
    /**
     * 下载导入模板
     * @throws Exception
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('downloadTemplate')]
    public function downloadTemplate() : ResponseInterface
    {
        $__function__ = __FUNCTION__;
        $__method__ = __METHOD__;
        return self::__proxyCall(__CLASS__, __FUNCTION__, ['keys' => []], function () use($__function__, $__method__) {
            return (new MineCollection())->export(UserDto::class, '模板下载', []);
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