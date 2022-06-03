<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCategories extends Model
{
    //

    public function getAll()
    {
        $emailCategories = EmailCategories::all();
        return $emailCategories;
    }

    public function getNameCategoryById($id)
    {
        $emailCategory = EmailCategories::select('name')->where('id', $id)->get();
        return count($emailCategory) > 0 ? $emailCategory[0]->name : '';

    }
}
