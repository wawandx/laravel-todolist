<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 5;

        if (request('search')) {
            $data = TOdo::Where('task', 'like', '%'.request('search').'%')->paginate($max_data)->withQueryString();
        } else {
            $data = Todo::orderBy('task', 'asc')->paginate($max_data);
        }
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'task' => 'required|min:3|max:25'
        ], [
            'task.required' => 'Task wajib diisi',
            'task.min' => 'Minimal isian untuk task diisi 3 karakter',
            'task.max' => 'Maksimum isian untuk task diisi 25 karakter'
        ]);

        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);
        return redirect()->route('todo')->with('success', 'Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request);
        $request->validate([
            'task' => 'required|min:3|max:25'
        ], [
            'task.required' => 'Task wajib diisi',
            'task.min' => 'Minimal isian untuk task diisi 3 karakter',
            'task.max' => 'Maksimum isian untuk task diisi 25 karakter'
        ]);

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        Todo::where('id', $id)->update($data);
        return redirect()->route('todo')->with('success', 'Berhasil perbaiki data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil menghapus data');
    }
}
