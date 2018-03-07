<?php
namespace App\Http\Controllers\Mappers;

use App\Http\Bases\BasePagoEfectivo;

class PaymentMapper extends BasePagoEfectivo
{
    static public function init($data = null)
    {
        self::setUsuarioId($data['userId']);
        self::setUsuarioNombre($data['userName']);
        self::setUsuarioApellidos($data['userLastName']);
        self::setUsuarioLocalidad($data['userLocalization']);
        self::setUsuarioProvincia($data['userProvince']);
        self::setUsuarioPais($data['userCountry']);
        self::setUsuarioAlias($data['userNickname']);
        self::setUsuarioTipodocumento($data['userDocumentType']);
        self::setUsuarioNumerodocumento($data['userDocumentNumber']);
        self::setUsuarioEmail($data['userEmail']);
    }
}