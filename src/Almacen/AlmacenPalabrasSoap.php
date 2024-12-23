<?php

namespace App\Almacen;

use \SoapClient;
use \SoapFault;

class AlmacenPalabrasSoap implements AlmacenPalabrasInterface {

    /**
     * 
     * @var SoapClient $clienteSoap Cliente Soap para acceder al servicio de palabras Soap
     */
    private SoapClient $clienteSoap;

    const URL = 'http://localhost/serviciopalabras/servicio.wsdl';

    /**
     * Constructor de la clase AlmacenPalabrasFichero
     * 
     * Lee todas las palabras del fichero indicado en el fichero de configuración y las almacena en la propiedad $listaPalabras
     * 
     * @param string $wsdl URL al wsdl del servicio
     * 
     * @returns AlmacenPalabrasSoap
     */
    public function __construct(string $wsdl= self::URL) {
        $this->clienteSoap = new SoapClient($wsdl);
    }

    /**
     * Obtiene una palabra aleatoria
     * 
     * 
     * @returns string Palabra aleatoria
     */
    public function obtenerPalabraAleatoria(): string {
        $palabra = $this->clienteSoap->getPalabraAleatoria();
        return $palabra;
    }

}
