<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of canton
 *
 * @author Gabriel Barboza Carvajal .
 */
//include './modelo/division.php';
//include './modelo/distrito.php';
class canton extends division {

    public $distritos;

    public function __construct($num, $nom, $distro = array()) {
        parent::__construct($num, $nom);
        $this->distritos = $distro;
    }

    public function agregarCantones($distritos) {
        $this->distritos = $distritos;
    }
    
    public function __serialize(): array {
        return[
            'nombre' => $this->getNombre(),
            'número' => $this->getNumero(),
            'distritos' => $this->serializarDistritos()
        ];
    }

    public function serializarDistritos(): array {
        $todos = array();
        for ($index = 0; $index < count($this->distritos); $index++) {
            array_push($todos, ($this->distritos[$index])->__serialize());
        }
        return $todos;
    }

    public function unserializarDistritos(array $data): void {
        $dis = $data['distritos'];
        $cont=0;
        foreach ($dis as $value) {
            $this->distritos[$cont] = new distrito('', '');
            $this->distritos[$cont]->__unserialize($value);
            $cont+=1;
        }
    }

    public function __unserialize(array $data): void {
        $this->setNombre($data['nombre']);
        $this->setNumero($data['número']);
        $this->unserializarDistritos($data);
    }

    public function __toString(): string {
        $str='';
        $str = '<br>' . $this->getNombre() . "|" . $this->getNumero() . '<br>';
        foreach ($this->distritos as $value) {
            $str .= $value->__toString();
        }
        return $str;
    }

}
