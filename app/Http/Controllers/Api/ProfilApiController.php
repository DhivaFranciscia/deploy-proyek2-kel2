<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SanggarProfile;

class ProfilApiController extends Controller
{
    public function index()
    {
        $profil = SanggarProfile::getInstance();
        return response()->json(['data' => $profil]);
    }
}
