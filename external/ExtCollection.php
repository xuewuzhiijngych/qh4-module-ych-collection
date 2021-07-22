<?php

namespace qh4module\collection\external;

use qttx\web\External;

class ExtCollection extends External
{
    /**
     * 收藏表名
     */
    public function TableName()
    {
        return '{{%collection}}';
    }
}