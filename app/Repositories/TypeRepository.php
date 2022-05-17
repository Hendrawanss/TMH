<?php 

namespace App\Repositories;

use App\Interfaces\TypeRepositoryInterfaces;
use App\Models\Type;

class TypeRepository implements TypeRepositoryInterfaces
{
    public function getAllTypes()
    {
        return Type::all();
    }
}