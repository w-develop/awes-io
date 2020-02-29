<?php

namespace App\Sections\Leads\Repositories;

use App\Sections\Leads\Models\Lead;
use AwesIO\Repository\Eloquent\BaseRepository;

class LeadRepository extends BaseRepository
{
    /**
     * The attributes that can be searched by.
     *
     * @var array
     */
    protected $searchable = [
        'status' => 'like',
        'name' => 'like'
    ];
    /**
     * Returns lead model's full class name.
     *
     * @return string
     */
    public function entity()
    {
        return Lead::class;
    }
}
