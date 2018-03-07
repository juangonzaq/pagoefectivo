<?php
/**
 * Created by Juan Carlos Gonzales Q.
 * Email: juangonzaq@gmail.com
 */
namespace App\Http\Bases;

use Illuminate\Http\Response;

abstract class BasePagoEfectivo
{
    /**
     * @var PagoEfectivo
     */
    static public $_moneda;
    static public $_monto;
    static public $_medio_pago;
    static public $_concepto_pago;
    static public $_cod_servicio;
    static public $_numero_orden;
    static public $_email_comercio;
    static public $_fecha_expirar;
    static public $_data_adicional;
    static public $_publicKey;
    static public $_privateKey;
    static public $_securityPath;

    static public $_usuario_id;
    static public $_usuario_nombre;
    static public $_usuario_apellidos;
    static public $_usuario_localidad;
    static public $_usuario_provincia;
    static public $_usuario_pais;
    static public $_usuario_alias;
    static public $_usuario_tipodocumento;
    static public $_usuario_numerodocumento;
    static public $_usuario_email;

    /**
     * urls
     */
    static public $genUrl;
    static public $url;
    static public $url1;
    static public $url2;
    static public $url3;
    static public $url4;

    /**
     * @var Response
     */
    static public $iframe;
    static public $message;
    static public $success;
    static public $status;
    static public $expiration;

    /**
     * @return mixed
     */
    public static function getGenUrl()
    {
        return self::$genUrl;
    }

    /**
     * @param mixed $genUrl
     */
    public static function setGenUrl($genUrl)
    {
        self::$genUrl = $genUrl;
    }

    /**
     * @return mixed
     */
    public static function getUrl()
    {
        return self::$url;
    }

    /**
     * @param mixed $url
     */
    public static function setUrl($url)
    {
        self::$url = $url;
    }

    /**
     * @return mixed
     */
    public static function getUrl1()
    {
        return self::$url1;
    }

    /**
     * @param mixed $url1
     */
    public static function setUrl1($url1)
    {
        self::$url1 = $url1;
    }

    /**
     * @return mixed
     */
    public static function getUrl2()
    {
        return self::$url2;
    }

    /**
     * @param mixed $url2
     */
    public static function setUrl2($url2)
    {
        self::$url2 = $url2;
    }

    /**
     * @return mixed
     */
    public static function getUrl3()
    {
        return self::$url3;
    }

    /**
     * @param mixed $url3
     */
    public static function setUrl3($url3)
    {
        self::$url3 = $url3;
    }

    /**
     * @return mixed
     */
    public static function getUrl4()
    {
        return self::$url4;
    }

    /**
     * @param mixed $url4
     */
    public static function setUrl4($url4)
    {
        self::$url4 = $url4;
    }


    /**
     * @return mixed
     */
    public static function getPublicKey()
    {
        return self::$_publicKey;
    }

    /**
     * @param mixed $publicKey
     */
    public static function setPublicKey($publicKey)
    {
        self::$_publicKey = $publicKey;
    }

    /**
     * @return mixed
     */
    public static function getPrivateKey()
    {
        return self::$_privateKey;
    }

    /**
     * @param mixed $privateKey
     */
    public static function setPrivateKey($privateKey)
    {
        self::$_privateKey = $privateKey;
    }

    /**
     * @return mixed
     */
    public static function getSecurityPath()
    {
        return self::$_securityPath;
    }

    /**
     * @param mixed $securityPath
     */
    public static function setSecurityPath($securityPath)
    {
        self::$_securityPath = $securityPath;
    }
    static public $paymentResponse;

    /**
     * @return PagoEfectivo
     */
    public static function getMoneda()
    {
        return self::$_moneda;
    }

    /**
     * @param PagoEfectivo $moneda
     */
    public static function setMoneda($moneda)
    {
        self::$_moneda = $moneda;
    }

    /**
     * @return mixed
     */
    public static function getMonto()
    {
        return self::$_monto;
    }

    /**
     * @param mixed $monto
     */
    public static function setMonto($monto)
    {
        self::$_monto = $monto;
    }

    /**
     * @return mixed
     */
    public static function getMedioPago()
    {
        return self::$_medio_pago;
    }

    /**
     * @param mixed $medio_pago
     */
    public static function setMedioPago($medio_pago)
    {
        self::$_medio_pago = $medio_pago;
    }

    /**
     * @return mixed
     */
    public static function getConceptoPago()
    {
        return self::$_concepto_pago;
    }

    /**
     * @param mixed $concepto_pago
     */
    public static function setConceptoPago($concepto_pago)
    {
        self::$_concepto_pago = $concepto_pago;
    }

    /**
     * @return mixed
     */
    public static function getCodServicio()
    {
        return self::$_cod_servicio;
    }

    /**
     * @param mixed $cod_servicio
     */
    public static function setCodServicio($cod_servicio)
    {
        self::$_cod_servicio = $cod_servicio;
    }

    /**
     * @return mixed
     */
    public static function getNumeroOrden()
    {
        return self::$_numero_orden;
    }

    /**
     * @param mixed $numero_orden
     */
    public static function setNumeroOrden($numero_orden)
    {
        self::$_numero_orden = $numero_orden;
    }

    /**
     * @return mixed
     */
    public static function getEmailComercio()
    {
        return self::$_email_comercio;
    }

    /**
     * @param mixed $email_comercio
     */
    public static function setEmailComercio($email_comercio)
    {
        self::$_email_comercio = $email_comercio;
    }

    /**
     * @return mixed
     */
    public static function getFechaExpirar()
    {
        return self::$_fecha_expirar;
    }

    /**
     * @param mixed $fecha_expirar
     */
    public static function setFechaExpirar($fecha_expirar)
    {
        self::$_fecha_expirar = $fecha_expirar;
    }

    /**
     * @return mixed
     */
    public static function getDataAdicional()
    {
        return self::$_data_adicional;
    }

    /**
     * @param mixed $data_adicional
     */
    public static function setDataAdicional($data_adicional)
    {
        self::$_data_adicional = $data_adicional;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioId()
    {
        return self::$_usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public static function setUsuarioId($usuario_id)
    {
        self::$_usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioNombre()
    {
        return self::$_usuario_nombre;
    }

    /**
     * @param mixed $usuario_nombre
     */
    public static function setUsuarioNombre($usuario_nombre)
    {
        self::$_usuario_nombre = $usuario_nombre;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioApellidos()
    {
        return self::$_usuario_apellidos;
    }

    /**
     * @param mixed $usuario_apellidos
     */
    public static function setUsuarioApellidos($usuario_apellidos)
    {
        self::$_usuario_apellidos = $usuario_apellidos;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioLocalidad()
    {
        return self::$_usuario_localidad;
    }

    /**
     * @param mixed $usuario_localidad
     */
    public static function setUsuarioLocalidad($usuario_localidad)
    {
        self::$_usuario_localidad = $usuario_localidad;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioProvincia()
    {
        return self::$_usuario_provincia;
    }

    /**
     * @param mixed $usuario_provincia
     */
    public static function setUsuarioProvincia($usuario_provincia)
    {
        self::$_usuario_provincia = $usuario_provincia;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioPais()
    {
        return self::$_usuario_pais;
    }

    /**
     * @param mixed $usuario_pais
     */
    public static function setUsuarioPais($usuario_pais)
    {
        self::$_usuario_pais = $usuario_pais;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioAlias()
    {
        return self::$_usuario_alias;
    }

    /**
     * @param mixed $usuario_alias
     */
    public static function setUsuarioAlias($usuario_alias)
    {
        self::$_usuario_alias = $usuario_alias;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioTipodocumento()
    {
        return self::$_usuario_tipodocumento;
    }

    /**
     * @param mixed $usuario_tipodocumento
     */
    public static function setUsuarioTipodocumento($usuario_tipodocumento)
    {
        self::$_usuario_tipodocumento = $usuario_tipodocumento;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioNumerodocumento()
    {
        return self::$_usuario_numerodocumento;
    }

    /**
     * @param mixed $usuario_numerodocumento
     */
    public static function setUsuarioNumerodocumento($usuario_numerodocumento)
    {
        self::$_usuario_numerodocumento = $usuario_numerodocumento;
    }

    /**
     * @return mixed
     */
    public static function getUsuarioEmail()
    {
        return self::$_usuario_email;
    }

    /**
     * @param mixed $usuario_email
     */
    public static function setUsuarioEmail($usuario_email)
    {
        self::$_usuario_email = $usuario_email;
    }

    /**
     * @return Response
     */
    public static function getIframe()
    {
        return self::$iframe;
    }

    /**
     * @param Response $iframe
     */
    public static function setIframe($iframe)
    {
        self::$iframe = $iframe;
    }

    /**
     * @return mixed
     */
    public static function getMessage()
    {
        return self::$message;
    }

    /**
     * @param mixed $message
     */
    public static function setMessage($message)
    {
        self::$message = $message;
    }

    /**
     * @return mixed
     */
    public static function getSuccess()
    {
        return self::$success;
    }

    /**
     * @param mixed $success
     */
    public static function setSuccess($success)
    {
        self::$success = $success;
    }

    /**
     * @return mixed
     */
    public static function getStatus()
    {
        return self::$status;
    }

    /**
     * @param mixed $status
     */
    public static function setStatus($status)
    {
        self::$status = $status;
    }

    /**
     * @return mixed
     */
    public static function getExpiration()
    {
        return self::$expiration;
    }

    /**
     * @param mixed $expiration
     */
    public static function setExpiration($expiration)
    {
        self::$expiration = $expiration;
    }

    /**
     * @return mixed
     */
    public static function getPaymentResponse()
    {
        return self::$paymentResponse;
    }

    /**
     * @param mixed $paymentResponse
     */
    public static function setPaymentResponse($paymentResponse)
    {
        self::$paymentResponse = $paymentResponse;
    }

}