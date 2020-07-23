<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cargarArchivo
 *
 * @author Gabriel Barboza Carvajal .
 */

//include './modelo/provincia.php';
//include './modelo/canton.php';
class cargarArchivo {

    public function __construct() {
        
    }

    static public function devolverXMLCostaRica() {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_file('CostaRica.xml');
        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        } else {
//            print_r($xml);
            //recorremos las provincias
            $divisionPolitica= array();
            foreach ($xml->children() as $data)
            {
                $nombre= $data['nombre'];
                $numero= $data['número'];
                $provin=new provincia($numero, $nombre);
                $cantones=array();
                array_push($divisionPolitica,$provin);//agregamos la provincia a la division politica.
                //recorremos el numero de cantones que tiene la provincia
                for ($index = 0; $index < $data->cantón->count(); $index++) {                    
                    $nomDistrCanton=$data->cantón[$index]['nombre'];
                    $numDistrCanton=$data->cantón[$index]->count();
                    $canton=new canton($numDistrCanton, $nomDistrCanton);
                    array_push($cantones,$canton);//agregamos un canton a la provincia
                    //ahora ocupamos recorrer todos los distritos que maneja este primer canton
                    $x=$data->cantón[$index];
                    $distritos=array();
                    for ($index1 = 0; $index1 < $data->cantón[$index]->count(); $index1++) {
                         $nom=$data->cantón[$index]->distrito['nombre'];
                         $num=$data->cantón[$index]->distrito['número'];
                         $sec=$data->cantón[$index]->distrito['secuencia'];
                        $distri=new distrito($num, $nom, $sec);
                        array_push($distritos,$distri);
                    }
                    $canton->distritos=$distritos;
                    $provin->cantones=$cantones;
                }
                
            }
            
            
            }
            
            
        
        return $divisionPolitica;
    }
    

    static public function mostrarCantones($provincia) {

        for ($provincia->rewind(); $provincia->valid(); $provincia->next()) {

            if ($provincia->hasChildren()) {
                var_dump($provincia->current());
                echo "<br>";
            }
        }
    }

}
