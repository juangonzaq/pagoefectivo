<?php
namespace App\Http\Controllers\Services;

use App\Http\Controllers\Services\AppServiceRequest;
use App\Http\Controllers\Services\AppServiceCrypto;
use App\Http\Controllers\Services\AppService;
use Exception;
use App\Http\Bases\BasePagoEfectivo;

class AppServicePagoEfectivo extends AppService {
    public static $_instance;
    protected $_options;
    protected $_crypto;
    protected $_lastPayRequest;

    public function __construct($options = null)
    {
        //Set property
        $this->_options = [
            'apiKey' => BasePagoEfectivo::getCodServicio(),
            'url2'   => BasePagoEfectivo::getUrl2(),
            'crypto' => [
                'securityPath' => BasePagoEfectivo::getSecurityPath(),
                'publicKey'    => BasePagoEfectivo::getPublicKey(),
                'privateKey'   => BasePagoEfectivo::getPrivateKey(),
                'url'          => BasePagoEfectivo::getUrl()
            ],
            'gen' => [
                'url' => BasePagoEfectivo::getGenUrl()
            ],
            'mailAdmin' => config('services.pagoefectivo.PE_EMAIL_PORTAL'),
            'medioPago' => config('services.pagoefectivo.PE_MEDIO_PAGO')
        ];
        $this->_crypto = AppServiceCrypto::getInstance($this->_options['crypto']);
    }

    /*
     * Enviar Pago
     * @param entity $be_solicitud Class de envio de solicitud de pago para generar el XML
     * @return SimpleXMLElement Resultado de Servicio Ejm:
     * SimpleXMLElement Object
     * (
     *     [iDResSolPago] => 33
     *     [CodTrans] => 3300020
     *     [Token] => 2a3848a4-183a-490c-813a-40d90e82ef96
     *     [Fecha] => 21/02/2012 11:26:27 a.m.
     * )
     */
    public function GenerarCip()
    {
        $xml = new AppServiceRequest();
        $xml->convertToXml();
        return $this->solicitarPago($xml);
    }

    /*
     * Solicitar Pago
     * @param string $xml XML de envio de solicitud de pago
     * @return SimpleXMLElement Resultado de Servicio Ejm:
     * SimpleXMLElement Object
     * (
     *     [iDResSolPago] => 33
     *     [CodTrans] => 3300020
     *     [Token] => 2a3848a4-183a-490c-813a-40d90e82ef96
     *     [Fecha] => 21/02/2012 11:26:27 a.m.
     * )
     */
    public function solicitarPago($xml)
    {
        $info = $this->_loadService('GenerarCIPMod1',
            ['request' =>
                [
                    'CodServ' => $this->_options['apiKey'],
                    'Firma'   => $this->_crypto->signer($xml),
                    'Xml'     => $this->_crypto->encrypt($xml)
                ]
            ]
        );
        if($info != false) {
            $info = $info->GenerarCIPMod1Result;

            if ($info->Estado != 1){
                $response = ('Pago Efectivo : ' . $info->Mensaje);
            } else {
                $response = simplexml_load_string($this->_crypto->decrypt($info->Xml));
                $response->Mensaje = $info->Mensaje;
                $response->Estado  = $info->Estado;
            }
            return $response;
        }
    }

    /*
     * Consultar Pago
     * @param string $xml XML de envio de solicitud de pago
     * @return SimpleXMLElement Resultado de Servicio Ejm:
     */
    public function consultarCip($CIP)
    {
        $info = $this->_loadService('ConsultarCIPMod1',
            array( 'request' =>
                array('CodServ' =>$this->_options['apiKey'],
                    'Firma' => $this->_crypto->signer($CIP),
                    'CIPS' => 	$this->_crypto->encrypt((string)$CIP)
                )));

        if($info != false){
            $info = $info->ConsultarCIPMod1Result;
            //Desencriptar el xml de la consulta
            $xml = simplexml_load_string($this->desencriptarData($info->XML));
            $info->Estado = $info->Estado;
            $info->CIPs = $xml;
        }
        return $info;
    }

    /*
     * Consultar CIP por orden
     * @param string $xml XML de envio de solicitud de pago
     * @return SimpleXMLElement Resultado de Servicio Ejm:
     */
    public function consultarCipXOrden($Orden)
    {
        $info = $this->_loadService('ConsultarSolicitudPagov2',
            array( 'request' =>
                array('cServ' => 'ac7ef195-d3f6-46a5-931b-84f7b2937683',
                    'Xml' => '<?xml version="1.0" encoding="utf-8" ?><ConsultarPago><CodServicio>'.$this->_options['apiKey'].'</CodServicio><CodTransaccion>'.trim($Orden).'</CodTransaccion></ConsultarPago>')));
        if($info != false) $info = $info->ConsultarSolicitudPagov2Result;
        return $info;
    }

    /*
     * Actualizar CIP
     * @param string $xml XML de envio de solicitud de pago
     * @return SimpleXMLElement Resultado de Servicio Ejm:
     */
    public function actualizarCip($CIP, $fecha)
    {
        date_default_timezone_set('America/Lima');
        $date = substr($fecha, 0, 10);
        $time = substr($fecha, 10);
        $afecha = explode("/", $date);
        $fecha = $afecha[2].'/'.$afecha[1].'/'.$afecha[0].$time;
        $date = strtotime($fecha);
        //$fecha = date('d/m/Y H:i:s a', $date);
        $fecha = date('c', $date);
        //var_dump($fecha);
        $info = $this->_loadService('ActualizarCIPMod1',
            array( 'request' =>
                array('CodServ' =>$this->_options['apiKey'],
                    'Firma' => $this->_crypto->signer($CIP),
                    'CIP' => 	$this->_crypto->encrypt((string)$CIP),
                    'FechaExpira' => $fecha
                )));

        if($info != false) $info = $info->ActualizarCIPMod1Result;
        return $info;
    }

    /*
     * Eliminar Pago
     * @param string $xml XML de envio de solicitud de pago
     * @return SimpleXMLElement Resultado de Servicio Ejm:
     */
    public function eliminarCip($CIP)
    {
        $info = $this->_loadService('EliminarCIPMod1',
            array( 'request' =>
                array('CodServ' => $this->_options['apiKey'],
                    'Firma'     => $this->_crypto->signer($CIP),
                    'CIP'       => $this->_crypto->encrypt((string)$CIP)
                )));

        if($info != false) $info = $info->EliminarCIPMod1Result;
        return $info;
    }

    public function consultarSolicitudPago($xml)
    {
        if (gettype($xml) == 'integer'){
            $xml = '<?xml version="1.0" encoding="utf-8" ?><ConsultarPago> <idResSolPago>'.$xml.'</idResSolPago></ConsultarPago>';
        }

        $info = $this->_loadService('ConsultarSolicitudPago',
            array( 'request' =>
                array('cServ' => $this->_options['apiKey'],
                    'CClave' => $this->_crypto->signer($xml),
                    'Xml' => $this->_crypto->encrypt($xml))));
        if($info != false) {$info = $info->ConsultarSolicitudPagoResult;

            if ($info->Estado != 1) throw new Exception('Pago Efectivo : ' . $info->Mensaje);
            return simplexml_load_string($this->_crypto->decrypt($info->Xml));
        }
    }

    public function desencriptarData($string)
    {
        return $this->_crypto->decrypt($string);
    }

    public function addRowFileLog($file, $data){
        $fp = fopen($file, 'a+') or die ("Error opening file in write mode!");

        fwrite($fp, str_pad($data, 55));
        fwrite($fp, "\n\r");
        fclose($fp);
    }

    public function getCodigoBarra($cip){
        $img = $this->_options['imgbarra'] . '?codigo=' . $this->_crypto->codifica('cip=' . $cip );
        return $img;
    }
}
?>