<!DOCTYPE html>

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
    
    if (isset($_REQUEST['tablaT'])) {
        $tablaT = explode(";", $_REQUEST['tablaT']);
     
    } else {
        $tablaT = array();
    }

    
    if (isset($_REQUEST['tablaN'])) {
        $tablaN = explode(";", $_REQUEST['tablaN']);
        //función
        $encontrado = false;
        if (!empty(($_REQUEST['nombre']))){
        for ($i = 0 ; $i < count($tablaN) ; $i++) {
            if ($_REQUEST['nombre']==$tablaN[$i]){
                if ($_REQUEST['telefono']=="") {
                    unset($tablaN[$i]);
                    unset($tablaT[$i]);
                }else{
                    $tablaT[$i] = $_REQUEST['telefono'];
                }
                $encontrado=true; //
                break;
            }
        }
        if (!$encontrado && $_REQUEST['telefono']!=""){
            $tablaN[] = $_REQUEST['nombre'];
            $tablaT[] = $_REQUEST['telefono'];
        }
    }else{
        echo "te falta el nombre";
    }
        

    } else {
        $tablaN = array();
    }
        
    if (count($tablaN) > 0) {
        echo "<table border=1>";
        echo "<tr><td>Nombres</td><td>Teléfono</td></tr>";
        foreach ($tablaT as $c => $v){
            if ($tablaN[$c] != "") {
                echo "<tr><td>$tablaN[$c]</td>";
                echo "<td>$tablaT[$c]</td></tr>";
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
             <input type="hidden" name="tablaN" value="<?php echo implode(";",$tablaN)?>"/>
             <input type="hidden" name="tablaT" value="<?php echo implode(";",$tablaT)?>"/>
           
        </form>
    </div>



</body>
</html>
