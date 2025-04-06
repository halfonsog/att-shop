<?php

function att_shop_base_url($path = '')
{
    return '/' . ltrim($path, '/');
}

function view_include($path, $data = []) {
    // 1. Extract array to variables
    extract($data);
    
    // 2. Start output buffering
    ob_start();
    
    // 3. Use Laravel's base path instead of DOCUMENT_ROOT
    include base_path('resources/views/' . $path . '.php');
    
    // 4. Return the buffered content
    return ob_get_clean();
}

function currentUser() {
    if (!isset($_SESSION['user'])) return null;
    
    // Get basic info from session
    $user = $_SESSION['user'];
    
    // Fetch additional details from DB if needed
    $entity= (array) DB::selectOne("SELECT * FROM {$user->role}s WHERE id = ?", [$user->ent_id]);  // [$user['ent_id']]);

    return array_merge($user, $entity);
/*    
    global $pdo;  // Your DB connection
    $stmt = $pdo->prepare("SELECT * FROM {$user['usr_type']}s WHERE id = ?");
    $stmt->execute([$user['ent_id']]);
    
    return array_merge($user, $stmt->fetch(PDO::FETCH_ASSOC) ?: []);
*/    
}