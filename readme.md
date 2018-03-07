<p align="center">
<img src="https://laravel.com/assets/img/components/logo-laravel.svg">
<img src="http://s3.cybermondayperu.pe.s3-us-west-2.amazonaws.com/media/logos/pago-efectivo_1.png">
</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Pago Efectivo (PHP7.2) + Laravel (5.6)

Este es un proyecto que contiene únicamente la integración del servicio de: PagoEfectivo Standard y Express. No tiene ningún fin lucrativo
tampoco asume alguna alianza con "pagoefectivo" es un proyecto PHP OPEN SOURCE.

- [¿Qué es PAGOEFECTIVO?](http://pagoefectivo.pe/medios-de-pago/).
- [¿Qué es un código CIP?](http://blog.pagoefectivo.pe/empresas/codigo-de-pago-cip/).

Las capas de código con las que se realizó el proyecto no necesariamente se apega al framework, podría usted probarlo
en cualquier otro framework php. 


## Requisitos
- Debe tener una Ip fija pública (integración y producción).
- Usted debe tener una cuenta de empresa con Pago Efectivo.
- Usted debe tener las llaves asignadas a su negocio.
- Su servidor debe tener php 7.0+.
- Su servidor debe poder consumir webservices SOAP. 

## Proyecto
- Ofrece los servicios de PAGO EFECTIVO EXPRESS y STANDARD, basados en la configuración de monto minimo y máximo de pago.
- Tiene la configuración de dos entornos: Desarrollo y producción la variante se encuentra env('APP_ENV')
- Registro de log's para las excepciones. 

## Configuración
- Llaves del negocio.
<p align="center">
<img src="https://image.ibb.co/gvse8S/Captura_de_pantalla_2018_03_07_a_la_s_09_00_25.png">
</p>
- Configurar las rutas y variantes de pagoefectivo (app/config/services/) encontrarás dos arrays: 
pagoefectivoDev (para el entorno de desarrollo), pagoefectivo (para el entorno de producción).

## Respuesta final
<p align="center">
<img src="https://image.ibb.co/fGvXTS/Captura_de_pantalla_2018_03_07_a_la_s_10_26_16.png">
</p>

## Autoria
Si tiene usted algún aporte, consulta o critica podría contactarse conmigo a: [juangonzaq@gmail.com](mailto:juangonzaq@gmail.com), 
o a cualquiera de mis redes sociales [instagram, facebook, twitter: @juangonzaq]. 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
