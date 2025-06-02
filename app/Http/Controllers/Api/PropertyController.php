<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PropertyRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFilterRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Http\Request;
class PropertyController extends Controller
{
    protected $properties;

    public function __construct(PropertyRepositoryContract $properties)
    {
        $this->properties = $properties;
    }
    public function index()
    {
        return $this->properties->with('owner')->get();
    }

    public function store(StorePropertyRequest $request)
    {
        $input = $request->validated();

        $property = $this->properties->create($input);
        return response()->json($property, 201);
    }

    public function show(string $id)
    {
        $property = $this->properties->with('owner')->getById($id);

        if (!$property) {
            return response()->json(['message' => 'Propriedade não encontrada!'], 404);
        }

        return response()->json($property);
    }

    public function update(UpdatePropertyRequest $request, string $id)
    {
        $property = $this->properties->getById($id);

        if (!$property) {
            return response()->json(['message' => 'Propriedade não encontrada!'], 404);
        }

        $input = $request->validated();

        $property->update($input);
        return response()->json($property);
    }

    public function destroy(string $id)
    {
        $property = $this->properties->getById($id);

        if (!$property) {
            return response()->json(['message' => 'Propriedade não encontrada!'], 404);
        }

        $property->delete();
        return response()->json(['message' => 'Propriedade deletada!']);
    }

    public function search(PropertyFilterRequest $request)
{
    $input = $request->validated();

    $query = $this->properties->with('owner');
    if (isset($input['city'])) {
        $query->where('city', '%' . $input['city'] . '%', 'like');
    }

    if (isset($input['min_value'])) {
        $query->where('price', $input['min_value'], '>=');
    }

    if (isset($input['max_value'])) {
        $query->where('price', $input['max_value'], '<=');
    }
    
    return response()->json($query->get());
}

}
