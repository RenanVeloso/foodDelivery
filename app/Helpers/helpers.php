<?php 

    function responseStatus($type, $code = 0, $status = 0, $data = NULL, $errors = NULL ,$batch_code = NULL)
{
    /** @var App\Helpers\Responses $factory*/
    $factory = new \App\Helpers\Responses\DefineResponse();

    if ( func_num_args() === 0 ){
        return $factory;
    }

    return $factory->make($type, $code, $status, $data, $errors,$batch_code);
}
