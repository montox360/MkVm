<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!--<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/mkapps.css" media="screen" />
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <title>MK Oposiciones!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <script src="js/oposiciones_nacional_ajax.js"></script>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <div class="container">
        <form action="./MkOppNac.php" method="POST" role="form">
            <legend>RATIFICACION DE OPOSICION - NACIONAL</legend>
            <div class="form-group">
                <label style="padding-top: 10px">
                        <label for"">Numero de Boletin:</label><br>
                        <select name="boletin" id="boletin">
                        <option value='' selected></option>
                            <?php 
                                include_once 'funciones/funciones_base.php';
                                $conexion = ConectToDatabase();
                                $results = Consulta_Boletines($conexion);
                                echo "";
                                while (!$results->EOF){
                                    if(isset($_POST['boletin'])){
                                        if($_POST['boletin'] == $results->Fields('Numero')->value){
                                        echo "<option value=".$results->Fields('Numero')->value." selected>".$results->Fields('Numero')->value."</option>";
                                        }
                                        else{
                                            echo "<option value=".$results->Fields('Numero')->value.">".$results->Fields('Numero')->value."</option>";
                                        }
                                        }
                                        else{
                                        echo "<option value=".$results->Fields('Numero')->value.">".$results->Fields('Numero')->value."</option>";}
                                        $results->MoveNext(); 
                                    }
                                cerrar_conexiones($conexion, $results);
                            ?>
                        </select>
                    </label><br>
                    <label>
                    <label>Introduzca vencimiento de Boletin</label><br>
                        <input type="text" name="vencimiento" <?php if(isset($_POST['vencimiento']))
                        {echo "value=\"".$_POST['vencimiento']."\"";}
                        ?>
                    >
                    </label><br>
               
               
                <div class="radio">
                    <label>
                        <input type="radio" name="reporte" id="input" value="1" <?php if(isset($_POST['reporte']) && $_POST['reporte']==1)echo "checked=\"checked\";"?>>
                        Reporte
                    </label>
                    <label>
                        <input type="radio" name="reporte" disabled class=generar_cartas id="input"  value="2" <?php if(isset($_POST['reporte']) && $_POST['reporte']==2)echo "checked=\"checked\";"?>>
                        Enviar Correos
                    </label>
                </div>
            </div>
            <div class="actions">
                <!--<button type="submit" class="btn btn-primary aceptar">Aceptar</button>-->
                <button class="btn btn-primary aceptar">Aceptar</button>
            </div>
        </form>
        </div>
        <div id="divLoading"></div>

<?php if(isset($_POST['reporte'])&& $_POST['reporte']==1 && isset($_POST['boletin']) && $_POST['boletin'] != '')
        {            
            $conexion = ConectToDatabase();
            echo "<div class=\"tabla_contenedor\">";
            
            oposiciones_onscreen_nacional($conexion, $_POST['boletin']);
            echo "</div>";
            //correos_exterior_ingles();
        }
?>
    </body>
    </html>