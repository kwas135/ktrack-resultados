<?php
// exportar.php - genera HTML crudo desde resultados.php

ob_start();
include 'resultados.php'; // tu código original
$html = ob_get_clean();

// Carpeta donde se guardará el HTML listo para GitHub Pages
if(!is_dir('export')) {
    mkdir('export');
}

// Guardar como resultados.html
file_put_contents('export/resultados.html', $html);

echo "Archivo exportado correctamente en export/resultados.html\n";
