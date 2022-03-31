<?php
# Автоматическая загрузка классов, их файлов подключение
spl_autoload_register(function($classname) {
    require_once 'core/' . $classname . '.php';
});

# Логическая функциональность
# $obj = new User();
# Автозагрузчик работает таким образом
# В аргумент $classname будет передено слово User
# Это означает, что в папке core должен лежать файл  User.php
# Так как require_once создает ссылку подключения: core/User.php