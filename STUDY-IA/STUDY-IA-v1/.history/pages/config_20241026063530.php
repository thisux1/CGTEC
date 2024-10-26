<?php
define('BASE_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
define('IMAGES_PATH', BASE_PATH . '/images');
define('WEB_IMAGES_PATH', '/images'); // Caminho para uso em URLs
php>
<?php
// Definir o caminho base do projeto (coloque isso no início do seu arquivo de configuração)
define('BASE_PATH', realpath($_SERVER['DOCUMENT_ROOT']));
define('IMAGES_PATH', BASE_PATH . '/images');
define('WEB_IMAGES_PATH', '/images'); // Caminho para uso em URLs

function getImagePath($imageName, $defaultImage = 'fotoPerfil.png') {
    // Array com possíveis locais da imagem (do mais específico para o mais geral)
    $possiblePaths = [
        IMAGES_PATH . '/perfil/' . $imageName,
        IMAGES_PATH . '/' . $imageName,
    ];
    
    // Procura a imagem nos caminhos possíveis
    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            // Converte o caminho do sistema em URL relativa
            $relativePath = str_replace(BASE_PATH, '', $path);
            return htmlspecialchars($relativePath . '?t=' . time());
        }
    }
    
    // Retorna a imagem padrão se nenhuma for encontrada
    return WEB_IMAGES_PATH . '/' . $defaultImage;
}

// Exemplo de uso no seu cabeçalho
function renderProfileImage($imagemPerfil = null) {
    $imagePath = !empty($imagemPerfil) ? getImagePath($imagemPerfil) : getImagePath('fotoPerfil.png');
    echo '<img class="imagem1" src="' . $imagePath . '" alt="perfil">';
}
?>