<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(array $data)
    {
        return Pet::where('city', $data['city'])->firstOrFail();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        Pet::create([
            'name' => $request->name,
            'breed' => $request->breed,
            'age' => $request->age,
            'weight' => $request->weight,
            'city' => $request->city,
            'fk_user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Pet cadastrado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::where('id', $id)->first();
        $pet->update($request->all());

        return redirect()->back()->with('success', 'Pet alterado com sucesso!');
    }
}
