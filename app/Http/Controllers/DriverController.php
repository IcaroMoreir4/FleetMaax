<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller {
    public function index() {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create() {
        return view('drivers.create');
    }

    public function store(Request $request) {
        Driver::create($request->all());
        return redirect()->route('drivers.index')->with('success', 'Motorista adicionado!');
    }

    public function edit($id) {
        $driver = Driver::findOrFail($id);
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, $id) {
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());
        return redirect()->route('drivers.index')->with('success', 'Motorista atualizado!');
    }

    public function destroy($id) {
        Driver::destroy($id);
        return redirect()->route('drivers.index')->with('success', 'Motorista removido!');
    }
}
