<?php

namespace App\Repositories;

use App\Contracts\OwnerRepositoryContract;
use App\Models\Owner;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class OwnerRepository.
 */
class OwnerRepository extends BaseRepository implements OwnerRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Owner::class;
    }
}
