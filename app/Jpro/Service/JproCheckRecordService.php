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

use App\Jpro\Mapper\JproCheckRecordMapper;
use Mine\Abstracts\AbstractService;

/**
 * 就诊记录服务类
 */
class JproCheckRecordService extends AbstractService
{
    /**
     * @var JproCheckRecordMapper
     */
    public $mapper;

    public function __construct(JproCheckRecordMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}