<?php
/**
 * Перед своей работой должен проверить, пришло ли в резалте true (найдены ли ошибки в списке).
 * Если нет - отдать Exeption.
 * Когда http request validator получил Result и понял, что там что-то не так, он закидывает объект Result
 * в эту фабрику, она создает объект Output/Erorrs.php, вытягивает из Result ошибки getError,
 * помещает их в Entity, расположенное внутри метода Errors.php, вызывает метод эррора send()
 * и отдает его наверх в качестве ответа, который даст экшн.
 */