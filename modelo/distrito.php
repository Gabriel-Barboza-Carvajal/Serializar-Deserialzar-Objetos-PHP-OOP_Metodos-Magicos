<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of distrito
 *
 * @author Gabriel Barboza Carvajal .
 */
//include './modelo/division.php';

class distrito extends division {

    private $secuencia;

    public function __construct($num = '', $nom = '', $sec = null) {
        parent::__construct($num, $nom);
        $this->secuencia = $sec;
    }

    public function getSecuencia() {
        return $this->secuencia;
    }

    public function setSecuencia($secuencia) {
        $this->secuencia = $secuencia;
        return $this;
    }

    public function __serialize(): array {
        return [
            'nombre'=> $this->getNombre(),
            'número'=> $this->getNumero(),
            'secuencia'=> $this->getSecuencia()
            ];
    }

    public function __unserialize(array $data): void {
        $this->secuencia=$data['secuencia'];
        $this->setNombre($data['nombre']);
        $this->setNumero($data['número']);
    }

    public function __toString(): string {
        $str='';
        $str= $this->getNombre() . ' , ' .$this->getNumero() . ' , ' . $this->getSecuencia();
        return $str;
    }

}
