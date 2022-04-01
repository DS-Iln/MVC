<?php

Route::get('/', [MainController::class, 'index']);
Route::get('/test', function() {
    return 'Моя первая тестовая callable функция';
});