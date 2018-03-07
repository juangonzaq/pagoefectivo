<?php
namespace App\Http\Controllers\Services;

use App\Http\Bases\BasePagoEfectivo;
use SimpleXMLElement;

class AppServiceRequest
{
    protected $_xml;
    protected $_detail;
    protected $_params = array();

    public function __construct()
    {
        $this->_xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" ?><SolPago></SolPago>');
    }

    public function __destruct()
    {
        $this->_xml = null;
    }

    /*
     * Añade los tags iniciales del XML
     * @param array $contenido Contenido a añadir formato: array('tag' => 'valor')
     * @return PagoEfectivo_Solicitud el objeto contenedor
     */
    public function convertToXml()
    {
        $contenido = [
            'IdMoneda'  => BasePagoEfectivo::getMoneda(),
            'Total'     => BasePagoEfectivo::getMonto(),
            'MetodosPago'       => BasePagoEfectivo::getMedioPago(),
            'CodServicio'       => BasePagoEfectivo::getCodServicio(),
            'Codtransaccion'    => BasePagoEfectivo::getNumeroOrden(),
            'EmailComercio'     => BasePagoEfectivo::getEmailComercio(),
            'FechaAExpirar'     => BasePagoEfectivo::getFechaExpirar(),
            'UsuarioId'         => BasePagoEfectivo::getUsuarioId(),
            'DataAdicional'     => BasePagoEfectivo::getDataAdicional(),
            'UsuarioNombre'     => BasePagoEfectivo::getUsuarioNombre(),
            'UsuarioApellidos'  => BasePagoEfectivo::getUsuarioApellidos(),
            'UsuarioLocalidad'  => BasePagoEfectivo::getUsuarioLocalidad(),
            'UsuarioProvincia'  => BasePagoEfectivo::getUsuarioProvincia(),
            'UsuarioPais'       => BasePagoEfectivo::getUsuarioPais(),
            'UsuarioAlias'      => BasePagoEfectivo::getUsuarioAlias(),
            'UsuarioTipoDoc'    => BasePagoEfectivo::getUsuarioTipodocumento(),
            'UsuarioNumeroDoc'  => BasePagoEfectivo::getUsuarioNumerodocumento(),
            'UsuarioEmail'      => BasePagoEfectivo::getUsuarioEmail(),
            'ConceptoPago'      => BasePagoEfectivo::getConceptoPago()
        ];
        if (is_array($contenido)) {
            foreach($contenido as $index => $value)
                $this->_xml->addChild($index, $value);
        }
        $detalle = [
            [
                'Cod_Origen' => 'CT',
                'TipoOrigen' => 'TO',
                'ConceptoPago'  => BasePagoEfectivo::getConceptoPago(),
                'Importe'       => BasePagoEfectivo::getMonto()
            ]
        ];

        if (is_array($detalle)){
            if (!isset($this->detail))
                $this->detail = $this->_xml->addChild('Detalles');

            foreach ($detalle as $row){
                $detail = $this->detail->addChild('Detalle');
                foreach ($row as $i => $d)
                    $detail->addChild($i, $d);
            }
        }
        return $this;
    }

    /*
     * Añade los tags iniciales del XML
     * @param array $contenido Contenido a añadir formato: array('tag' => 'valor')
     * @return PagoEfectivo_Solicitud el objeto contenedor
     */
    public function addContenido($contenido)
    {
        if (is_array($contenido)) {
            foreach($contenido as $index => $value)
                $this->_xml->addChild($index, $value);
        }
        return $this;
    }

    /*
     * Añade los tags iniciales del XML
     * @param array $contenido Contenido a añadir formato: array(array('tag' => 'valor', 'tag => 'valor', ...) ,  array('tag'=>'valor', 'tag' =>'valor))
     * @return PagoEfectivo_Solicitud el objeto contenedor
     */
    public function addDetalle($detalle)
    {
        if (is_array($detalle)){
            if (!isset($this->detail))
                $this->detail = $this->_xml->addChild('Detalles');
            foreach ($detalle as $row){
                $detail = $this->detail->addChild('Detalle');
                foreach ($row as $i => $d)
                    $detail->addChild($i, $d);
            }
        }
        return $this;
    }

    /*
     * Añade el parametro URL
     * @return PagoEfectivo_Solicitud el objeto contenedor
     */
    public function addParametroUrl($parametro)
    {
        return $this->addParam('URL', $parametro);
    }

    /*
     * Añade el parametro Email
     * @return PagoEfectivo_Solicitud el objeto contenedor
     */
    public function addParametroEmail($parametro)
    {
        return $this->addParam('Email', $parametro);
    }

    /*
     * Añade el parametro General
     * @return PagoEfectivo_Solicitud el objeto contenedor
     */
    public function addParam($paramName, $content)
    {
        if (is_array($content)){

            if (!isset($this->_params[$paramName]))
                $this->_params[$paramName] = $this->_xml->addChild('Params' . $paramName);
            foreach ($content as $i => $p){
                $param = $this->_params[$paramName]->addChild('Param' . $paramName);
                $param->addChild('Nombre',$i);
                $param->addChild('Valor',$p);

            }
        }
        return $this;
    }
    public function toXml()
    {
        return $this->_xml->asXML();
    }

    function __toString(){
        return $this->toXml();
    }
}