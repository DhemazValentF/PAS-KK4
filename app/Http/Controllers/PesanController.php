<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function index()
    {
        $data = Pesan::all();

        // return $data;
        return response()->json([
            'message' => 'Load data success',
            'data' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $table = new Pesan();
        $table->id_user = $request->user()->id;
        $table->konten = $request->konten;
        $table->save();

        // return $table;
        return response()->json([
            'message' => 'Store success',
            'data' => $table
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $table = Pesan::find($id);
        if($table) {
            $table->balasan = $request->balasan;
            $table->save();

            return $table;
        }else {
            return ['message' => 'Data not found'];
        }
    }
}