<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class RouteController extends Controller {
    public function index() {
        $routes = Route::all();
        return view('routes.index', compact('routes'));
    }

    public function create() {
        return view('routes.create');
    }

    public function store(Request $request) {
        Route::create($request->all());
        return redirect()->route('routes.index')->with('success', 'Rota adicionada!');
    }

    public function edit($id) {
        $route = Route::findOrFail($id);
        return view('routes.edit', compact('route'));
    }

    public function update(Request $request, $id) {
        $route = Route::findOrFail($id);
        $route->update($request->all());
        return redirect()->route('routes.index')->with('success', 'Rota atualizada!');
    }

    public function destroy($id) {
        Route::destroy($id);
        return redirect()->route('routes.index')->with('success', 'Rota removida!');
    }
}
