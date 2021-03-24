<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContatoRequest;
use App\Http\Resources\ContatoResource;
use App\Models\Contato;
use App\Repositories\EnderecoRepository;
use Illuminate\Http\Request;

class ContatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(ContatoResource::collection(
            Contato::when($request->filtro, function ($query) use ($request) {
                return $query->where("nome", "like", "%{$request->filtro}%");
            })->get()
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContatoRequest $request)
    {
        $contato = Contato::create($request->all());

        return response()->json(new ContatoResource($contato));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        return response()->json(
            new ContatoResource(Contato::findOrFail($contato))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contato $contato)
    {
        $contato->update($request->all());

        $contato->fresh();


        return response()->json(new ContatoResource($contato));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $contato)
    {
        return Contato::findOrFail($contato)->delete();
    }
}
