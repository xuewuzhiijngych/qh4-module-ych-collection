QH4框架扩展模块-收藏模块

### 功能

1、收藏模块，可用于店铺、商品、视频收藏

### 前言
+ 收藏模块，数据库字段 item_id 可以是任何关联表的字段，例如收藏商品，收藏店铺
- 除关联id外，我们还应该存储被收藏类的有用属性，例如商品价格，标题，图片等，可用数据表的 snapshot字段存储，
存储格式可以为json 或者 序列化 都可以

### 助手方法

```php
```

### 方法列表

```php
      /**
     * 列表
     * @return array
     */
    public function actionIndex()
    {
    }
```
```php
    /**
     * 新增
     * @return array
     * 当传递snapshot参数时，无论snapshot_type传递哪种，snapshot全部要以json格式传递
     */
    public function actionCreate()
    {
    }
```
```php
    /**
     * 更新
     * @return array
     */
    public function actionUpdate()
    {
    }
```

```php
    /**
     * 删除
     * @return array
     */
    public function actionDelete()
    {
    }
```