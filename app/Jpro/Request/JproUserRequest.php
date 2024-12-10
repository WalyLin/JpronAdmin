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
namespace App\Jpro\Request;

use Mine\MineFormRequest;

/**
 * 人员管理验证数据类
 */
class JproUserRequest extends MineFormRequest
{
    /**
     * 公共规则
     */
    public function commonRules(): array
    {
        return [];
    }

    
    /**
     * 新增数据验证规则
     * return array
     */
    public function saveRules(): array
    {
        return [
            //昵称 验证
            'nickname' => 'required',
            //性别 验证
            'sex' => 'required',
            //状态 1正常 2禁用 验证
            'status' => 'required',

        ];
    }
    /**
     * 更新数据验证规则
     * return array
     */
    public function updateRules(): array
    {
        return [
            //昵称 验证
            'nickname' => 'required',
            //性别 验证
            'sex' => 'required',
            //状态 1正常 2禁用 验证
            'status' => 'required',

        ];
    }

    
    /**
     * 字段映射名称
     * return array
     */
    public function attributes(): array
    {
        return [
            'id' => '',
            'nickname' => '昵称',
            'sex' => '性别',
            'status' => '状态 1正常 2禁用',
            'remark' => '备注',

        ];
    }

}