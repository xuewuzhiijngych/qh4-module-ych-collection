<?php


namespace qh4module\collection\models;


use qttx\helper\ArrayHelper;

/**
 * 清空收藏
 * Class Cleanup
 * @package qh4module\collection\models
 */
class Cleanup extends CollectionModel
{
    /**
     * @var int 接收参数,必须：user_id 用户id
     */
    public $user_id;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return ArrayHelper::merge([
            ['user_id', 'required']
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
            ->whereArray(['user_id' => $this->user_id])
            ->query();
        return true;
    }

}