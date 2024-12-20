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
 * 人员额外信息表验证数据类
 */
class JproExtraInfoRequest extends MineFormRequest
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
            //用户id 验证
            'user_id' => 'required',
            //类型 验证
            'type' => 'required',
            //可以查看的角色 验证
            'role' => 'required',
            //状态 1-正常 2-禁用 验证
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
            //用户id 验证
            'user_id' => 'required',
            //类型 验证
            'type' => 'required',
            //可以查看的角色 验证
            'role' => 'required',
            //状态 1-正常 2-禁用 验证
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
            'user_id' => '用户id',
            'type' => '类型',
            'role' => '可以查看的角色',
            'status' => '状态 1-正常 2-禁用',

        ];
    }

}