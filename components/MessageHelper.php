<?php

/**
 * MessageHelper class provide useful resuable code for message center integration 
 * @author Deepak Singh Kushwah
 */

namespace app\components;

use yii;
use app\models\Message;
class MessageHelper {

    public static function getPath($id, &$path = array(), $level = 0) {        
        $rows = Message::find()->where("id = '$id'")->all();
        if (count($rows) == 0)
            return;

        foreach ($rows as $data) {
            array_push($path, $data->id);
            self::getPath($data->parent_id, $path, $level + 1);
        }
        return $path;
    }

}
