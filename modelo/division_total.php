<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of division_total
 *
 * @author Gabriel Barboza Carvajal .
 */
//include './modelo/division.php';
class division_total extends division{
    
    function __construct() {
        parent::__construct('0', 'Costa Rica');
    }

      public function __serialize(): array {
        return[
            'nombre' => $this->getNombre(),
            'número' => $this->getNumero(),
            'provincias' => $this->serializarProvincias()
        ];
    }

    public function serializarProvincias(): array {
        $todos = array();
        for ($index = 0; $index < count($this->provincias); $index++) {
            array_push($todos, ($this->provincias[$index])->__serialize());
        }
        return $todos;
    }

    public function __unserialize(array $data): void {
        $this->setNombre($data['nombre']);
        $this->setNumero($data['número']);
        $this->unserializarProvincias($data);
    }
    
    public function unserializarProvincias(array $data): void {
        $dis = $data['provincias'];
        $cont=0;
        foreach ($dis as $value) {
            $this->provincias[$cont] = new provincia('', '');
            $this->provincias[$cont]->__unserialize($value);
            $cont+=1;
        }
    }

    public function __toString(): string {
        $str='';
        $str = '<br>' . $this->getNombre() . "|" . $this->getNumero() . '<br>';
        foreach ($this->provincias as $value) {
            $str .=$value->__toString();
        }
        return $str;
    }

    public $provincias = array();
    
  
}
