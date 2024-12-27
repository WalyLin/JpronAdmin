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

use App\Jpro\Mapper\JproMotherMapper;
use Mine\Abstracts\AbstractService;

/**
 * 孕妈管理服务类
 */
class JproMotherService extends AbstractService
{
    /**
     * @var JproMotherMapper
     */
    public $mapper;

    public function __construct(JproMotherMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}