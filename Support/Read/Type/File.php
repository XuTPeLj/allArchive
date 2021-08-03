<?php

namespace Support\Read\Type;

/**
 * Чтение файла
 *
 * Стандартное чтение файла по строчно
 * @author xutreij@yandex.ru
 */
class File extends AbstractFile
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
        $this->resourceFile = fopen($fileName, 'r');
        return !empty($this->resourceFile);
    }

    /**
     * Читает строку из файла
     * @return false|string
     */
    function read(): bool|string
    {
        return fgets($this->resourceFile);
    }

    /**
     * Проверяет, достигнут ли конец файла
     * @return bool
     */
    function isEnd(): bool
    {
        return feof($this->resourceFile);
    }

    /**
     * Закрывает открытый дескриптор файла
     * @return void
     */
    function close(): void
    {
        if (!empty($this->resourceFile))
            fclose($this->resourceFile);
    }

    function __destruct()
    {
        $this->close();
    }
}