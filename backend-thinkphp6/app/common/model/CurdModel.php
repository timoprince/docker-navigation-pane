<?php

namespace app\common\model;

use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class CurdModel extends BaseModel
{
    public function getInfoById(int $id): ?array
    {
        try {
            $row = $this->where(["id" => $id])->find();
            if (empty($row)) return null;
            return $row->toArray();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return null;
        }
    }
}