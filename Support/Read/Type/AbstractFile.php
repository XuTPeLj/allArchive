<?php

namespace Support\Read\Type;

/**
 * Чтение файла
 *
 * @author xutreij@yandex.ru
 */
abstract class AbstractFile
{
    /**
     * Открывает файл
     *
     * @param $fileName string Путь к файлу
     * @return bool
     */
    abstract function open(string $fileName): bool;

    /**
     * Читает строку из файла
     * @return bool|string
     */
    abstract function read(): bool|string;

    /**
     * Проверяет, достигнут ли конец файла
     * @return bool
     */
    abstract function isEnd(): bool;

    /**
     * Закрывает файл
     * @return void
     */
    abstract function close(): void;
}