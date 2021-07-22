<?php

namespace qh4module\collection\models;


use qttx\helper\ArrayHelper;


class Create extends CollectionModel
{
    /**
     * @var int 接收参数,必须：用户id
     */
    public $user_id;

    /**
     * @var int 接收参数,必须：商品、店铺id等
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
     * @var int 接收参数,必须：收藏时间
     */
    public $col_time;


    /**
     * snapshot 支持的参数
     * @var string[]
     */
    protected $snapshot_type_arr = ['json', 'object'];

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return ArrayHelper::merge([
            [['user_id', 'item_id'], 'required']
        ], parent::rules());
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $table_name = $this->external->TableName();

        if ($this->snapshot && !$this->snapshot_type) {
            return $this->addError('snapshot_type', 'snapshot_type参数未传递！');
        }

        if ($this->snapshot_type && $this->snapshot) {
            if (!in_array($this->snapshot_type, $this->snapshot_type_arr)) {
                return $this->addError('snapshot_type', 'snapshot_type参数格式错误！');
            }

            if ($this->snapshot_type == 'object') {
                $this->snapshot = serialize(json_decode($this->snapshot, true));
            }
        }

        \QTTX::$app->db->insert($table_name)
            ->cols([
                'user_id' => $this->user_id,
                'item_id' => $this->item_id,
                'item_name' => $this->item_name ?? '',
                'snapshot' => $this->snapshot ?? '',
                'snapshot_type' => $this->snapshot_type ?? '',
                'col_time' => time(),
            ])
            ->query();
        return true;

    }
}