<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck;

class TruckController extends Controller {
    public function index() {
        $trucks = Truck::all();
        return view('trucks.index', compact('trucks'));
    }

    public function create() {
        return view('trucks.create');
    }

    public function store(Request $request) {
        Truck::create($request->all());
        return redirect()->route('trucks.index')->with('success', 'Caminhão adicionado!');
    }

    public function edit($id) {
        $truck = Truck::findOrFail($id);
        return view('trucks.edit', compact('truck'));
    }

    public function update(Request $request, $id) {
        $truck = Truck::findOrFail($id);
        $truck->update($request->all());
        return redirect()->route('trucks.index')->with('success', 'Caminhão atualizado!');
    }

    public function destroy($id) {
        Truck::destroy($id);
        return redirect()->route('trucks.index')->with('success', 'Caminhão removido!');
    }
}
