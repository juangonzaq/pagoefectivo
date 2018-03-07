<?php
namespace App\Http\Controllers\Services;

use App\Http\Bases\BasePagoEfectivo;
use App\Http\Controllers\Services\AppServiceCrypto;

//Facades
use SoapClient;
use Exception;
use Illuminate\Support\Facades\Log;

abstract class AppService
{
    protected $_options = array();
    protected $apiKey = '';
    protected static $_instance;

    public function _loadService($service, $data)
    {
        $this->_options['url2'] = config("services.pagoefectivo.PE_WSGENCIP");
        $this->_options['url3'] = config("services.pagoefectivo.PE_WSCRYPTAB");
        if( env('APP_ENV')  == 'local' ){
            $this->_options['url2'] = config("services.pagoefectivoDev.PE_WSGENCIP");
            $this->_options['url3'] = config("services.pagoefectivoDev.PE_WSCRYPTAB");
        }

        switch($service){
            case 'GenerarCIPMod1':           $url = $this->_options['url2'];break;
            case 'ConsultarSolicitudPagov2': $url = $this->_options['url2'];break;
            case 'ActualizarCIPMod1':        $url = $this->_options['url2'];break;
            case 'ConsultarCIPMod1':         $url = $this->_options['url2'];break;
            case 'EliminarCIPMod1':          $url = $this->_options['url2'];break;
            case 'BlackBox':                 $url = $this->_options['url3'];break;
            default :                        $url = $this->_options['url'];break;
        }

        try{
            $soap = new SoapClient($url);
            $info = $soap->$service($data);
            return $info;
        } catch (Exception $exception){
            Log::error($exception);
            return $exception->getMessage();
        }
    }

    final public static function getInstance($options = null)
    {
        $class = self::getClass();
        if (!isset(self::$_instance[$class])) {
            self::$_instance[$class] = new $class($options);
        }
        return self::$_instance[$class];
    }

    final public static function getClass()
    {
        if(function_exists('get_called_class')){
            return get_called_class();
        }
        return AppServiceCrypto;
    }

    public function getOptions()
    {
        return $this->_options;
    }
}