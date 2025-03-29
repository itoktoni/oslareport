<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\DefaultEntity;
use App\Dao\Entities\Core\FiltersEntity;
use App\Dao\Traits\ActiveTrait;
use App\Dao\Traits\DataTableTrait;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Mehradsadeghi\FilterQueryString\FilterQueryString as FilterQueryString;
use Touhidurabir\ModelSanitize\Sanitizable as Sanitizable;

class Filters extends Model
{
    use ActiveTrait;
    use DataTableTrait;
    use DefaultEntity;
    use FilterQueryString;
    use FiltersEntity;
    use Sanitizable;
    use Sortable;

    protected $table = 'system_filter';

    protected $primaryKey = 'filter_id';

    protected $fillable = [
        'filter_id',
        'filter_name',
        'filter_table',
        'filter_module',
        'filter_from_user',
        'filter_field',
        'filter_function',
        'filter_operator',
        'filter_value',
    ];

    public $sortable = [
        'filter_name',
        'filter_table',
        'filter_module',
    ];

    protected $filters = [
        'filter',
    ];

    public $timestamps = false;

    public $incrementing = false;

    public static function field_name()
    {
        return 'filter_code';
    }

    public function fieldSearching()
    {
        return $this->field_primary();
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('Code')->show(false),
            DataBuilder::build($this->field_name())->name('Code')->sort(),
            DataBuilder::build($this->field_table())->name('Table')->sort(),
            DataBuilder::build($this->field_field())->name('Field')->sort(),
            DataBuilder::build($this->field_function())->name('Function')->sort(),
            DataBuilder::build($this->field_operator())->name('Operator')->sort(),
            DataBuilder::build($this->field_value())->name('Value')->sort(),
        ];
    }
}
