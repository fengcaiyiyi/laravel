<?php

namespace App\Http\Tool;

class Flash
{
    public function create($type, $message, $position='top center', $key = 'flash_message')
    {
        session()->flash($key, [
            'type' => $type,
            'message' => $message,
            'position' => $position,//默认顶部居中

        ]);

    }


    public function success($message,$position='top center')
    {
        return $this->create( 'success',$message,$position);
    }

    public function error($message,$position='top center')
    {
        return $this->create( 'error',$message,$position);
    }


}