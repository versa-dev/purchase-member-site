<?php

/**
 * Description of CategoryTree
 * This widget draw cateory tree drop down list
 * Required params: parent_id (int, default 0), name (string), id (string), excludelist(array, default empty)
 * @author Deepak Singh Kushwah
 */

namespace app\components;

use yii;
use app\models\ProductCategory;
class CategoryTree {

    /**
     * 
     * @param int $parent_id
     * @param string $name
     * @param string $id
     * @param array $exclude
     * @return string
     */
    public $data;
    public function drawDropDownTree($parent_id = 0, $name, $id, $exclude, $default_selected) {
        $str = "<select class='form-control' name='$name' id='$id'>";
        $str .= "<option value='0'>Root</option>";
        ob_start();
        $this->fetchCategories($parent_id, 0, $exclude, $default_selected);
        $str .=ob_get_contents();
        ob_end_clean();
        $str .= "</select>";
        return $str;
    }

    /**
     * 
     * @param type $parent_id
     * @param type $level
     * @param type $exclude
     * @return null
     */
    private function fetchCategories($parent_id, $level, $exclude, $default_selected) {
        $sql = "SELECT * FROM product_category WHERE parent_id='$parent_id'";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        if ($result && count($result) > 0) {
            foreach ($result as $row) {
                if (in_array($row['id'], $exclude))
                    continue;
                echo "<option " . ($default_selected == $row['id'] ? 'selected="selected"' : '') . " value='" . $row['id'] . "'>" . str_repeat("&nbsp;", $level * 3) . $row['cat_name'] . "</option>";
                $this->fetchCategories($row['id'], $level + 1, $exclude, $default_selected);
            }
        } else {
            return;
        }
    }

    public function drawTree($parent_id = 0, $edit = 0, $published_only = false) {
        $str = "";
        ob_start();
        $this->fetchCategoriesForTree($parent_id, 0, $edit, $published_only);
        $str .=ob_get_contents();
        ob_end_clean();
        return $str;
    }

    private function fetchCategoriesForTree($parent_id, $level, $edit, $published_only) {
        $sql = "SELECT * FROM product_category WHERE parent_id='$parent_id'";
        if ($published_only) {
            $sql.=" AND published='Yes' ";
        }
        $sql.=" ORDER BY orders ASC,cat_name ASC ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        if ($result && count($result) > 0) {

            foreach ($result as $row) {
                echo "<ul>";
                echo "<li>";
                echo "<a href='javascript:void(0);'>" . ucwords(strtolower($row['cat_name'])) . "</a>";
                if ($edit) {
                    echo "<span class='pull-right'>"
                    . "<a href='" . Yii::$app->urlManager->createAbsoluteUrl(['/backend/category/update', 'id' => $row['id']]) . "'>Edit</a> | "
                    . "<a onclick='javascript:if(confirm(\"Are you sure want to delete this category (with all subcats and products)?\")){ window.location.href=\"" . Yii::$app->urlManager->createAbsoluteUrl(['backend/category/delete', 'id' => $row['id']]) . "\" }' href='javascript:void(0);'>Delete</a>"
                    . "</span>";
                }
                $this->fetchCategoriesForTree($row['id'], $level + 1, $edit,$published_only);
                echo "</li>";
                echo "</ul>";
            }
        } else {
            return;
        }
    }

    public function getChildCategories($parent_id = 0) {
        $str = "";
        ob_start();
        $this->fetchChildCategories($parent_id,$published_only=true);
        $str.=ob_get_contents();
        ob_end_clean();
        return explode("|", rtrim($str, '|'));
    }

    public function fetchChildCategories($parent_id,$published_only) {
        $sql = "SELECT id FROM product_category WHERE parent_id='$parent_id'";
        if ($published_only) {
            $sql.=" AND published='Yes' ";
        }
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        if ($result && count($result) > 0) {
            foreach ($result as $row) {
                echo $row['id'] . "|";
                $this->fetchChildCategories($row['id'],true);
            }
        } else {
            return;
        }
    }

    
    public function makeDropDown($parents)
    {
        global $data;
        $data = array();
        $data['0'] = '-- ROOT --';
        foreach($parents as $key=>$value)
        {
            $data[$key] = $value;
            $this->subDropDown($key);
        }
        
       return $data;
    }
    
    
    public function subDropDown($children_id,$space = '---')
    {
        global $data;
        $children=ProductCategory::getCategories($children_id);
        foreach($children as $k=>$v)
                {
                    
                        $data[$k] = $space.$v;
                        $this->subDropDown($k,$space.'---');
                }
        
    }

   
}
