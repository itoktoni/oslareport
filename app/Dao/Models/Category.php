<?php

namespace App\Dao\Models;

use App\Dao\Models\Core\SystemModel;

/**
 * Class Category
 *
 * @property $category_id
 * @property $category_name
 * @property $category_user_id
 * @property User $user
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends SystemModel
{
    protected $perPage = 20;

    protected $table = 'category';

    protected $primaryKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_id', 'category_name'];

    public static function field_name()
    {
        return 'category_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
