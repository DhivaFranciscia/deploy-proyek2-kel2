<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::where('aktif', true)->orderBy('urutan');

        if ($request->filled('seksi')) {
            $query->where('seksi', $request->seksi);
        }

        $galeri = $query->get()->map(fn($g) => array_merge($g->toArray(), [
            'url' => asset('storage/' . $g->file),
        ]));

        return response()->json(['data' => $galeri]);
    }
}
