<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        #ユーザーがログインしていない場合は、ログイン画面へリダイレクト
        if( empty( auth()->user() ) ){
            return redirect('index');
        }

        //ユーザーの権限チェック
        if (auth()->user()->owner === '1') {
            $this->auth = true;
        } else {
            $this->auth = false;
        }

        //ユーザーの権限がownerだった場合は、アクセスを許可。
        if ($this->auth === true) {
            return $next($request);
        }

        //それ以外はメイン画面にリダイレクト
        return redirect()->route('main');
    }
}
