<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::all();

        return response()->json([
            'message' => 'Data Barang Sukses Dimuat',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Barang();
        $table->nama_produk = $request->nama_produk;
        $table->deskripsi = $request->deskripsi;
        $table->harga = $request->harga;
        $table->save();

        return response()->json([
            "message" => "Store success",
            "data" => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Barang::find($id);
        if($data){
            return $data;
        }else {
            return ['message' => 'Data Barang tidak ditemukan'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Barang::find($id);
        if($table){
            $table->nama_produk = $request->nama_produk ? $request->nama_produk : $table->nama_produk;
            $table->deskripsi = $request->deskripsi ? $request->deskripsi : $table->deskripsi;
            $table->harga = $request->harga ? $request->harga : $table->harga;
            $table->save();

            return $table;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Barang::find($id);
        if($table){
            $table->delete();
            return ["message" => "Delete sucess"];
        }else{
            return ["message" => "Data not found"];
        }
    }
}