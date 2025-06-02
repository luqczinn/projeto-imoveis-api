<?php

namespace App\Repositories;

use App\Contracts\PropertyRepositoryContract;
use App\Models\Property;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class PropertyRepository.
 */
class PropertyRepository extends BaseRepository implements PropertyRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Property::class;
    }
}
