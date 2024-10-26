<?php
class StudyIAPathResolver {
    private static function getDepth($scriptPath) {
        // Remove o caminho base até STUDY-IA-v1/pages
        $basePath = 'STUDY-IA-v1/pages/';
        $pos = strpos($scriptPath, $basePath);
        if ($pos === false) return 0;
        
        $relativePath = substr($scriptPath, $pos + strlen($basePath));
        return substr_count($relativePath, '/');
    }
    
    public static function resolveImagePath($imagemPerfil = null) {
        // Pega o caminho do script atual
        $scriptPath = $_SERVER['SCRIPT_FILENAME'];
        $depth = self::getDepth($scriptPath);
        
        // Constrói o prefixo do caminho com base na profundidade
        $prefix = str_repeat('../', $depth);
        
        if (isset($imagemPerfil) && !empty($imagemPerfil)) {
            // Verifica se a imagem existe no diretório uploads/perfil
            $imagePath = $prefix . 'uploads/perfil/' . $imagemPerfil;
            if (file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $imagePath)) {
                return '<img class="imagem1" src="' . htmlspecialchars($imagePath . '?t=' . time()) . '" alt="perfil">';
            }
        }
        
        // Retorna a imagem padrão se nenhuma imagem for encontrada ou especificada
        return '<img class="imagem1" src="' . $prefix . 'images/fotoPerfil.png" alt="perfil">';
    }
}

// Debug information
echo "<pre>";
echo "Script atual: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "Profundidade: " . StudyIAPathResolver::getDepth($_SERVER['SCRIPT_FILENAME']) . "\n";
echo "Pasta base encontrada: " . (strpos($_SERVER['SCRIPT_FILENAME'], 'STUDY-IA-v1/pages/') !== false ? 'Sim' : 'Não') . "\n";
echo "Caminho relativo após pages/: " . substr($_SERVER['SCRIPT_FILENAME'], strpos($_SERVER['SCRIPT_FILENAME'], 'STUDY-IA-v1/pages/') + strlen('STUDY-IA-v1/pages/')) . "\n";
echo "</pre>";

// Função de uso
function renderProfileImage($imagemPerfil = null) {
    echo StudyIAPathResolver::resolveImagePath($imagemPerfil);
}
?>