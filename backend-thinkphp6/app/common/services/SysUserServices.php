<?php

namespace app\common\services;

use app\common\dao\SysUserDao;

class SysUserServices extends BaseServices
{
    public function __construct(SysUserDao $dao)
    {
        $this->dao = $dao;
    }

    /**
     * 分页查询数据列表
     * @param int $page_size 每页条数
     * @param int $page_num 当前页码
     * @param array $whereList 查询条件
     * @return array
     */
    public function queryListByPage(int $page_size = 10, int $page_num = 1, array $whereList = []): array
    {
        return $this->dao->queryListByPage($page_size, $page_num, $whereList, ["password"]);
    }
}