<?php

namespace qh4module\collection\models;

use qttx\helper\ArrayHelper;


class Delete extends CollectionModel
{
    /**
     * @var int 接收参数,必须：ID
     */
    public $id;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return ArrayHelper::merge([
            ['id', 'required']
        ], parent::rules());
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $this->external->getDb()
            ->update($this->external->TableName())
            ->col('del_time', time())
            ->whereArray(['id' => $this->id])
            ->query();
        return true;
    }
}