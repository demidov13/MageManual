<?php
/**
 * в него передается HttpRequest после валидации 
 * и он создает на основе этот объекта экземпляр объекта Package.php
 * Вытягивает getUri, парсит ее, получает данные в массив params:
 * version = 1, command = deleteProduct, json или xml в body переделывает в массив.
 */