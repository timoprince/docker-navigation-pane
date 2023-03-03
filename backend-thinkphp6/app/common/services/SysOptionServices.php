<?php

namespace app\common\services;

use app\common\dao\SysOptionDao;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class SysOptionServices extends BaseServices
{
    public function __construct(SysOptionDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 获取值
     * @param string $name 名称
     * @param mixed $def 默认值
     * @return mixed|null
     */
    public function get(string $name, $def = null)
    {
        try {
            $find = $this->dao->getModel()->where(["name" => $name])->visible(["name", "content"])->find();
            if (empty($find)) return $def;
            return $find->toArray();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return $def;
        }
    }

    /**
     * 设置值
     * @param string $name 值名称
     * @param mixed $content 值内容
     * @return void
     */
    public function set(string $name, $content)
    {
        $field = ["name" => $name, "content" => $content];
        if (is_null($this->get($name))) {
            $this->dao->createRow($field);
        } else {
            $this->dao->updateRowByWhere($field, [["where", ["name" => $name]]]);
        }
    }

}