<?php

namespace Support\Read\Type;

/**
 * Чтение файла ZIP
 *
 * Чтение ZIP файла по строчно
 * @author xutreij@yandex.ru
 */
class ZipFile extends AbstractFile
{
    protected $resourceArchive;
    protected $resourceFile;
    protected bool $isEnd_ = true;

    /**
     * Открывает файл
     *
     * @param $fileName string Путь к файлу
     * @return bool
     */
    function open(string $fileName): bool
    {
        if ($this->resourceArchive = zip_open($fileName)) {
            $this->resourceFile = zip_read($this->resourceArchive);
        }
        if (!empty($this->resourceFile)) {
            $this->isEnd_ = false;
        }
        return !empty($this->resourceFile);
    }

    /**
     * Читает строку из файла
     * @return false|string
     */
    function read(): bool|string
    {
        $string = '';
        while (1) {
            $char = zip_entry_read($this->resourceFile, 1);
            if ($char == "\r")
                continue;
            if ($char == '') {
                $this->isEnd_ = true;
                break;
            }
            if ($char == "\n")
                break;
            $string .= $char;
        }
        if ($string == '' && $this->isEnd_)
            return false;
        return $string;
    }

    /**
     * Проверяет, достигнут ли конец файла
     * @return bool
     */
    function isEnd(): bool
    {
        return $this->isEnd_;
    }

    /**
     * Закрывает открытый дескриптор файла
     * @return void
     */
    function close(): void
    {
        if (!empty($this->resourceFile))
            zip_entry_close($this->resourceFile);
        if (!empty($this->resourceArchive))
            zip_close($this->resourceArchive);
    }

    function __destruct() {
        $this->close();
    }
}