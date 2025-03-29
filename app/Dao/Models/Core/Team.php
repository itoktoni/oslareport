<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\TeamEntity;
use App\Facades\Model\TeamModel;
use App\Facades\Model\UserModel;

class Team extends SystemModel
{
    use TeamEntity;

    protected $table = 'teams';

    protected $primaryKey = 'team_id';

    protected $fillable = [
        'team_id',
        'team_name',
        'team_domain',
        'team_user_id',
    ];

    public $sortable = [
        'team_name',
        'team_domain',
    ];

    protected $casts = [
        'team_user_id' => 'integer',
    ];

    public static function field_name()
    {
        return 'team_name';
    }

    public function has_lead()
    {
        return $this->hasOne(UserModel::getModel(), UserModel::field_primary(), TeamModel::field_lead_id());
    }

    public function has_user()
    {
        return $this->belongsToMany(UserModel::getModel(), 'team_user', 'team_id', 'id');
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_key())->name('ID'),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build(UserModel::field_name())->name('Team Lead')->sort(),
        ];
    }

    public function dataRepository()
    {
        $query = $this
            ->select($this->getSelectedField())
            ->leftJoinRelationship('has_lead')
            ->sortable()
            ->filter();

        $query = env('PAGINATION_SIMPLE') ? $query->simplePaginate(env('PAGINATION_NUMBER')) : $query->paginate(env('PAGINATION_NUMBER'));

        return $query;
    }
}
