<?php


namespace Necronru\TypeConverter;


interface ITypeConverter
{
    /**
     * Конвертирует типы данных в массиве на основе схемы данны из класса "контракта"
     *
     * @param      $data   - Массив данных
     * @param      $type   - Класс-контракт. Например UserDto::class
     * @param bool $strict - Строгий режим, все свойства массива отсутсвующие в схеме будут удалены
     *
     * @return mixed
     */
    public function convert(array $data, $type, $strict = true);
}