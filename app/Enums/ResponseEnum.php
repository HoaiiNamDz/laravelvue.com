<?php 
    namespace App\Enums;

    
enum ResponseEnum:string {
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUNDED = 404;
}