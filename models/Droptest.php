<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "droptest".
 *
 * @property string $id
 * @property string $name
 * @property int $cat
 * @property int $subcat
 */
class Droptest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'droptest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cat', 'subcat'], 'required'],
            [['cat', 'subcat'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cat' => 'Cat',
            'subcat' => 'Subcat',
        ];
    }



    public function getCategory(){
        return $this->hasOne(PodguznikCategory::className(), ['id' => 'category_id']);
    }


    public function getRazdels(){
        return $this->hasOne(Razdel::className(), ['parent_id' => 'razdel']);
    }

    public function getType(){
        return $this->hasOne(Dropdown::className(), ['id' => 'subcat']);
    }
}
