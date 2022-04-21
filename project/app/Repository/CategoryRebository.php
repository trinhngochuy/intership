<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRebository
{
    public $arr = [];
    public function createCategory($data){
       $category = (isset($data["category_name"])) ? $data["category_name"] : null;
       if ($category!=null){
           $maxValue = Category::max('offset');
           $dataCreate = [
               'name' => $category,
               'offset' =>++$maxValue,
               'parent_id'=>0
           ];
          $ctnew = Category::create($dataCreate);
         return $ctnew;
       }
       return false;
    }
    public function updateCategory($data)
    {
        $result = $this->treeArray($data, 0);
        return  $result;
    }
    public function treeArray($data, $parentId = 0)
    {
        $maxValueOffset = Category::max('offset');
        foreach ($data as $item) {
            $id = $item['category_id'];
            $category = Category::find($id);
           if ($parentId!=$category->id){
               $cases[] = " WHEN {$id} then  {$parentId}";
           }else{
               return false;
           }
            $cases_offset[]= " WHEN {$id} then  {$maxValueOffset}";
            $Children = (isset($item['children'])) ? $item['children'] : false;
            if ($Children) {
                $this->treeArray($Children, $id);
            }
            $maxValueOffset++;
        }
        $new = implode(' ', $cases);
        $new_offset = implode(' ', $cases_offset);
        DB::update("UPDATE categories SET `parent_id` = CASE `id` {$new} ELSE `parent_id` END");
        DB::update("UPDATE categories SET `offset` = CASE `id` {$new_offset} ELSE `offset` END");
        return true;
    }

    public function getTreeArray()
    {
        $categories = Category::where("parent_id","=",0)->with(["children", "children.children.children"])->orderBy('offset', 'ASC')->get();
        return $categories;
    }
}
//code update cate_old
//if ($maxValueOffset==0){
//    $maxValueOffset = Category::min('offset');
//}
//foreach ($data as $item) {
//    $id = $item['category_id'];
//    $category = Category::find($id);
//    if ($parentId!=$category->id){
//        $category->parent_id = $parentId;
//    }else{
//        return false;
//    }
//    $category->offset = $maxValueOffset++;
//    $category->update();
//    $Children = (isset($item['children'])) ? $item['children'] : false;
//    if ($Children) {
//        $this->treeArray($Children, $id);
//    }
//}
//return true;
