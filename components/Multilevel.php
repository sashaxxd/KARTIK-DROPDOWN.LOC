<?php
/**
 * User: noutsasha
 * Date: 11.10.2017
 * Time: 22:02
 */

namespace app\components;


use yii\base\Component;

/**
 * Class Multilevel.
 *
 * @package Jay
 * @author Jay Shah <shahjaya.94@gmail.com>
 */
class Multilevel extends Component
{

    public static function makeDropDown($parents, $model)
    {
        global $data;
        $data = array();

        foreach ($parents as $parent) {

            $data[$parent->id] = $parent->name;
            self::subDropDown($parent->id, $space = '---', $model);
        }
        return $data;
    }

    public static function subDropDown($children, $space = '---', $model)
    {
        global $data;
        $childrens = $model->findAll(['parent_id' => $children]);
        foreach ($childrens as $child) {
            $data[$child->id] = $space . $child->name;
            self::subDropDown($child->id, $space . '---', $model);
        }
    }

}