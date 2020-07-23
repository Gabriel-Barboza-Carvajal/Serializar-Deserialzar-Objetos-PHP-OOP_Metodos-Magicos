<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Prueba de serializar un canton y deserealizarlo
        
        
        include_once './modelo/division.php';
        include_once './modelo/canton.php';
        include_once './modelo/distrito.php';
        include_once './modelo/provincia.php';
        include_once './modelo/division_total.php';
        include_once './cargarArchivo.php';
       
        $divi=new division_total();
        $divi->provincias= cargarArchivo::devolverXMLCostaRica();
        //serializamos la informacion obtenida.
        $data = $divi->__serialize();
        
        //deserealizamos.
        $diviDeserea=new division_total();
        
        $diviDeserea->__unserialize($data);
        
        echo '';
        
        // otra forma de cargar los datos desde el archivo esta es un poco mas rapido 
        // pero habria que analizar si es mas provechoso de esta manera.
//        $shipments = json_decode(file_get_contents("costaRica.json"), true);
//        print_r($shipments);
//        echo(json_encode($shipments,true,JSON_PRETTY_PRINT));
        ?>
    </body>
</html>
