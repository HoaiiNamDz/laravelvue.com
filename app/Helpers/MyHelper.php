<?php

if (!function_exists('loadClass')) {
    function loadClass($model, $folder = 'Repositories', $interface = 'Repository')
    {
        $serviceInterfaceNamespace = '\App\\' . $folder . '\\' . ucfirst($model) . $interface;

        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        return $serviceInstance;
    }
}
