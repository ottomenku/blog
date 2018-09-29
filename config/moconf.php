<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application template
    |--------------------------------------------------------------------------
    */
   // 'template' => env('Template', 'Bootstrap3.dashgum'),
    'tmpl' => env('TMPL', 'libro'),

    /*
    |--------------------------------------------------------------------------
    | Admin template
    |--------------------------------------------------------------------------
    */

    'admintmpl' => env('ADMIN_TMPL', 'Bootstrap3.dashgum'),

    /*
    |--------------------------------------------------------------------------
    | Admin includes
    |--------------------------------------------------------------------------
    | innen csatolja be több templateben isa használhatóü fileokat (form,table, show)
    */

    'includes' => env('INCLUDES', 'Bootstrap3.includes.blog'),


];
