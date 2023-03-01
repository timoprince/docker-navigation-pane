<?php

namespace app\common;

use hg\apidoc\annotation\Method;
use hg\apidoc\annotation\Query;
use hg\apidoc\annotation\Returned;

class Definitions
{
    /**
     * @Query("page_num",type="int",desc="当前页码，留空则为1",default=1)
     * @Query("page_size",type="int",desc="每页条数，留空则为10",default=10)
     * @return void
     */
    public function pageQuery()
    {

    }

    /**
     * @Returned("total",type="int",desc="总条数")
     * @Returned("page_num",type="int",desc="当前页码")
     * @Returned("page_size",type="int",desc="当前每页条数")
     * @return void
     */
    public function pageReturn()
    {

    }
}