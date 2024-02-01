<?php

use App\Models\Message;

if (!function_exists('messagecount')) {
    function messagecount()
    {
        return Message::where('is_read', 0)->count();

    }
}