<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Owner;
class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Owner::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOwnerRequest $request) 
    {
        $input = $request->validated();
        $owner = Owner::create($input);
        return response()->json($owner, 201);
    }

    public function show(string $id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['message' => 'Proprietário não encontrado!'], 404);
        }

        return response()->json($owner);
    }

    public function update(UpdateOwnerRequest $request, string $id) 
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['message' => 'Proprietário não encontrado!'], 404);
        }

        $input = $request->validated();

        $owner->update($input);
        return response()->json($owner);
    }

    public function destroy(string $id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['message' => 'Proprietário não encontrado!'], 404);
        }

        $owner->delete();
        return response()->json(['message' => 'Proprietário deletado!']);
    }

}
