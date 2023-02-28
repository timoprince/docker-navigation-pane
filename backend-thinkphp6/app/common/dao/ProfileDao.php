<?php

namespace app\common\dao;

use app\common\model\SysUser;

class ProfileDao extends BaseDao
{
    public function __construct()
    {
        $this->setModel(SysUser::class);
    }
}