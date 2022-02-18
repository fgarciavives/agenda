<!DOCTYPE html>
<!--
		AGENDA ASOCIATIVA
        el código php está abajo después de <h1>NOMBRES</h1> para que quede como en tu página
-->

<html><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Formulario para probar datos</title>
    <!-- Preparamos el entorno gráfico para los datos -->
    <style type="text/css">
 
        div {
            padding: 10px 20px
        }

        h1 {
            font-family: sans-serif;
            font-style: italic;
            text-transform: capitalize;
            color: #008000;
        }

        .bajoDch {
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-bottom: 0px;
            bottom: 0px;
            right: 0px;
        } 

        .altoDch1 {
            color: #00f;
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-top: 0px;
            top: 0px;
            right: 0px;
        }

        .altoDch2 {
            color: #f00;
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-top: 0px;
            top: 0px;
            right: 0px;
        }

    </style>
</head>
<!-- Comenzamos poniendo el foco del cursor en la pregunta de nombre -->

<body onload="document.forms.formulario.nombre.focus()">
    
    <h1>Nombres</h1>    <!-- Creamos una capa en la parte inferior derecha para que no estorben las preguntas -->

    <?php

if (isset($_REQUEST['tabla'])) {
    eval("\$tabla=".($_REQUEST['tabla']).';');

    if (!empty($_REQUEST['nombre'])){
    $encontrado = false;
    foreach ($tabla as $key => $nombre) {
        foreach ($nombre as $valor) {
                if ($valor==$_REQUEST['nombre']) {
                    if ($_REQUEST['telefono']=="") {
                        unset($tabla[$key]);
                    } else {
                        $tabla[$key] = array('nombre' => $_REQUEST['nombre'],
                        'telefono' => $_REQUEST['telefono']);
                    }
                    $encontrado = true;
                    break;
                }
        }
    }
    if (!$encontrado && $_REQUEST['telefono']!=""){
        $tabla[] = array('nombre' => $_REQUEST['nombre'], 'telefono' => $_REQUEST['telefono']);
    } 
} else {
    echo "Te falta el nombre";
}

} else {
    $tabla = array();
}

if (count($tabla)>0) {
    echo "<table border=1>";
    echo "<tr><td>Nombres</td><td>Teléfono</td></tr>";
    foreach ($tabla as $persona) {
        foreach ($persona as $clave => $valor) {
            if ($clave=="nombre") {
                echo "<tr><td>$valor</td>";
            } 
            if ($clave =="telefono") {
                echo "<td>$valor</td></tr>";
            }
        }
    }
    echo "</table>";
}

?>

    <div class="bajoDch">
        <!-- Creamos un formulario para enviar sus datos por POST a la misma página -->
        <form name="formulario" action="" method="post">
            Introduzca los datos
                    <table style="border: 0px;">
                <tbody><tr style="background-color: #8080ff;"><!-- Solicitamos el nombre de la persona -->
                    <td>
                        <fieldset>
                            <legend>Nombre</legend>
                            <input name="nombre" type="text">
                        </fieldset>
                    </td>
                 <td>
                        <fieldset>
                            <legend>Teléfono</legend>
                            <input name="telefono" type="text">
                        </fieldset>
                    </td>
                </tr>
            </tbody></table>
             <input name="datosn" type="hidden" value="">
             <input type="submit" value="Enviar">
             <input type="hidden" name="tabla" value="<?php echo var_export($tabla,true)?>"/>
           
        </form>
    </div>



</body>
</html>
