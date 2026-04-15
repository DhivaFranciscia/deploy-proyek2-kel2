<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelatih;

class PelatihApiController extends Controller
{
    public function index()
    {
        $pelatih = Pelatih::where('aktif', true)
            ->orderBy('urutan')
            ->get()
            ->map(fn($p) => array_merge($p->toArray(), [
                'foto' => $p->foto ? asset('storage/' . $p->foto) : null,
            ]));

        return response()->json(['data' => $pelatih]);
    }
}
