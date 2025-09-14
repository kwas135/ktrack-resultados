<?php
// exportar.php - genera HTML crudo desde resultados.php y agrega meta-refresh

ob_start();
include 'resultados.php'; // tu código original
$html = ob_get_clean();

// Agregar meta-refresh cada 2 minutos al <head>
$pattern = '/<head>(.*?)<\/head>/is';
$replacement = '<head>$1' . PHP_EOL . '    <meta http-equiv="refresh" content="120">' . PHP_EOL . '</head>';
$html = preg_replace($pattern, $replacement, $html);

// Guardar directamente en la carpeta del repo (ktrack-resultados)
file_put_contents(__DIR__ . '/resultados.html', $html);

echo "Archivo exportado correctamente en resultados.html con refresh cada 2 minutos\n";