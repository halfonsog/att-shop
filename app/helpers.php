<?php

function base_url($path = '')
{
    return '/att-shop/public/' . ltrim($path, '/');
}

function asset($path)
{
    return base_url(ltrim($path, '/'));
}


