<?php

namespace app\common\dao;

use app\common\model\SysOption;

class SysOptionDao extends BaseDao
{
    public function __construct()
    {
        $this->setModel(SysOption::class);
    }
}