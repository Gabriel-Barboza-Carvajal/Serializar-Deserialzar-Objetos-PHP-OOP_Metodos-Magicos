<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of provincia
 *
 * @author Gabriel Barboza Carvajal .
 */
//include './modelo/distrito.php';

class provincia extends division {

    public $cantones;

    public function __construct($num, $nom, $cant=null) {
        parent::__construct($num, $nom);
        $this->cantones = $cant;
    }

     public function __serialize(): array {
        return[
            'nombre' => $this->getNombre(),
            'número' => $this->getNumero(),
            'cantones' => $this->serializarCantones()
        ];
    }

    public function serializarCantones(): array {
        $todos = array();
        for ($index = 0; $index < count($this->cantones); $index++) {
            array_push($todos, ($this->cantones[$index])->__serialize());
        }
        return $todos;
    }

    public function __unserialize(array $data): void {
        $this->setNombre($data['nombre']);
        $this->setNumero($data['número']);
        $this->unserializarCantones($data);
    }
    
    public function unserializarCantones(array $data): void {
        $dis = $data['cantones'];
        $cont=0;
        foreach ($dis as $value) {
            $this->cantones[$cont] = new canton('', '');
            $this->cantones[$cont]->__unserialize($value);
            $cont+=1;
        }
    }

    public function __toString(): string {
        $str='';
        $str = '<br>' . $this->getNombre() . "|" . $this->getNumero() . '<br>';
        foreach ($this->cantones as $value) {
            $str .=$value->__toString();
        }
        return $str;
    }

}
