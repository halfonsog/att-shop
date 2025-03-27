<?php

function att_shop_base_url($path = '')
{
    return '/att-shop/' . ltrim($path, '/');
}

function view_include($path, $data = []) {
    // 1. Extract array to variables
    extract($data);
    
    // 2. Start output buffering (captures included content)
    ob_start();
    
    // 3. Include the file with the extracted variables
    include $_SERVER['DOCUMENT_ROOT'] . '/att-shop/resources/views/' . $path . '.php';
    
    // 4. Return the buffered content if needed
    return ob_get_clean();
}

function currentUser() {
    if (!isset($_SESSION['user'])) return null;
    
    // Get basic info from session
    $user = $_SESSION['user'];
    
    // Fetch additional details from DB if needed
    $entity= (array) DB::selectOne("SELECT * FROM {$user['usr_type']}s WHERE id = ?", [$user['ent_id']]);

    return array_merge($user, $entity);
/*    
    global $pdo;  // Your DB connection
    $stmt = $pdo->prepare("SELECT * FROM {$user['usr_type']}s WHERE id = ?");
    $stmt->execute([$user['ent_id']]);
    
    return array_merge($user, $stmt->fetch(PDO::FETCH_ASSOC) ?: []);
*/    
}