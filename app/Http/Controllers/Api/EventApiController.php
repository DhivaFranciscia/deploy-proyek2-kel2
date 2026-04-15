<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $selesai   = (clone $query)->where('status', 'selesai')->orderByDesc('tanggal')->get();
        $featured  = $selesai->where('unggulan', true)->values();
        $mendatang = (clone $query)->where('status', 'akan_datang')->orderBy('tanggal')->get();

        $mapFoto = fn($e) => array_merge($e->toArray(), [
            'foto' => $e->foto ? asset('storage/' . $e->foto) : null,
        ]);

        return response()->json([
            'featured'  => $featured->map($mapFoto)->values(),
            'selesai'   => $selesai->map($mapFoto)->values(),
            'mendatang' => $mendatang->map($mapFoto)->values(),
            'stats'     => [
                'total'          => Event::count(),
                'internasional'  => Event::where('kategori', 'internasional')->count(),
                'nasional_lokal' => Event::whereIn('kategori', ['nasional', 'festival', 'pentas', 'kompetisi'])->count(),
                'penghargaan'    => Event::whereNotNull('hasil')->where('hasil', '!=', '')->count(),
            ],
        ]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return response()->json([
            'data' => array_merge($event->toArray(), [
                'foto' => $event->foto ? asset('storage/' . $event->foto) : null,
            ]),
        ]);
    }
}
