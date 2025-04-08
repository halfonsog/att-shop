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
    //include 'resources/views/' . $path . '.php';

    // 4. Return the buffered content
    return ob_get_clean();
}

