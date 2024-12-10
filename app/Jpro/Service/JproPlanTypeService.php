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

namespace App\Jpro\Service;

use App\Jpro\Mapper\JproPlanTypeMapper;
use Mine\Abstracts\AbstractService;

/**
 * 事件类型管理服务类
 */
class JproPlanTypeService extends AbstractService
{
    /**
     * @var JproPlanTypeMapper
     */
    public $mapper;

    public function __construct(JproPlanTypeMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}