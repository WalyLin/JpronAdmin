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

use App\Jpro\Mapper\JproExtraInfoMapper;
use Mine\Abstracts\AbstractService;

/**
 * 人员额外信息表服务类
 */
class JproExtraInfoService extends AbstractService
{
    /**
     * @var JproExtraInfoMapper
     */
    public $mapper;

    public function __construct(JproExtraInfoMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}