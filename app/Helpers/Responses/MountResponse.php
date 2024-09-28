<?php

namespace App\Helpers\Responses;

class MountResponse
{
    /**
     * @var int $status
     */
    public $status;

    /**
     * @var string $code
     */
    public $code;

    /**
     * @var string $message
     */
    public $message;

    /**
     * @var string $detail
     */
    public $detail;

    /**
     * @var array $errors
     */
    public $errors = [];

    /**
     * @var array $data
     */
    public $data = [];

    /**
     * @var array $batch_code
     */
    public $batch_code;

    /**
     * @param string $detail
     * @return Response
     */
    public function toArray()
    {
        $result = [];
        $result['status'] = $this->status;
        $result['code'] = $this->code;
        $result['message'] = $this->message;
        if ( $this->batch_code )
            $result['url_report'] = url("/report/".$this->batch_code);


        if ( $this->detail )
            $result['detail'] = $this->detail;

        if ( $this->errors )
            $result['errors'] = $this->errors;

        if ( $this->data )
            $result['data'] = $this->data;

        return $result;
    }

}