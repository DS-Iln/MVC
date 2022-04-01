<?php

class Route
{
    private static function router($method, $uri) {
        # Проверяем соответсвует ли запрос методу который отправляется
        if($_SERVER['REQUEST_METHOD'] !== $method) return true;
        # Если придет ссылка вида: /register?id=29
        # Explode => ['/register', 'id=29']
        # [0] == ['/register']
        $url = explode('?', $_SERVER['REQUEST_URI'])[0];
        return ($url != $uri);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        # Присваеваем ссылку из первого аргумента
        $uri = $arguments[0];
        # Присваеваем контроллер или callback функцию
        $controller = $arguments[1];
        # Делаем буквы заглавными
        $name = strtoupper($name);

        # Проверка адрес и метода на не соотвествие
        if(self::router($name, $uri)) return;

        # Проверяем является ли аргумент переменной $controller callable функцией
        if(is_callable($controller)) {
            echo $controller();
            return;
        }

        # Проверяем является ли аргумент переменной $controller массивом
        # Сюда должен прийти массив вида: ['НазваниеКласса', 'НазваниеМетодаДанногоКласса']
        if(is_array($controller)) {
            $classController = new $controller[0]();
            $nameMethod = $controller[1];
            echo $classController->$nameMethod();
            return;
        }
    }
}