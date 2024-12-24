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
 * 事件类型管理验证数据类
 */
class JproPlanTypeRequest extends MineFormRequest
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
            //上级分类 验证
            'pid' => 'sometimes',
            //类型名称 验证
            'name' => 'required',
            //可以查看角色 验证
            'role' => 'sometimes',
            //状态 验证
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
            //上级分类 验证
            'pid' => 'sometimes',
            //类型名称 验证
            'name' => 'required',
            //可以查看角色 验证
            'role' => 'sometimes',
            //状态 验证
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
            'pid' => '上级分类',
            'name' => '类型名称',
            'remark' => '备注',
            'role' => '可以查看角色',
            'status' => '状态',

        ];
    }

}