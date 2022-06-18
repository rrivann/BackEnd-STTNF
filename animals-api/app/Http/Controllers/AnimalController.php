<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animals;
    public function __construct()
    {
        $this -> animals = array('Sapi', 'Kambing', 'Kerbau');
    }

    function index() {
        echo 'Menampilkan data hewan <br>';
        foreach ($this -> animals as $animal){
            echo '- ' . $animal;
            echo '<br>';
        }
    }

    function store(Request $request) {
        echo 'Menambahkan hewan baru <br>';
        $name = $request->name;
        array_push($this -> animals , $name);
        $this -> index();
    }

    function update(Request $request, $id) {
        echo "Mengupdate data hewan id $id <br>";
        $name = $request->name;
        $replace = array($id => $name);
        $this ->  animals = array_replace($this -> animals, $replace);
        $this -> index();
    }

    function destroy($id) {
        echo "Menghapus data hewan id $id <br>";
        unset($this -> animals[$id]);
        $this -> index();
    }
}
