<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    # Buat properti animal (array)
    public $animals = [["nama" => "kancil"], ["nama" => "rubah"], ["nama" => "musang"]];
 
    public function index () {
        # Tampilkan data animals
        foreach ($this->animals as $hewan) {
            echo "nama hewan = $hewan[nama] | ";
        }
    }
    public function store (Request $request) { 
        # Tambahkan hewan baru
        array_push($this->animals, $request->nama);
        $this->index();
    }
    public function update (Request $request,$id) {
        # Edit hewan
        echo "Mengedit data hewan - id = $id";
    }
    public function destroy ($id) {
        # Hapus hewan
        echo "Menghapus data animal id = $id";
    }
}
