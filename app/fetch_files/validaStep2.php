<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //array de retorno para correo y captcha
  $returnData['captcha'] = false;
  $returnData['correo'] = false;
  $returnData['passwd1'] = false; //longitud de la contraseña
  $returnData['passwd2'] = false; //coincidencia de contraseñas
  $returnData['tipoCuenta'] = false; //coincidencia de contraseñas

  //VALIDACIÓN CAPTCHA 
    // Creamos el enlace para solicitar la verificación con la API de Google.
    $params = array();  // Array donde almacenar los parámetros de la petición
    $params['secret'] = '6LcLefUUAAAAALYKeJhUZrvBeEcyDUKjjkgekW8x'; // Clave privada
    if (!empty($_POST) && isset($_POST['g-recaptcha-response'])) {
      $params['response'] = urlencode($_POST['g-recaptcha-response']);
    }
    $params['remoteip'] = $_SERVER['REMOTE_ADDR'];
    // Generar una cadena de consulta codificada estilo URL
    $params_string = http_build_query($params);
    // Creamos la URL para la petición
    $requestURL = 'https://www.google.com/recaptcha/api/siteverify?' . $params_string;
    // Inicia sesión cURL
    $curl = curl_init(); 
    // Establece las opciones para la transferencia cURL
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $requestURL,
    ));
    // Enviamos la solicitud y obtenemos la respuesta en formato json
    $response = curl_exec($curl);
    // Cerramos la solicitud para liberar recursos
    curl_close($curl);

    //se decodifica el json para obtener la respuesta (en caso de ser unica validacion se puede omitir este paso y enviar la respuesta de arriba)
    $response = json_decode($response);
    //respuesta del captcha
    $returnData['captcha'] = $response->success;

  //VALIDACIÓN CORREO
    $correo = $_POST['correo'];
    $conexion = mysqli_connect("localhost","root","");
    mysqli_select_db( $conexion, "books_buap" ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
    mysqli_set_charset($conexion, "utf8");  //Establecer recuperacion de info en utf8 para acentos y tildes
    
    $claveSQL = "books_buap_12321";
    $sql = "SELECT correo 
            from usuario 
            WHERE correo = '$correo'
            ;";
    $result = mysqli_query($conexion,$sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    mysqli_close($conexion);


    if (!$data) {
      $returnData['correo'] = true;
    }

    //VALIDACIÓN CONTRASEÑAS
    if (strlen($_POST['pass1']) >= 6) { //longitud de contraseña
      $returnData['passwd1'] = true;
    }
    if ($_POST['pass1'] == $_POST['pass2']) { //coincidencia de contraseñas
      $returnData['passwd2'] = true;
    }

    //VALIDACIÓN TIPO CUENTA
    if (isset($_POST['tipoCuenta'])) {
      $returnData['tipoCuenta'] = true;
    }

    // Devuelve la respuesta en formato JSON
    //echo $response;
    echo json_encode($returnData);
}
?>