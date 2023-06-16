#!/usr/bin/php
<?php
declare(strict_types=1);

require_once '../../vendor/autoload.php';

for($i = 0; $i < 10; $i++) {
    print "Hello, world!\n";
    sleep(1);
}