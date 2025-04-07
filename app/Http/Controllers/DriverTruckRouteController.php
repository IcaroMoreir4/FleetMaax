<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverTruckRoute;
use App\Models\Driver;
use App\Models\Truck;
use App\Models\Route;

class DriverTruckRouteController extends Controller {
    public function index() {
        $associations = DriverTruckRoute::with(['driver', 'truck', 'route'])->get();
        return view('driver_truck_route.index', compact('associations'));
    }

    public function create() {
        $drivers = Driver::all();
        $trucks = Truck::all();
        $routes = Route::all();
        return view('driver_truck_route.create', compact('drivers', 'trucks', 'routes'));
    }

    public function store(Request $request) {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'truck_id' => 'required|exists:trucks,id',
            'route_id' => 'required|exists:routes,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        DriverTruckRoute::create($request->all());

        return redirect()->route('driver_truck_route.index')
                         ->with('success', 'Associação registrada com sucesso!');
    }

    public function edit($id) {
        $association = DriverTruckRoute::findOrFail($id);
        $drivers = Driver::all();
        $trucks = Truck::all();
        $routes = Route::all();
        return view('driver_truck_route.edit', compact('association', 'drivers', 'trucks', 'routes'));
    }

    public function update(Request $request, $id) {
        $association = DriverTruckRoute::findOrFail($id);

        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'truck_id' => 'required|exists:trucks,id',
            'route_id' => 'required|exists:routes,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $association->update($request->all());

        return redirect()->route('driver_truck_route.index')
                         ->with('success', 'Associação atualizada com sucesso!');
    }

    public function destroy($id) {
        DriverTruckRoute::destroy($id);
        return redirect()->route('driver_truck_route.index')
                         ->with('success', 'Associação removida com sucesso!');
    }
}
