<?php

namespace App\Repository;

use App\Models\Category;

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
         $this->treeArray($data, 0);
        return  $this->getTreeArray();
    }


    public function treeArray($data, $parentId = 0,$maxValueOffset=0)
    {
      if ($maxValueOffset==0){
          $maxValueOffset = Category::min('offset');
      }
        foreach ($data as $item) {
            $id = $item['category_id'];
            $category = Category::find($id);
           if ($parentId!=$category->id){
               $category->parent_id = $parentId;
           }else{
               return null;
           }
            $category->offset = $maxValueOffset++;
            $category->update();
            $Children = (isset($item['children'])) ? $item['children'] : false;
            if ($Children) {
                $this->treeArray($Children, $id);
            }
        }
    }

    public function getTreeArray()
    {
        $categories = Category::where("parent_id","=",0)->with(["children", "children.children.children"])->orderBy('offset', 'ASC')->get();
        return $categories;
    }
}
