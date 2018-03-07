<?php
return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'pagoefectivoDev' => [
        //Configuracion de entorno
        'PE_SERVER'   => 'https://pre1a.pagoefectivo.pe/',

        //Rutas de Webservices
        'PE_WSCRYPTA' => 'https://pre1a.pagoefectivo.pe/PagoEfectivoWSCrypto/WSCrypto.asmx?wsdl',
        'PE_WSGENPAGO'=> 'https://pre1a.pagoefectivo.pe/GenPago.aspx',
        'PE_WSGENPAGOIFRAME' => 'https://pre1a.pagoefectivo.pe/GenPagoIF.aspx',
        'PE_GEN' => 'http://pre1a.pagoefectivo.pe/GenPago.aspx',

        //Para las modalidades
        'PE_WSGENCIP'  => 'https://pre1a.pagoefectivo.pe/PagoEfectivoWSGeneralv2/service.asmx?wsdl',
        'PE_WSCRYPTAB' => 'https://pre1a.pagoefectivo.pe/pasarela/pasarela/crypta.asmx?wsdl',

        //Configuracion de cuenta
        'PE_EMAIL_PORTAL'   => 'juangonzaq@gmail.com',
        'PE_EMAIL_CONTACTO' => 'juangonzaq@gmail.com',

        //Expiracion en Horas del codigo
        'PE_TIEMPO_EXPIRACION' => '5',

        //Nombre del portal para el concepto de Pago que acompaña al numero de pedido en el banco
        'PE_COMERCIO_CONCEPTO_PAGO' => 'CHECKOUT',

        //El dominio de pruebas o produccion al que solicitaron permisos por IP
        'PE_DOMINIO_COMERCIO' => 'https://tunegocio.com/',

        //Colocar la url de información
        'PE_URL_POPUP' => 'https://pre1a.pagoefectivo.pe/CNT/QueEsPagoEfectivo.aspx',

        // 1: Soles 2: Dolares
        'PE_MONEDA'     => '1',
        'PE_MEDIO_PAGO' => '1,2',
        'PE_MOD_INTEGRACION' => '1'
    ],

    'pagoefectivo' => [
        //Configuracion de entorno
        'PE_SERVER'   => 'https://cip.pagoefectivo.pe/',

        //Rutas de Webservices
        'PE_WSCRYPTA' => 'https://cip.pagoefectivo.pe/PagoEfectivoWSCrypto/WSCrypto.asmx?wsdl',
        'PE_WSGENPAGO'=> 'https://cip.pagoefectivo.pe/GenPago.aspx',
        'PE_WSGENPAGOIFRAME' => 'https://cip.pagoefectivo.pe/GenPagoIF.aspx',
        'PE_GEN' => 'https://cip.pagoefectivo.pe/GenPago.aspx',

        //Para las modalidades
        'PE_WSGENCIP'  => 'https://cip.pagoefectivo.pe/PagoEfectivoWSGeneralv2/service.asmx?wsdl',
        'PE_WSCRYPTAB' => 'https://cip.pagoefectivo.pe/pasarela/pasarela/crypta.asmx?wsdl',

        //Configuracion de cuenta
        'PE_EMAIL_PORTAL'   => 'juangonzaq@gmail.com',
        'PE_EMAIL_CONTACTO' => 'juangonzaq@gmail.com',

        //Expiracion en Horas del codigo
        'PE_TIEMPO_EXPIRACION' => '5',

        //Nombre del portal para el concepto de Pago que acompaña al numero de pedido en el banco
        'PE_COMERCIO_CONCEPTO_PAGO' => 'CHECKOUT',

        //El dominio de pruebas o produccion al que solicitaron permisos por IP
        'PE_DOMINIO_COMERCIO' => 'https://tunegocio.com/',

        //Colocar la url de información
        'PE_URL_POPUP' => 'https://cip.pagoefectivo.pe/CNT/QueEsPagoEfectivo.aspx',

        // 1: Soles 2: Dolares
        'PE_MONEDA'     => '1',
        'PE_MEDIO_PAGO' => '1,2',
        'PE_MOD_INTEGRACION' => '1'
    ]

];
