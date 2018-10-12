<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_pro_comment".
 *
 * @property int $id id
 * @property int $user_id 用户id
 * @property string $username 用户名
 * @property string $email 邮箱
 * @property int $start 评价星级(0-5)
 * @property string $comment 评价内容
 * @property int $create_time 创建时间
 * @property string $pro_id 商品id
 *
 * @property Product $pro
 */
class ProComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_pro_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'start', 'create_time', 'pro_id'], 'integer'],
            [['comment'], 'string'],
            [['username', 'email'], 'string', 'max' => 25],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pro_id' => 'productid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'start' => 'Start',
            'comment' => 'Comment',
            'create_time' => 'Create Time',
            'pro_id' => 'Pro ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(Product::className(), ['productid' => 'pro_id']);
    }
}
