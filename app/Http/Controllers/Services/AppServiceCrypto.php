<?php
namespace App\Http\Controllers\Services;

use App\Http\Controllers\Services\AppService;

class AppServiceCrypto extends AppService {

    const E_NO_SECURITY_PATH = 'Security Path not assign';

    protected $_options = [
        'securityPath' => '/var/www/devcheckout/app/Http/JNPayment/SDKPasarelas/PagoEfectivo/key/',
        'publicKey'    => '/var/www/devcheckout/app/Http/JNPayment/SDKPasarelas/PagoEfectivo/key/SPE_PublicKey.1pz',
        'privateKey'   => '/var/www/devcheckout/app/Http/JNPayment/SDKPasarelas/PagoEfectivo/key/JOI_PrivateKey.1pz'
    ];

    protected $_fileCache = array();

    /*
     * Constructor de la aplicación
     * @param string $securityPath Carpeta donde se almacenan public.key y private.key
     */
    public function __construct($options = null)
    {
        if (isset($options))
            $this->_options = array_merge($this->_options, $options);
    }

    /*
     * Encriptar de la cadena por webservice
     * @param string @string Cadena a encriptar
     */
    public function encrypt($string)
    {
        try{

            $info = $this->_loadService('EncryptText', array('plainText' => $string, 'publicKey' => $this->getPublicKey()));
            return ($info!==false) ? $info->EncryptTextResult : false;

        } catch(\Exception $exception){
            \Log::error($exception);
            return false;
        }
    }

    /*
     * Descriptar cadena por webservice
     * @param string $string Cadena a encriptar
     * @return
     */
    public function decrypt($string)
    {
        try{
            $info = $this->_loadService('DecryptText', array('encryptText' => $string, 'privateKey' => $this->getPrivateKey()));
            return ($info!==false) ? $info->DecryptTextResult : false;
        } catch(\Exception $exception){
            \Log::error($exception);
            return false;
        }
    }

    /*
     * Firma de texto
     * @param string $string Palabra a firmar
     * @return Cadena firmada
     */
    public function signer($string)
    {
        try{

            $info = $this->_loadService('Signer', array('plainText' => $string, 'privateKey' => $this->getPrivateKey()));
            return ($info!==false) ? $info->SignerResult : false;

        } catch(\Exception $exception){
            \Log::error($exception);
            return false;
        }
    }

    /*
     * Valida si un texto esta correctamente firmado
     */
    public function signerVal($text, $signerText)
    {
        try{

            $info = $this->_loadService('SignerVal', array('plainText' => $text,
                'signerText' => $signerText,
                'publicKey' => $this->getPublicKey()));
            return ($info!==false) ? $info : false;

        } catch(\Exception $exception){
            \Log::error($exception);
            return false;
        }
    }

    /*
     * Extraer la llave privada
     */
    public function getPrivateKey()
    {
        return $this->_readFile($this->_options['securityPath'] . $this->_options['privateKey']);
    }

    /*
     * Extraer la llave pública
     */
    public function getPublicKey()
    {
        return $this->_readFile($this->_options['securityPath'] . $this->_options['publicKey']);
    }

    /*
     * Extraer el contendio de archivo
     */
    public function _readFile($filename)
    {
        if (!array_key_exists($filename,$this->_fileCache))
        {
            $handle = fopen($filename,'r');
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            $this->_fileCache[$filename] = $contents;
        }else{
            $contents = $this->_fileCache[$filename];
        }
        return $contents;
    }

    /*
    *  Para el envio del parametro de la imagen del codigo de Barras para la modalidad 1
     */
    public function codifica($string)
    {
        try{

            $info = $this->_loadService('BlackBox', array('Cad' => $string));
            return ($info!==false) ? $info->BlackBoxResult : false;

        } catch(\Exception $exception){
            \Log::error($exception);
            return false;
        }
    }
}
?>