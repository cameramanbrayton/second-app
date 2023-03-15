<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\PetitionResource;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Response;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() 
    {
        // return new PetitionCollection(Petition::all());

        return response()->json(new PetitionCollection(Petition::all()), HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $petition = Petition::create($request->only([
            'title', 'description', 'category', 'author', 'signees'
        ]));

        return new PetitionResource($petition);

    }

    /**
     * Display the specified resource.
     */
    public function show(Petition $petition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Petition $petition)
    {
        $petition->update($request->only([
            'title', 'description', 'category', 'author', 'signees' 
        ]));

        return new PetitionResource($petition);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Petition $petition)
    {
        $petition->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
