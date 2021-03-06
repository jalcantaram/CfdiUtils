<?php
namespace CfdiUtilsTests\Validate\Cfdi33\RecepcionPagos\Pagos;

use CfdiUtils\Elements\Pagos10\Pago;
use CfdiUtils\Validate\Cfdi33\RecepcionPagos\Pagos\TipoCadenaPagoCertificado;
use CfdiUtils\Validate\Cfdi33\RecepcionPagos\Pagos\ValidatePagoException;
use PHPUnit\Framework\TestCase;

class TipoCadenaPagoCertificadoTest extends TestCase
{
    /**
     * @param string|null $tipoCadPago
     * @param string|null $input
     * @testWith [null, null]
     *           ["1", "1"]
     */
    public function testValid($tipoCadPago, $input)
    {
        $pago = new Pago([
            'TipoCadPago' => $tipoCadPago,
            'CertPago' => $input,
        ]);
        $validator = new TipoCadenaPagoCertificado();

        $this->assertTrue($validator->validatePago($pago));
    }

    /**
     * @param string|null $tipoCadPago
     * @param string|null $input
     * @testWith [null, "1"]
     *           ["", "1"]
     *           ["1", null]
     *           ["1", ""]
     *           [null, ""]
     *           ["", null]
     */
    public function testInvalid($tipoCadPago, $input)
    {
        $pago = new Pago([
            'TipoCadPago' => $tipoCadPago,
            'CertPago' => $input,
        ]);
        $validator = new TipoCadenaPagoCertificado();

        $this->expectException(ValidatePagoException::class);
        $validator->validatePago($pago);
    }
}
