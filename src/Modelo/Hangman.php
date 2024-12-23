<?php

namespace App\Modelo;

use App\Almacen\AlmacenPalabrasInterface;

/**
 * Clase que representa una partida del juego del ahorcado
 */
class Hangman {

    /**
     * @var int $numErrores Número de errores cometidos en la partida
     */
    private int $numErrores = 0;

    /**
     * @var $palabraSecreta Palabra secreta usada en la partida
     */
    private string $palabraSecreta;

    /**
     * @var $palabraDescubierta Estado de la palabra según va siendo descubierta. Por ejemplo c_c_e
     */
    private string $palabraDescubierta;

    /**
     * @var $letras Lista de jugadas que ha realizado el jugador en la partida
     */
    private string $letras = "";

    /**
     * @var $manNumErrores Número de errores permitido en la partida
     */
    private int $maxNumErrores;

    /**
     * Constructor de la clase Hangman
     * 
     * @param AlmacenPalabrasInterface $almacen Almacen de donde obtener palabras para el juego
     * @param int $maxNumErrores Número maximo de errores
     * 
     * @returns Hangman
     */
    public function __construct(AlmacenPalabrasInterface $almacen, int $maxNumErrores) {
        $this->setPalabraSecreta(strtoupper($almacen->obtenerPalabraAleatoria()));
        // Inicializa la estado de la palabra descubierta a una secuencia de guiones, uno por letra de la palabra oculta
        $this->setPalabraDescubierta(preg_replace('/\w+?/', '_', $this->getPalabraSecreta()));
        $this->maxNumErrores = $maxNumErrores;
    }

    /**
     * Recupera la palabra secreta de la partida
     * 
     * @returns string Palabra secreta de la partida
     */
    public function getPalabraSecreta(): string {
        return $this->palabraSecreta;
    }

    /**
     * Establece la palabra secreta de la partida
     * 
     * @param string $palabraSecreta Palabra secreta de la partida
     * 
     * @returns void
     */
    public function setPalabraSecreta(string $palabraSecreta): void {
        $this->palabraSecreta = $palabraSecreta;
    }

    /**
     * Recupera el estado de la palabra descubierta de la partida
     * 
     * @returns string Estado de la palabra descubierta de la partida
     */
    public function getPalabraDescubierta(): string {
        return $this->palabraDescubierta;
    }

    /**
     * Establece el estado de la palabra descubierta de la partida
     * 
     * @param string $palabraDescubierta El estado de la palabra descubierta de la partida
     * 
     * @returns void
     */
    public function setPalabraDescubierta(string $palabraDescubierta): void {
        $this->palabraDescubierta = $palabraDescubierta;
    }

    /**
     * Recupera el listado de letras jugadas en la partida
     * 
     * @returns string Listado de letras jugadas en la partida
     */
    public function getLetras(): string {
        return $this->letras;
    }

    /**
     * Establece el listado de letras jugadas en la partida
     * 
     * @param string $letras Listado de letras jugadas en la partida
     * 
     * @returns void
     */
    public function setLetras(string $letras): void {
        $this->letras = $letras;
    }

    /**
     * Recupera el número máximo de errores de la partida
     * 
     * @returns int Número máximo de errores de la partida
     */
    public function getMaxNumErrores(): int {
        return $this->maxNumErrores;
    }

    /**
     * Establece el número máximo de errores de la partida
     * 
     * @param int $maxNumErrores Número máximo de errores de la partida
     * 
     * @returns void
     */
    public function setMaxNumErrores($maxNumErrores): void {
        $this->maxNumErrores = $maxNumErrores;
    }

    /**
     * Recupera el número de errores cometido en la partida
     * 
     * @returns int Número de errores cometido en la partida
     */
    public function getNumErrores(): int {
        return $this->numErrores;
    }

    /**
     * Establece el número de errores cometido en la partida
     * 
     * @param int $numErrores Número de errores cometido en la partida
     * 
     * @returns void
     */
    public function setNumErrores($numErrores): void {
        $this->numErrores = $numErrores;
    }

    /**
     * Determina si una letra jugada es válida para el juego. Una letra es válida si se trata de una
     * letra en minúsculas o mayúsculas y si no ha sido jugada anteriormente
     * 
     * @param string $letra Letra elegida por el jugador
     * 
     * @returns bool Indica si la letra es válisa
     */
    public function esLetraValida(string $letra): bool {
        return ((strpos($this->getLetras(), strtoupper($letra)) === false) &&
                preg_match("/^[A-Za-z]$/", $letra));
    }

    /**
     * Comprueba la letra elegida por el jugador, modifica el estado de la palabra descubierta y añade la letra
     * 
     * @param string $letra Letra elegida por el jugador
     * 
     * @returns string El estado de la palabra descubierta
     */
    public function compruebaLetra(string $letra): string {
        $nuevaPalabraDescubierta = implode(array_map(function ($letraSecreta, $letraDescubierta) use ($letra) {
                    return ((strtoupper($letra) === $letraSecreta) ? $letraSecreta : $letraDescubierta);
                }, str_split($this->getPalabraSecreta()), str_split($this->getPalabraDescubierta())));
        if ($nuevaPalabraDescubierta == $this->getPalabraDescubierta()) {
            $this->numErrores++;
        } else {
            $this->setPalabraDescubierta($nuevaPalabraDescubierta);
        }
        $this->setLetras("{$this->getLetras()}$letra");
        return ($nuevaPalabraDescubierta);
    }

    /**
     * Comprueba si la palabra oculta el juego ya ha sido descubierta
     * 
     * @returns bool Verdadero si ya ha sido descubierta y falso en caso contrario
     */
    public function esPalabraDescubierta(): bool {
        // Si ya no hay guiones en la palabra descubierta
        return (!(strstr($this->getPalabraDescubierta(), "_")));
    }

    /**
     * Comprueba si la partida se ha acabado
     * 
     * @returns bool Verdadero si ya se ha acabado y falso en caso contrario
     */
    public function esFin(): bool {
        return ($this->esPalabraDescubierta() || ($this->getNumErrores() === $this->getMaxNumErrores()));
    }

    /**
     * Devuelve la puntuación de la palabra.
     * 
     * Si la palabra no se acierta la puntuación es 0.
     * Si la palabra tiene entre 3 y 5 letras se suman 2 ptos en otro caso 1 pto
     * Se suma un punto por cada combinación de dos vocales seguidas de la palabra
     * Se suma un punto si se descubre en 3 o menos fallos
     * Se suma un punto si se avergua en menos de 1 minuto
     *  
     * @returns int Puntuación de la palabra
     */
    public function getPuntuacion(): int {
        $puntuacion = 0;
        if ($this->esPalabraDescubierta()) {
            $puntuacion = 1 + preg_match_all('/[AEIOU]{2,}/', $this->getPalabraSecreta()) + 
                    (strlen($this->getPalabraSecreta()) >= 3 && strlen($this->getPalabraSecreta()) <= 5) + 
                    ($this->getNumErrores() <= 3);
        }
        return $puntuacion;
    }

}
