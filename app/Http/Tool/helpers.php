<?php

function show($title = null, $message = null)
{
    $flash = app('App\Http\Tool\Flash');

    //  没有参数就返回,$flash对象，那么就可以flash()->info() 这样来调用了
    if (func_num_args() == 0) {
        return $flash;
    }

    // 或者用这种写法，laravel源码中用下面这种多
    // if (is_null($title)) {
    //     return $flash;
    // }

    // 如果flash()传了参数，就执行info方法，和session()->get()道理一样
    return $flash->info($title, $message);
}