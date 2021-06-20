<?php

class Funcionario
{
        private static $nome;
        private static $senha;
        private static $cpf;
        private static $email;
        private static $celular;
        private static $idade;
        private static $dataNasc;

        private static $msgErros = array();


        /**
         * Get the value of nome
         */
        public static function getNome()
        {
                return self::$nome;
        }

        /**
         * Set the value of nome
         *
         * @return  self
         */
        public static function setNome($nome)
        {
                self::$nome = $nome;
        }

        /**
         * Get the value of senha
         */
        public static function getSenha()
        {
                return self::$senha;
        }

        /**
         * Set the value of senha
         *
         * @return  self
         */
        public function setSenha($senha)
        {
                try {
                        if (strlen($senha) < 6){
                                throw new Exception('A senha deve conter no mínimo 6 caracteres.');                                
                        }else{
                                self::$senha = $senha;
                                return true;
                        }
                } catch (Exception $ex) {
                        self::$msgErros[0] = $ex->getMessage();
                        return false;
                }
        }

        /**
         * Get the value of cpf
         */
        public function getCpf()
        {
                return self::$cpf;
        }

        /**
         * Set the value of cpf
         *
         * @return  self
         */
        public function setCpf($cpf)
        {
                self::$cpf = $cpf;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return self::$email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */
        public function setEmail($email)
        {
                self::$email = $email;
        }

        /**
         * Get the value of celular
         */
        public function getCelular()
        {
                return self::$celular;
        }

        /**
         * Set the value of celular
         *
         * @return  self
         */
        public function setCelular($celular)
        {
                try{
                        if(strlen($celular) < 9)
                                throw new Exception ('Verifique o número do celular.');
                        else
                                self::$celular = $celular;
                                return true;
                        
                }catch(Exception $ex){
                        if(self::$msgErros == null){
                                self::$msgErros[0] = $ex->getMessage();
                                return false;
                        }

                        /* Aqui foi necessário verificar se a mensagem já não estava no array para que não repetisse */
                        if(self::$msgErros[0] != "Verifique o número do celular."){
                                array_push(self::$msgErros, $ex->getMessage());
                        }
                        
                }

        }

        /**
         * Get the value of idade
         */
        public function getIdade()
        {
                return self::$idade;
        }

        /**
         * Set the value of idade
         *
         * @return  self
         */
        public function setIdade($idade)
        {
                self::$idade = $idade;
        }

        /**
         * Get the value of dataNasc
         */
        public function getDataNasc()
        {
                return self::$dataNasc;
        }

        /**
         * Set the value of dataNasc
         *
         * @return  self
         */
        public function setDataNasc($dataNasc)
        {
                self::$dataNasc = $dataNasc;
        }

        public static function retornaErros()
        {
                $num = 1;
                $minhaString = '';
                $minhaString = self::$msgErros[0].'</br>';

                for($i = 1; $i < count(self::$msgErros); $i++){                        
                        $minhaString = $minhaString .self::$msgErros[$i]. '</br>';
                }

                echo ('<div class="divErros">'.$minhaString.'</div>');

                /*
                for($i = 0; $i < count(self::$msgErros); $i++){                        
                        echo ('<div class="divErros">'.self::$msgErros[$i].'</div>');
                }
                */                            
                
        }




}
