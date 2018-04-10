<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "podguznik_category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 * @property string $alias
 * @property int $drop_id
 * @property int $drops_id
 */
class PodguznikCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'podguznik_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'drop_id', 'drops_id'], 'integer'],
            [['name', 'alias', 'drop_id', 'drops_id'], 'required'],
            [['name', 'keywords', 'description', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'alias' => 'Alias',
            'drop_id' => 'Drop ID',
            'drops_id' => 'Drops ID',
        ];
    }

    public static function getHierarchy($indent = '', $parent_group = 0) {
        $options = [];

        $parents = self::find()->where(['parent_id'=>$parent_group])->all();
        foreach($parents as $id => $p) {
            $children = self::find()->where(["parent_id"=>$p->id])->all();
            $child_options = [];



            foreach($children as $child => $z) {




                $children2 = self::find()->where(["parent_id"=>$z->id])->all();
                $child_options2 = [];
                foreach($children2 as $child2) {

                    $child_options2[$child2->id] = $child2->name;
                }


                $child_options[$z->name] = $child_options2;
            }

            $options[$p->name] = $child_options;


        }
        return $options;
    }



    public static function getItems($indent = '', $parent_group = 0)
    {
        $items = [];
        // for all childs of $parent_group (roots if $parent_group == null)
        $groups = self::find()->where(['parent_id'=>$parent_group])
            ->orderBy('id')->all();
        foreach($groups as $group)
        {
            // add group to items list
            $items[$group->id] = $indent.$group->name;
            // recursively add children to the list with indent
            $items = array_merge($items, self::getItems($indent . html_entity_decode("&nbsp;&nbsp;&nbsp;"), $group->id));
        }
        return $items;
    }
}
