<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiasFestivosRequest;
use App\Models\DiasFestivos;
use Illuminate\Http\Request;

class DiasFestivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diasFestivos = DiasFestivos::orderBy('nombre', 'desc')->paginate(10);
        return view('dias_festivos/index',
            [
                'dias_festivos' => $diasFestivos
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiasFestivosRequest $request)
    {
        $validated = $request->validated();
        DiasFestivos::create($validated);
        return to_route('dias-festivos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiasFestivos $diasFestivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiasFestivos $diasFestivos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiasFestivos $diasFestivos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiasFestivos $diasFestivos)
    {
        //
    }
}
