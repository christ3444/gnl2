<?php

use App\Models\User;

if (!function_exists('is_admin')) {
    function is_admin($user_id)
    {
        return User::find($user_id)->role->degree > 1;
    }
}

if (!function_exists('generate_random_string')) {
    function generate_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('is_not_empty')) {
    function is_not_empty($collection)
    {
        return is_null($collection) ? false : $collection->isNotEmpty();
    }
}