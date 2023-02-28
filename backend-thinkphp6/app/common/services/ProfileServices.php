<?php

namespace app\common\services;

use app\common\dao\ProfileDao;

class ProfileServices extends BaseServices
{
    public function __construct(ProfileDao $dao)
    {
        $this->dao = $dao;
    }

    public function getInfo(int $id): ?array
    {
        return $this->dao->getInfoById($id);
    }
}