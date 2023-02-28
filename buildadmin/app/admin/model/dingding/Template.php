<?php

namespace app\admin\model\dingding;

use think\Model;

/**
 * Template
 * @controllerUrl 'dingdingTemplate'
 */
class Template extends Model
{
    // 表名
    protected $name = 'dingding_template';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

    protected $append = [
        'variable_text',
    ];

    public function getContentAttr($value, $row)
    {
        return !$value ? '' : htmlspecialchars_decode($value);
    }

    public function setVariablesAttr($value, $row)
    {
        if ($value && is_array($value)) {
            return implode(',', $value);
        }
        return $value ? $value : '';
    }

    public function getVariablesAttr($value, $row)
    {
        if ($value == '') {
            return [];
        }
        if (!is_array($value)) {
            return explode(',', $value);
        }
        return $value;
    }

    public function getVariableTextAttr($value, $row): array
    {
        if (!$row['variables']) {
            return [];
        }
        return Variable::whereIn('id', $row['variables'])->column('title');
    }
}
