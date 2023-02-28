<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class BaseModel extends Model
{
    use SoftDelete;

    protected $autoWriteTimestamp = true;

    protected $jsonAssoc = true;
}