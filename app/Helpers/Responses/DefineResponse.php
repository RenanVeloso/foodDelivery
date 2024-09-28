<?php

namespace App\Helpers\Responses;
use Route;

class DefineResponse
{


    /**
     * @var object
    */
    public $response;

    /**
     * @var string
     * Prefixo de falha tecnica
     */
    const E_TYPE = 'E';

    /**
     * @var string
     * Prefixo de parametros invalidos
     */
    const D_TYPE = 'D';

    /**
     * @var string
     * Prefixo de sucesso
     */
    const S_TYPE = 'S';

    /**
     * @var string
     * Prefixo de falha de negocio
     */
    const N_TYPE = 'N';

    /**
     * @var string
     * Prefixo de falha de traducao de dominio
     */
    const T_TYPE = 'T';

    /**
     * @var string
     * Status code de disponibilizao de dados
     */
    const N_STATUS = 0;

    /**
     * @var string
     * Status code de sucesso
     */
    const S_STATUS = 1;

    /**
     * @var string
     * Status code de erro
     */
    const E_STATUS = 2;


    public function make($type, $code = 0, $status = 0, $data = NULL, $errors = NULL,$batch_code = NULL)
    {
        //Monta a resposta
        $response = new MountResponse();
        $response->status = $status;
        $response->code = $this->getCode($type, $code);
        $msg = $this->getMessage($type, $code, $data);
        $response->message = $msg->message;
        // $response->detail = $msg->detail;
        $response->errors = $errors;
        $response->data = $data;
        $response->batch_code = $batch_code;

        //Retorna a resposta conforme padrao
        switch ($type) {
            case "E":
                // if( env('APP_LOG_LEVEL') == 'debug' ) {
                    \Log::error(Route::getCurrentRoute()->getActionMethod()."|Response|".
                    json_encode($response->toArray(), JSON_UNESCAPED_UNICODE)
                    );
                // }
                break;
            default:
                if( env('APP_LOG_LEVEL') == 'debug' ) {
                    \Log::info(Route::getCurrentRoute()->getActionMethod()."|Response|".
                    json_encode($response->toArray(), JSON_UNESCAPED_UNICODE)
                    );
                }
                break;
        }
        
        return Response::make($response->toArray(), $response->status);
    }

    private function getCode($type = '', $code = 0 )
    {
        return $type.str_pad($code, 6, "0", STR_PAD_LEFT);
    }

    public function getMessage($type, $code = 0, $data = NULL)
    {
        $msg = new \stdClass();
        switch ( $type ) {
            case self::E_TYPE:
                switch ($code) {
                    case 1:
                        $msg->message = "Erro indefinido";
                        $msg->detail = "Erro indefinido";
                        break;
                    case 2:
                        $msg->message = "Falha técnica";
                        $msg->detail = "Falha técnica";
                        break;
                    case 3:
                        $msg->message = "Não há dados para consulta";
                        $msg->detail = "Não há dados para consulta com parâmetros informados";
                        break;
                    case 4:
                        $msg->message = "Erro ao realizar operação";
                        $msg->detail = $data;
                        break;


                    case 99: //Mensagem customizada
                        $msg->message = $data;
                        break;
                }
                break;
            case self::D_TYPE:
                switch ($code) {
                    case 1:
                        $msg->message = "Parâmetros inválidos";
                        $msg->detail = "Nenhum parâmetro encontrado ou parâmetro inválido na requisição";
                        break;
                    case 2:
                        $msg->message = "O campo $data é de preechimento obrigatório";
                        $msg->detail = "Campo obrigatório não informado na requisição";
                        break;
                    case 3:
                        $msg->message = "Campo $data com tipo diferente da definição";
                        $msg->detail = "Campo deve ser do tipo informado na documentação";
                        break;
                    case 4:
                        $msg->message = "Campo $data com formato inválido";
                        $msg->detail = "Campo deve conter o formato correto";
                        break;
                    case 5:
                        $msg->message = "Tamanho do campo $data maior que o esperado";
                        $msg->detail = "O tamanho do campo deve respeitar o tamanho especificado em documentação";
                        break;


                    case 99: //Mensagem customizada
                        $msg->message = $data;
                        break;
                }
                break;
            case self::S_TYPE:
                switch ($code) {
                    case 0:
                        $msg->message = "Consulta realizada com sucesso";
                        $msg->detail = $data;
                        break;
                    case 1:
                        $msg->message = "Dados na fila de processamento";
                        $msg->detail = $data;
                        break;
                    case 2:
                        $msg->message = "Inclusão realizada com sucesso";
                        $msg->detail = $data;
                        break;
                    case 3:
                        $msg->message = "Alteração realizada com sucesso";
                        $msg->detail = $data;
                        break;
                    case 4:
                        $msg->message = "Exclusão realizada com sucesso";
                        $msg->detail = $data;
                        break;
                    case 5:
                        $msg->message = "Operação realizada com alguns erros";
                        $msg->detail = $data;
                        break;
                    case 6:
                        $msg->message = "Operação realizada com alguns avisos";
                        $msg->detail = $data;
                        break;
                    case 7:
                        $msg->message = "Login realizado com sucesso";
                        $msg->detail = $data;
                        break;
                    case 8:
                        $msg->message = "Logout realizado com sucesso";
                        $msg->detail = $data;
                        break;
                    case 99: //Mensagem customizada
                        $msg->message = $data;
                        break;
                }
                break;
            case self::N_TYPE:
                switch ($code) {
                    case 1:
                        $msg->message = "O valor do campo $data não é válido";
                        $msg->detail = "Campo informado não condiz com formato esperado";
                        break;
                    case 2:
                        $msg->message = "O operador informado não está cadastrado [$data]";
                        $msg->detail = "O operador informado não está cadastrado na base";
                        break;
                    case 3:
                        $msg->message = "A data informada [$data] está fora de periodo valido";
                        $msg->detail = "A data informada não pode ser superior a data atual";
                        break;
                    case 99: //Mensagem customizada
                        $msg->message = $data;
                        break;
                }
                break;
        }
        return $msg;
        }
}