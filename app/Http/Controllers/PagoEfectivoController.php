<?php
/**
 * Created by Juan Carlos Gonzales Q.
 * Email: juangonzaq@gmail.com
 */
namespace App\Http\Controllers;

//DEPENDENCIES
use App\Http\Bases\BasePagoEfectivo;
use App\Http\Controllers\Mappers\PagoEfectivoMapper;
use App\Http\Controllers\Mappers\PaymentMapper;
use App\Http\Controllers\Services\AppServicePagoEfectivo;

//FACADES
use Exception;
use Illuminate\Support\Facades\Log;

class PagoEfectivoController extends BasePagoEfectivo
{
    public function run(){
        try{
            //Mapping data
            $data = [
                'userId' => 1,
                'userName' => 'Juan Carlos',
                'userLastName' => 'Gonzales Q',
                'userLocalization' => 'Lima',
                'userProvince' => 'Lima',
                'userCountry' => 'Perú',
                'userNickname' => 'juangonzaq',
                'userDocumentType' => 'DNI',
                'userDocumentNumber' => '70030212',
                'userEmail' => 'buyer@gmail.com',
                'coin' => 1, // 1: soles, 2: dollar
                'total' => 60,
                'paymentConcept' => 'title payment',
                'orderNumber' => '#transaction-id' . rand(10, 1000),
                'merchantEmail' => 'ecommerce@gmail.com',
                'expirationDate' => date('d/m/Y H:i:s', time() + ((int)5 * 60 * 60)),
                'additionalData' => null
            ];
            PaymentMapper::init($data);
            PagoEfectivoMapper::init($data);

            //Generate CIP
            $service  = new AppServicePagoEfectivo();
            $response = $service->GenerarCip();
            dd($response);
            /** RESPONSE:
                SimpleXMLElement {#176
                    +"idResSolPago": "481491"
                    +"CodTrans": "#transaction-id"
                    +"Token": "cfd1a78c-c9ff-4063-a4bb-8f3e01a86b12"
                    +"MetodoPago": "1,2"
                    +"Codigo": "JOI"
                    +"Fecha": "2018-03-07 08:04:14"
                    +"Estado": "1"
                    +"ParamsURL": SimpleXMLElement {#182}
                    +"CIP": SimpleXMLElement {#183
                    +"IdOrdenPago": "2500288"
                    +"IdCliente": "368764"
                    +"IdEstado": "22"
                    +"IdServicio": "213"
                    +"IdMoneda": "1"
                    +"NumeroOrdenPago": "00000002500288"
                    +"OrderIdComercio": "#transaction-id"
                    +"Total": "60.00"
                    +"MerchantID": "JOI"
                    +"FechaEmision": "2018-03-07 08:04:14"
                    +"FechaCancelado": SimpleXMLElement {#187}
                    +"FechaConciliado": SimpleXMLElement {#188}
                    +"FechaAnulado": SimpleXMLElement {#189}
                    +"FechaExpirado": SimpleXMLElement {#190}
                    +"FechaEliminado": SimpleXMLElement {#191}
                    +"TiempoExpiracion": "9.999444444444"
                    +"EstaConciliado": SimpleXMLElement {#192}
                    +"MailComercio": "ecommerce@gmail.com"
                    +"UsuarioID": "369353"
                    +"DataAdicional": SimpleXMLElement {#193}
                    +"UsuarioNombre": "Juan Carlos"
                    +"UsuarioApellidos": "Gonzales Q"
                    +"UsuarioAlias": "juangonzaq"
                    +"UsuarioEmail": "buyer@gmail.com"
                    +"UsuarioDomicilio": SimpleXMLElement {#194}
                    +"UsuarioLocalidad": "Lima"
                    +"UsuarioProvincia": "Lima"
                    +"UsuarioPais": "Perú"
                    +"Detalles": SimpleXMLElement {#195
                    +"Detalle": SimpleXMLElement {#206
                    +"IdDetalleOrdenPago": "1650935"
                    +"ConceptoPago": "title payment"
                    +"Importe": "60.00"
                    +"Tipo_Origen": "TO"
                    +"Cod_Origen": "CT"
                    +"Campo1": SimpleXMLElement {#208}
                    +"Campo2": SimpleXMLElement {#209}
                    +"Campo3": SimpleXMLElement {#210}
                    }
                    }
                }
                +"Trans": SimpleXMLElement {#184}
                +"Mensaje": "Se ha Generado el CIP: 00000002500288 ."
                }
             */

        } catch (Exception $exception){
            Log::error($exception);

            return [
                'iframe'  => '',
                'message' => $exception->getMessage(),
                'success' => false,
                'status'  => 'ERROR',
                'expiration' => '',
                'data'    => [
                    'paymentResponse' => 'ERROR-CATCH',
                    'status'          => 0,
                ]
            ];
        }
    }

    public function destroy(){

    }

    public function update(){

    }

    public function search(){

    }
}