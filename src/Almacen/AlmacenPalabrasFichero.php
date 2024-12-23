<?php
namespace App\Almacen;

class AlmacenPalabrasFichero implements AlmacenPalabrasInterface {

    private $listaPalabras;

    public function __construct() {
        $path = "./assets/almacenes/palabras.txt";
        $fichero = fopen($path, 'r');
        // recorre todas las palabras y las guarda en el array $palabras
        // de forma separada
        while ($palabraFichero = fgets($fichero)) {
            $this->listaPalabras[] = trim($palabraFichero);
        }
    }

    public function obtenerPalabraAleatoria(): string {
        return $this->listaPalabras[array_rand($this->listaPalabras)];
    }
}
