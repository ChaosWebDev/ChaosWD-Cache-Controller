<?php

require(__DIR__ . '/../vendor/autoload.php');

use Order\Controller\CacheController;

$cache = new CacheController(__DIR__ . "/cache");

load($cache);

function save($cache, $content)
{
    echo "SAVING!!<br><br>";
    $cache->save("index", $content, 20);
    return;
}

function load($cache)
{
    echo "LOADING<br><br>";
    $loadedCache = $cache->load("index");
    if ($loadedCache[0] == "true") {
        echo "Loaded Cache<br><br>";
        echo $loadedCache[1];
    } else {
        echo "Manually Get Content for Display<br><br>";
        $content = file_get_contents("content.txt");
        save($cache, $content);
    }
    return;
}
