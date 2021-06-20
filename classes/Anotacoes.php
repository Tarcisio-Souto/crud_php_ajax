<?php

    class Anotacoes{

    static function validaAnotacao($txtAnotacao){

        try{

            if(!empty($txtAnotacao)){
                return true;
            }else{
                throw new Exception('Não há anotação para salvar');
                return false;
            }

        }catch(Exception $ex){
            echo('<div class="divErros">'.$ex->getMessage().'</div>');            
        }

    }

    }


?>