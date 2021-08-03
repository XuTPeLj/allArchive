<?php

namespace Support\Read;

use Support\Read\Type\AbstractFile;
use Support\Read\Type\File;
use Support\Read\Type\GzFile;
use Support\Read\Type\ZipFile;


/**
 * Чтение файла
 *
 * Стандартное чтение файла по строчно
 * @author xutreij@yandex.ru
 */
class ContentFile
{
    private AbstractFile $fileProvider;

    /**
     * Открывает файл
     *
     * @param $fileName string Путь к файлу
     * @return bool
     */
    function open(string $fileName): bool
    {
        $fileExpansion = pathinfo($fileName, PATHINFO_EXTENSION);

        if ($fileExpansion == 'zip') {
            $this->fileProvider = new ZipFile();
        } elseif ($fileExpansion == 'gz') {
            $this->fileProvider = new GzFile();
        } else {
            $this->fileProvider = new File();
        }

        if (!empty($this->fileProvider)) {
            $this->fileProvider->open($fileName);
        }

        return !empty($this->fileProvider);
    }

    /**
     * Читает строку из файла
     * @return false|string
     */
    function read(): bool|string
    {
        return $this->fileProvider->read();
    }

    /**
     * Проверяет, достигнут ли конец файла
     * @return bool
     */
    function isEnd(): bool
    {
        return $this->fileProvider->isEnd();
    }

    /**
     * Закрывает открытый файла
     * @return void
     */
    function close(): void
    {
        $this->fileProvider->close();
    }
}