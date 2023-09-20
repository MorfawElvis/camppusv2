<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'confirmButtonText' => 'Yes, Delete!',
        'title' => 'Are you sure you want to delete this record?',
        'text' => 'You may not be able to recover this record later!',
        'confirmButtonColor' => '#D50000',
        'cancelButtonColor' => '#0277BD',
        'onCancelled' => 'cancelled',
    ],
];
