<?php

namespace qh4module\collection\models;


use qttx\helper\ArrayHelper;

class Update extends CollectionModel
{
    /**
     * @var int 接收参数,必须：id
     */
    public $id;

    /**
     * @var int 接收参数,非必须：用户id
     */
    public $user_id;

    /**
     * @var int 接收参数,非必须：商品、店铺id等
     */
    public $item_id;

    /**
     * @var string 接收参数,非必须：名称
     */
    public $item_name;

    /**
     * @var string 接收参数,非必须：item快照，建议存储json或者序列化
     */
    public $snapshot;

    /**
     * @var string 接收参数,item快照存储类型
     * 如果传递了snapshot必须传递此参数 支持的参数 json object
     */
    public $snapshot_type;

    /**
     * @var int 接收参数,非必须：收藏时间
     */
    public $col_time;


    /**
     * @inheritDoc
     */
    public function rules()
    {
        return ArrayHelper::merge([
            [['id'],'required']
        ], parent::rules());
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $db = $this->external->getDb();
        $table_name = $this->external->TableName();

        $db->update($table_name)
            ->cols([
                'user_id' => $this->user_id,
                'item_id' => $this->item_id,
                'item_name' => $this->item_name ?? '',
                'snapshot' => $this->snapshot ?? '',
                'snapshot_type' => $this->snapshot_type ?? '',
            ])
            ->whereArray(['id' => $this->id])
            ->query();
        return true;
    }
}