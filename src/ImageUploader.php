<?php

class ImageUploader {
    private const UPLOAD_DIR = __DIR__ . '/../uploads/images/';
    
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif'
    ];
    
    private const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2 Megabytes

    public function __construct() {
        if (!is_dir(self::UPLOAD_DIR)) {
            if (!mkdir(self::UPLOAD_DIR, 0777, true)) {
                throw new Exception("Não foi possível criar o diretório de upload: " . self::UPLOAD_DIR, 500);
            }
        }
    }

    /**
     * Processa o arquivo de upload.
     * @param array $fileData O array $_FILES['nome_do_campo'].
     * @return array Retorna [ 'path' => string, 'message' => string ]
     */
    public function upload(array $fileData): array {
        
        // 1. Verificação básica de erro de upload
        if ($fileData['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erro durante o upload. Código: " . $fileData['error'], 400);
        }
        
        // 2. Validação de segurança e tipo
        if (!in_array($fileData['type'], self::ALLOWED_MIME_TYPES)) {
            throw new Exception("Tipo de arquivo não permitido: " . $fileData['type'], 400);
        }

        if ($fileData['size'] > self::MAX_FILE_SIZE) {
            throw new Exception("O arquivo excede o limite máximo de " . (self::MAX_FILE_SIZE / 1024 / 1024) . "MB.", 400);
        }

        // 3. Geração de Hash (Verificação de Duplicatas e Nome Único)
        $fileHash = $this->generateFileHash($fileData['tmp_name']);
        
        // CORREÇÃO: Converte a extensão para minúsculas para garantir consistência
        $extension = strtolower(pathinfo($fileData['name'], PATHINFO_EXTENSION));
        
        $finalFileName = $fileHash . '.' . $extension;
        $finalPath = self::UPLOAD_DIR . $finalFileName;
        
        // 4. Checagem de Duplicatas (Otimização e Feedback de Duplicata)
        if (file_exists($finalPath)) {
             // O arquivo já existe. Retorna o path existente e uma mensagem específica.
             return [
                 'path' => $this->getPublicPath($finalFileName),
                 'message' => 'Arquivo já existente no servidor. Upload ignorado.'
             ];
        }

        // 5. Movimentação Final do Arquivo (Local seguro)
        if (!move_uploaded_file($fileData['tmp_name'], $finalPath)) {
            throw new Exception("Falha crítica ao mover o arquivo para o destino final.", 500);
        }

        // 6. Retorno do Caminho Público com mensagem de novo upload
        return [
            'path' => $this->getPublicPath($finalFileName),
            'message' => 'Upload concluído com sucesso!'
        ];
    }
    
    private function generateFileHash(string $tempPath): string {
        $hash = hash_file('sha256', $tempPath);
        if ($hash === false) {
             throw new Exception("Falha ao gerar o hash do arquivo.", 500);
        }
        return $hash;
    }
    
    private function getPublicPath(string $fileName): string {
         return '../uploads/images/' . $fileName; 
    }
}
