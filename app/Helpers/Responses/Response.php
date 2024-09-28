<?php

namespace App\Helpers\Responses;

use Illuminate\Contracts\Support\Arrayable;

class Response
{
    /**
     * Funcao para criacao de retorno
    */
    public static function make($content = '')
    {
        /** @var Request $request */
        $request = app('request');
        $request->header('accept');
                    $result = response()->json($content, $content['status']);
                
        return $result;
    }

}