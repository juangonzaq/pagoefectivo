<?php

Route::group(['prefix' => 'pagoefectivo'], function () {
   Route::get('/', 'PagoEfectivoController@run');
});
