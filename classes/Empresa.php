<?php

class Empresa
{

    private static $nome_empresarial;
    private static $cnpj;
    private static $data_abertura;
    private static $porte;
    private static $situacao_cadastral;

    private static $msgErros = array();

    public static function getNomeEmpresarial()
    {
        return self::$nome_empresarial;
    }
    public static function setNomeEmpresarial($razao_social)
    {
        self::$nome_empresarial = $razao_social;
    }

    public static function getCnpj()
    {
        return self::$cnpj;
    }
    public static function setCnpj($cnpj)
    {

        try {
            if (strlen($cnpj) < 18) {
                throw new Exception('CNPJ inválido');
            } else {
                self::$cnpj = $cnpj;
                return true;
            }
        } catch (Exception $ex) {
            self::$msgErros[0] = $ex->getMessage();
            return false;
        }
    }

    /**
     * Get the value of data_abertura
     */
    public function getData_abertura()
    {
        return self::$data_abertura;
    }

    public function setDataAbertura($data_abertura)
    {
        self::$data_abertura = $data_abertura;
    }

    public function getPorte()
    {
        return self::$porte;
    }

    public function setPorte($porte)
    {
        self::$porte = $porte;
    }

    public function getSituacaoCadastral()
    {
        return self::$situacao_cadastral;
    }

    public function setSituacaoCadastral($situacao_cadastral)
    {
        self::$situacao_cadastral = $situacao_cadastral;
    }

    public static function retornaErros()
    {
        $num = 1;
        for ($i = 0; $i < count(self::$msgErros); $i++) {
            echo ('<div class="divErros">' . self::$msgErros[$i] . '</div>');
        }
    }
}
