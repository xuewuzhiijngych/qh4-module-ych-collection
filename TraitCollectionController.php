<?php

namespace qh4module\collection;

use qh4module\collection\external\ExtCollection;

use qh4module\collection\models\Index;
use qh4module\collection\models\Create;
use qh4module\collection\models\Update;
use qh4module\collection\models\Delete;
use qh4module\collection\models\Cleanup;

trait TraitCollectionController
{

    public function ext_collection()
    {
        return new ExtCollection();
    }

    /**
     * 列表
     * @return array
     */
    public function actionIndex()
    {
        $model = new Index([
            'external' => $this->ext_collection(),
        ]);
        return $this->runModel($model);
    }

    /**
     * 新增
     * @return array
     * 当传递snapshot参数时，无论snapshot_type传递哪种，snapshot全部要以json格式传递
     */
    public function actionCreate()
    {
        $model = new Create([
            'external' => $this->ext_collection(),
        ]);
        return $this->runModel($model);
    }

    /**
     * 更新
     * @return array
     */
    public function actionUpdate()
    {
        $model = new Update([
            'external' => $this->ext_collection(),
        ]);
        return $this->runModel($model);
    }


    /**
     * 删除/取消收藏
     * @return array
     */
    public function actionDelete()
    {
        $model = new Delete([
            'external' => $this->ext_collection(),
        ]);
        return $this->runModel($model);
    }

    /**
     * 清空收藏
     * @return array
     */
    public function actionCleanup()
    {
        $model = new Cleanup([
            'external' => $this->ext_collection(),
        ]);
        return $this->runModel($model);
    }

}