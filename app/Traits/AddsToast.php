<?php

namespace App\Traits;

use Request;


trait AddsToast{
    protected function addToast(string $title, string $message, string $type)
    {
        $toast = [
            'title'      => $title,
            'message'    => $message,
            'type'       => $type,
        ];

        request()->session()->flash('toast', $toast);
    }
}
