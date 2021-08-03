<?php

namespace Support\Read\Type;

/**
 * Чтение файла GZ
 *
 * Чтение gz файла по строчно
 * @author xutreij@yandex.ru
 */
class GzFile extends AbstractFile
{
    protected $resourceFile;

    /**
     * Открывает файл
     *
     * @param $fileName string Путь к файлу
     * @return bool
     */
    function open(string $fileName): bool
    {
        $this->resourceFile = gzopen($fileName, 'r');
        return !empty($this->resourceFile);
    }

    /**
     * Читает строку из файла
     * @return false|string
     */
    function read(): bool|string
    {
        return gzgets($this->resourceFile);
    }

    /**
     * Проверяет, достигнут ли конец файла
     * @return bool
     */
    function isEnd(): bool
    {
        return gzeof($this->resourceFile);
    }

    /**
     * Закрывает открытый дескриптор файла
     * @return void
     */
    function close(): void
    {
        if (!empty($this->resourceFile))
            gzclose($this->resourceFile);
    }

    function __destruct()
    {
        $this->close();
    }
}