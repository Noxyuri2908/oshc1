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
}
