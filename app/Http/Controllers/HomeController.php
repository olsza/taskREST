<?php

namespace App\Http\Controllers;

use App\Services\PetstoreService;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected PetstoreService $petstoreService;

    public function __construct(PetstoreService $petstoreService)
    {
        $this->petstoreService = $petstoreService;
    }

    public function index(Request $request): View
    {
        $status = $request->get('status', 'available');
        $pets = collect($this->petstoreService->getPetsByStatus($status));
        return view('welcome', ['pets' => $pets]);
    }
}
