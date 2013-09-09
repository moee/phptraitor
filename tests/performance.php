<?php

/**
 * This is a simple file that runs the setter and getter in a loop.
 * This is useful to find performance bottlenecks with Xdebug.
 */

require '../vendor/autoload.php';

$memory = memory_get_usage(true);

use Traitor\GetSet\Simple;

class SimpleGetterSetter
{
    use \Traitor\GetSet;
    /**
     * @Simple
     */
    private $name;
}

$iterations = 500;

$getSet = new SimpleGetterSetter();

$start = microtime(true);

for ($i = 0; $i < $iterations; $i++) {
    $getSet->setName("name");
    $getSet->getName();
}

$end = microtime(true);
$time = $end-$start;
$sec = $time;

echo sprintf("runtime: %f s (= %f/s)\n", $sec, $iterations/$sec);
echo sprintf(
    "memory: %f, peak usage: %f\n",
    (memory_get_usage(true) - $memory) / 1024,
    memory_get_peak_usage(true) / 1024
);