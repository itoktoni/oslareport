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
class DataKotor extends SystemModel
{
    protected $perPage = 20;

    protected $connection = 'report';

    protected $table = 'data_kotor';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'rs_id',
        'ruangan_id',
        'jenis_id',
        'tanggal',
        'qty',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public static function field_name()
    {
        return 'category_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
