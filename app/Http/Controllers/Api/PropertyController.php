<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyFilterRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Http\Request;
use App\Models\Property;
class PropertyController extends Controller
{
    public function index()
    {
        return Property::with('owner')->get();
    }

    public function store(StorePropertyRequest $request)
    {
        $input = $request->validated();

        $property = Property::create($input);
        return response()->json($property, 201);
    }

    public function show(string $id)
    {
        $property = Property::with('owner')->find($id);

        if (!$property) {
            return response()->json(['message' => 'Propriedade não encontrada!'], 404);
        }

        return response()->json($property);
    }

    public function update(UpdatePropertyRequest $request, string $id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Propriedade não encontrada!'], 404);
        }

        $input = $request->validated();

        $property->update($input);
        return response()->json($property);
    }

    public function destroy(string $id)
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json(['message' => 'Propriedade não encontrada!'], 404);
        }

        $property->delete();
        return response()->json(['message' => 'Propriedade deletada!']);
    }

    public function search(PropertyFilterRequest $request)
{
    $input = $request->validated();

    $query = Property::with('owner');

    if (isset($input['city'])) {
        $query->where('city', 'like', '%' . $input['city'] . '%');
    }

    if (isset($input['min_value'])) {
        $query->where('price', '>=', $input['min_value']);
    }

    if (isset($input['max_value'])) {
        $query->where('price', '<=', $input['max_value']);
    }

    return response()->json($query->get());
}

}
