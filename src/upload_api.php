<?php
require_once 'ImageUploader.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST, OPTIONS');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$response = ['success' => false, 'data' => null, 'error' => ''];

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($method !== 'POST') {
    http_response_code(405);
    $response['error'] = 'Método não permitido. Esperado POST.';
    echo json_encode($response);
    exit;
}

if (empty($_FILES['profile_image'] ?? null)) {
    http_response_code(400);
    $response['error'] = 'Nenhum arquivo encontrado no campo "profile_image".';
    echo json_encode($response);
    exit;
}

try {
    $uploader = new ImageUploader();
    $fileData = $_FILES['profile_image'];
    
    // O retorno agora contém { path: '...', message: '...' }
    $uploadResult = $uploader->upload($fileData);
    
    $response['success'] = true;
    $response['data'] = [
        'url' => $uploadResult['path'],
        'message' => $uploadResult['message'] // Pega a mensagem do uploader (novo ou duplicado)
    ];

} catch (Exception $e) {
    $code = $e->getCode() ?: 500;
    http_response_code($code);
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

echo json_encode($response);
