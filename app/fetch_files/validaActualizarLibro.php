<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //se validan los campos del formulario
    $band['titulo']     = ($_POST['titulo'] != null) &&($_POST['titulo'] != "");
    $band['area']       = (isset($_POST['area'])) && ($_POST['area']>=1) && ($_POST['area']<=5);
    $band['descripcion']= (strlen($_POST['descripcion']) <= 50);
    $band['precio']     = ($_POST['precio'] != null) && ($_POST['precio'] != "") && (is_numeric(str_replace(",","",$_POST['precio']))) && (strlen(str_replace(",","",$_POST['precio'])) <=4);
    $band['edo_libro']  = (isset($_POST['edo_libro'])) && ($_POST['edo_libro']>=1) && ($_POST['edo_libro']<=3);

    //validación del File
    $MAX_SIZE = 5000000;
    $allowed_mime_type_arr = array('jpeg','png','jpg');
    //Nota: En fetch no funciona get_mime_by_extension()
    
    $arrayAux = explode('.', $_FILES['foto']['name']);
    $mime = end($arrayAux); //obtiene la extensión del file
    //se checa si se cumplen todas las condiciones para un file correcto
    if((isset($_FILES['foto']['name'])) && ($_FILES['foto']['name']!="") && ($_FILES['foto']['size']<=$MAX_SIZE)){
        if(in_array($mime, $allowed_mime_type_arr)){
            $band['foto'] = true;
        }else{
            $band['foto'] = false;
        }
    }else{
        $band['foto'] = false;
    }

    if (!isset($_FILES['foto']['name']) || $_FILES['foto']['name']=="") {
        $band['foto'] = true;   //no es obligatorio que actualice la foto del libro
    }

    echo json_encode($band);
}
?>