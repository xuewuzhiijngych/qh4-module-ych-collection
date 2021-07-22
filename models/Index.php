<?php

namespace qh4module\collection\models;

class Index extends CollectionModel
{
    /**
     * @var int 接收参数,非必须：用户id
     */
    public $user_id;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $fields = ['id', 'user_id', 'item_id', 'item_name', 'snapshot', 'snapshot_type', 'col_time', 'del_time'];

        $tb_name = $this->external->TableName();
        $db = $this->external->getDb();

        $sql = $db->select($fields)->from($tb_name);

        if ($this->user_id) {
            $sql->where('user_id = :user_id')
                ->bindValue('user_id', $this->user_id);
        }

        /** @var array $data */
        $data = $sql
            ->whereArray([
                'del_time' => 0,
            ])
            ->query();

        foreach ($data as $k => $v) {
            if ($v['snapshot_type'] == 'json') {
                $data[$k]['snapshot'] = json_decode($v['snapshot']);
            } elseif ($v['snapshot_type'] == 'object') {
                $data[$k]['snapshot'] = @unserialize($v['snapshot']);
            }
            $data[$k]['col_time'] = date('Y-m-d H:i:s', $v['col_time']);
            if ($v['del_time']) {
                $data[$k]['del_time'] = date('Y-m-d H:i:s', $v['del_time']);
            }
        }

        $total = $db->single('SELECT FOUND_ROWS()');
        return array(
            'total' => $total,
            'list' => $data,
        );
    }
}
