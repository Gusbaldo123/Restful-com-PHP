<?php
    include_once('Compra.php');

    function GetJson()
    {
        if(isset($_REQUEST))
        {
            return Rest::open($_REQUEST);
        }
    }
    class Rest
    {
        public static function open($Request)
        {
            if(!$Request) return json_encode(array('status' => 'erro', 'dados' => 'Sem Informações'),JSON_UNESCAPED_UNICODE);
            if(count($Request)!=7) return json_encode(array('status' => 'erro', 'dados' => 'Inserir todos os construtores do Compra( em ordem ): int id, string CPF, int Val, DateTime DtCompra'),JSON_UNESCAPED_UNICODE);
            
            try 
            {    
                $url = explode('/',$Request['url']);

                $classe = ucfirst($url[0]);
                array_shift($url);
                $metodo = $Request['tipo'];

                $args = array();
                $args[] = $Request['id'];
                $args[] = str_replace(array('.','-'), '',$Request['CPF']);
                $args[] = $Request['Carro'];
                $args[] = str_replace(',', '.',str_replace(array('.','R$ '), '',$Request['Val']));

                if($Request['DtCompra']!=null)
                    $args[] = new DateTime( $Request['DtCompra'] );
                else $args[] =null;

                if(($metodo=="Insert"||$metodo=="Update")&&($args[0]==""||$args[1]==""||$args[3]==""||$args[4]==null))
                {
                    return json_encode(array('status' => 'erro', 'dados' => 'Insert e Update requerem todos os dados'),JSON_UNESCAPED_UNICODE);
                }

                if (class_exists($classe)) 
                {
                    if (method_exists($classe, $metodo)) 
                    {
                        $retorno = call_user_func_array(array(new $classe($args), $metodo), $args);

                        return json_encode(array('status' => 'sucesso', 'dados' => $retorno),JSON_UNESCAPED_UNICODE);
                    } 
                    else 
                    {
                        return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'),JSON_UNESCAPED_UNICODE);
                    }
                } 
                else 
                {
                    return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'),JSON_UNESCAPED_UNICODE);
                }	
            } 
            catch (Exception $err) 
            {
                return json_encode(array('status' => 'erro', 'dados' => $err->getMessage()),JSON_UNESCAPED_UNICODE);
            }
        }
    }
?>