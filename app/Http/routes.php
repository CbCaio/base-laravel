<?php
/**
* 1. Create a route partial file for each
*    route group; store in 'Http/Routes' folder.
* 3. Add the partial file basename to the
*    partial map.
*/

/** Route Partial Map
=================================================== */

// ORDER MATTERS!
$route_partials = [

    'default',
    'authenticate'

];

/** Route Partial Loadup
=================================================== */

foreach ($route_partials as $partial) {

$file = __DIR__.'/Routes/'.$partial.'.php';

    if ( ! file_exists($file))
{
$msg = "Route partial [{$partial}] not found.";
throw new \Illuminate\Filesystem\FileNotFoundException($msg);
}

require_once $file;
}