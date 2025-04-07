<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller {
    public function index() {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function create() {
        return view('reports.create');
    }

    public function store(Request $request) {
        Report::create($request->all());
        return redirect()->route('reports.index')->with('success', 'Relatório gerado!');
    }

    public function show($id) {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }
}
