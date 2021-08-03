<?php

include 'loader.php';

use Support\Read\ContentFile;

$arrayFiles = [
    'file.txt',
    'file.gz',
    'file.zip',
    'file.bz2',
];

$file = new ContentFile();

foreach ($arrayFiles as $fileName) {
    echo $fileName, "\n";
    if (!$file->open(__DIR__ . "/file/$fileName")) {
        echo 'Не смогли открыть', "\n";
    };

    while (!$file->isEnd()) {
        echo $file->read(), "\n";
    }
}
