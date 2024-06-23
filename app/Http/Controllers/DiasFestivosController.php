<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiasFestivosRequest;
use App\Http\Requests\UpdateDiasFestivosRequest;
use App\Models\DiasFestivos;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;


class DiasFestivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = request()->get('order') ?? '';
        $search = request()->get('search') ?? '';
        $quantityPaginate = request()->get('p') ? request()->get('p') : 10;
        if ($search) {
            $fecha = null;
            $dia = ' ';
            $mes = ' ';
            $anyo = ' ';
            if (preg_match('/^([0-9]{1,2})(\/)([0-9]{1,2})(\/)(20[0-9]{2})$/', $search)) {
                $fecha = explode('/', $search);
                $dia = $fecha[0];
                $mes = $fecha[1];
                $anyo = $fecha[2];
            } else if (preg_match('/^([0-9]{1,2})(-)([0-9]{1,2})(-)(20[0-9]{2})$/', $search)) {
                $fecha = explode('-', $search);
                $dia = $fecha[0];
                $mes = $fecha[1];
                $anyo = $fecha[2];
            } else if (preg_match('/^([0-9]{1,2})(-)([0-9]{1,2})$/', $search)) {
                $fecha = explode('-', $search);
                $dia = $fecha[0];
                $mes = $fecha[1];
            } else if (preg_match('/^([0-9]{1,2})(-)(20[0-9]{2})$/', $search)) {
                $fecha = explode('-', $search);
                $mes = $fecha[0];
                $anyo = $fecha[1];
            }
            $diasFestivos = DiasFestivos::where('nombre', 'like', '%'. $search. '%')
                ->orWhere('nombre', 'like', $search. '%')
                ->orWhere('nombre', 'like', '%'. $search)
                ->orWhere('color', 'like', '%'. $search. '%')
                ->orWhere('color', 'like', '%'. $search)
                ->orWhere('dia', 'like', $search . '-%')
                ->orWhere('mes', 'like', '%-' . $search . '-%')
                ->orWhere('anyo', 'like', '%-'. $search)
                ->orWhere('dia', 'like', $search . '/%')
                ->orWhere('mes', 'like', '%/' . $search . '/%')
                ->orWhere('anyo', 'like', '%/'. $search)
                ->orWhere('dia', 'like', $search)
                ->orWhere('mes', 'like', $search)
                ->orWhere('anyo', 'like', $search)
                ->orWhere(function (Builder $query) use ($dia, $mes, $anyo) {
                    $query->where('dia', 'like', $dia. '%')
                    ->where('mes', 'like', '%'. $mes. '%')
                    ->where('anyo', 'like', '%'. $anyo);
                })
                ->orWhere(function (Builder $query) use ($dia, $mes) {
                    $query->where('dia', 'like', $dia. '%')
                    ->where('mes', 'like', '%'. $mes);
                })
                ->orWhere(function (Builder $query) use ($mes, $anyo) {
                    $query->where('mes', 'like', $mes. '%')
                    ->where('anyo', 'like', '%'. $anyo);
                });
        } else {
            $diasFestivos = DiasFestivos::query();
        }
        if ($order) {
            $segments = Str::of($order)->split('/-/');
            $descOrAsc = $segments[1] === 'up' ? 'desc' : 'asc';
            $diasFestivos = $diasFestivos->orderBy($segments[0], $descOrAsc)->paginate($quantityPaginate);
        } else {
            $diasFestivos = $diasFestivos->paginate($quantityPaginate);
        }
        return view('dias_festivos/index',
            [
                'dias_festivos' => $diasFestivos,
                'quantityPaginate' => $quantityPaginate,
                'search' => $search
            ]
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function json()
    {
        $diasFestivos = DiasFestivos::all();
        return response()->json(
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
        return response()->json([
            'dia_festivo' => $diasFestivos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiasFestivosRequest $request, DiasFestivos $diasFestivos)
    {
        $validated = $request->validated();
        $diasFestivos->update($validated);
        return to_route('dias-festivos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiasFestivos $diasFestivos)
    {
        $diasFestivos->delete();
        return response()->json(['success' => true]);
    }
}
