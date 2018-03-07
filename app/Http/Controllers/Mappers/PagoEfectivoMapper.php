<?php
namespace App\Http\Controllers\Mappers;

use App\Http\Bases\BasePagoEfectivo;

class PagoEfectivoMapper extends BasePagoEfectivo
{
    const MAX_AMOUNT_TX = 30;

    static public function init($data = null)
    {
        if(!is_null($data))
            //Config keys and merchant
            self::config($data['total']);
            self::setMoneda($data['coin']);
            self::setMonto($data['total']);
            self::setConceptoPago($data['paymentConcept']);
            self::setNumeroOrden($data['orderNumber']);
            self::setEmailComercio($data['merchantEmail']);
            self::setFechaExpirar($data['expirationDate']);
            self::setDataAdicional($data['additionalData']);
    }

    static public function config($total){
        $keyLocal = '';
        $url = config("services.pagoefectivo.PE_WSCRYPTA");
        $url2 = config("services.pagoefectivo.PE_WSGENCIP");
        $url3 = config("services.pagoefectivo.PE_WSCRYPTAB");
        $genUrl = config('services.pagoefectivo.PE_GEN');

        //'express';
        $merchant = 'EXP';
        $path = '/../../Keys/keyExpress/';

        //'standard';
        if($total > self::MAX_AMOUNT_TX){
            $merchant = 'JOI';
            $path = '/../../Keys/keyStandard/';
        }
        if(env('APP_ENV') == 'local'){
            $keyLocal = "DEV_";
            $url = config("services.pagoefectivoDev.PE_WSCRYPTA");
            $url2 = config("services.pagoefectivoDev.PE_WSGENCIP");
            $url3 = config("services.pagoefectivoDev.PE_WSCRYPTAB");
            $genUrl = config('services.pagoefectivoDev.PE_GEN');
        }

        self::setCodServicio($merchant);
        self::setSecurityPath(dirname(__FILE__).$path);
        self::setMedioPago("1,2");
        self::setPublicKey($keyLocal.'SPE_PublicKey.1pz');
        self::setPrivateKey($keyLocal.'JOI_PrivateKey.1pz');
        self::setUrl($url);
        self::setUrl2($url2);
        self::setUrl2($url3);
        self::setGenUrl($genUrl);
    }

}