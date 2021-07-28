<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Kalnoy\Nestedset\NestedSet;

class CheckListSetting extends Model
{
    //
    //use SearchableTrait;
    use NodeTrait;
    protected $fillable = [
        'parent_id',
        'name',
        'same_department',
        'type'
    ];

    protected $searchable = [
        'columns' => [
            'title' => 10,
        ],
    ];
    public static $STATUS = [
        'checklist_type'
    ];
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function childs(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }
    public function getLftName()
    {
        return '_lft';
    }

    public function getRgtName()
    {
        return '_rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

    // Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function checkList()
    {
        $this->hasMany(CheckList::class, 'id');
    }
}
