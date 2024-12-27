<?php
declare(strict_types=1);
/**
 * MineAdmin is committed to providing solutions for quickly building web applications
 * Please view the LICENSE file that was distributed with this source code,
 * For the full copyright and license information.
 * Thank you very much for using MineAdmin.
 *
 * @Author X.Mo<root@imoi.cn>
 * @Link   https://gitee.com/xmo/MineAdmin
 */

namespace App\Jpro\Controller;

use App\Jpro\Service\JproCheckRecordService;
use App\Jpro\Request\JproCheckRecordRequest;
use App\System\Model\SystemUser;
use App\System\Service\SystemDeptService;
use App\System\Service\SystemUserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\RemoteState;
use Mine\Annotation\OperationLog;
use Mine\Annotation\Permission;
use Mine\MineController;
use Psr\Http\Message\ResponseInterface;
use Mine\Middlewares\CheckModuleMiddleware;
use Hyperf\HttpServer\Annotation\Middleware;

/**
 * 一些简单的接口
 * Class JproCommonController
 */
#[Controller(prefix: "jpro/common"), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class JproCommonController extends MineController
{
    /**
     * 业务处理服务
     * JproCheckRecordService
     */
    #[Inject]
    protected SystemUserService $systemUserService;


    #[Inject]
    protected SystemDeptService $systemDeptService;


    /**
     * 医生列表
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("doctors"), Permission("jpro:common,jpro:common:doctors")]
    public function doctors(): ResponseInterface
    {
        return $this->success($this->systemUserService->getDoctorList());
    }


    /**
     * 医生列表
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    #[GetMapping("hospitals"), Permission("jpro:common,jpro:common:hospitals")]
    public function hospitals(): ResponseInterface
    {
        return $this->success($this->systemDeptService->getHospitalList());
    }

}