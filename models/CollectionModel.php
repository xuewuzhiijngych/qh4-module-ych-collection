<?php

namespace qh4module\collection\models;


use qh4module\collection\external\ExtCollection;
use qttx\web\ServiceModel;


class CollectionModel extends ServiceModel
{

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'item_id', 'col_time', 'del_time'], 'integer'],
            [['item_name'], 'string', ['max' => 255]],
            [['snapshot_type'], 'string', ['max' => 50]],
            [['snapshot'], 'string', ['max' => 65535]]
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributeLangs()
    {
        return [
            'id' => 'id',
            'user_id' => '用户id',
            'item_id' => '商品、店铺id等',
            'item_name' => '名称',
            'snapshot' => 'item快照，建议存储json或者序列化',
            'snapshot_type' => '快照存储类型',
            'col_time' => '收藏时间',
            'del_time' => '取消收藏时间，软删除'
        ];

    }
}