<?php
// index.php
// Aplicación PHP sencilla que consume la API pública de clima de Open-Meteo
// Coordenadas por defecto (San José, Costa Rica)
$defaultLat = "9.9281";
$defaultLon = "-84.0907";

// Si el usuario envía otras coordenadas
$lat = isset($_GET['lat']) ? $_GET['lat'] : $defaultLat;
$lon = isset($_GET['lon']) ? $_GET['lon'] : $defaultLon;

// URL de API
$apiUrl = "https://api.openmeteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&current_weather=true";

// Consumir API
$responseJson = @file_get_contents($apiUrl);
$data = null;
$error = null;

if ($responseJson === FALSE) {
    $error = "No se pudo conectar con la API de clima.";
} else {
    $data = json_decode($responseJson, true);
    if ($data === null) {
        $error = "Error al decodificar JSON.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <title>Clima actual - PHP + Docker + Kubernetes</title>
 <style>
 body { font-family: Arial, sans-serif; margin: 20px; }
 .card { border: 1px solid #ccc; padding: 15px; border-radius: 8px; max-width: 400px;}
 label { display: block; margin-top: 10px; }
 input[type="text"] { width: 100%; padding: 5px; }
 button { margin-top: 10px; padding: 8px 12px; }
 </style>
</head>
<body>
 <h1>Clima actual (Open-Meteo)</h1>

 <div class="card">
 <form method="get">
 <label>Latitud:
 <input type="text" name="lat" value="<?php echo htmlspecialchars($lat); ?>">
 </label>
 <label>Longitud:
 <input type="text" name="lon" value="<?php echo htmlspecialchars($lon); ?>">
 </label>
 <button type="submit">Consultar clima</button>
 </form>
 </div>
 <hr>

 <?php if ($error): ?>
     <p style="color:red;"><strong>Error:</strong> <?php echo htmlspecialchars($error); ?></p>
 <?php elseif ($data && isset($data['current_weather'])): ?>
     <?php $current = $data['current_weather']; ?>
     <h2>Resultado</h2>
     <ul>
         <li><strong>Temperatura:</strong> <?php echo $current['temperature']; ?> °C</li>
         <li><strong>Velocidad del viento:</strong> <?php echo $current['windspeed']; ?> km/h</li>
         <li><strong>Dirección del viento:</strong> <?php echo $current['winddirection']; ?>°</li>
         <li><strong>Hora de la lectura:</strong> <?php echo htmlspecialchars($current['time']); ?></li>
     </ul>
 <?php else: ?>
     <p>No hay datos disponibles.</p>
 <?php endif; ?>

</body>
</html>
