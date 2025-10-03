<?php

namespace App\Http\Controllers;

use App\Services\PetstoreService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected PetstoreService $petstoreService;

    public function __construct(PetstoreService $petstoreService)
    {
        $this->petstoreService = $petstoreService;
    }

    public function index(Request $request): View
    {
        $status = $request->get('status');
        $pets = collect();
        if ($status) {
            $pets = collect($this->petstoreService->getPetsByStatus($status));
        }
        return view('welcome', [
            'pets' => $pets,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        $validated = $request->validated();
        $result = $this->petstoreService->addPet($validated['name'], $validated['status']);
        if ($result && isset($result['id'])) {
            Session::flash('success', __('Dodano zwierzę o ID: :id', ['id' => $result['id']]));
        } elseif ($result) {
            Session::flash('success', __('Zwierzę zostało dodane.'));
        } else {
            Session::flash('error', __('Nie udało się dodać zwierzęcia.'));
        }
        return redirect()->back()->withInput();
    }

    public function show($id)
    {
        $pet = $this->petstoreService->getPetById($id);
        if (!$pet) {
            abort(404);
        }
        return view('pets.show', ['pet' => $pet]);
    }

    public function update(UpdatePetRequest $request, $id)
    {
        $validated = $request->validated();
        $result = $this->petstoreService->updatePetFull($validated);
        if ($result) {
            Session::flash('success', __('Zaktualizowano zwierzę.'));
        } else {
            Session::flash('error', __('Nie udało się zaktualizować zwierzęcia.'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $result = $this->petstoreService->deletePet($id);
        if ($result) {
            \Session::flash('success', __('Zwierzę zostało usunięte.'));
        } else {
            \Session::flash('error', __('Nie udało się usunąć zwierzęcia.'));
        }
        return redirect()->route('home')->withInput();
    }
}
