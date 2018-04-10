<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dropdown".
 *
 * @property string $id
 * @property string $name
 * @property int $drop_id
 */
class Dropdown extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dropdown';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'drop_id'], 'required'],
            [['drop_id'], 'integer'],
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
            'drop_id' => 'Drop ID',
        ];
    }
}
