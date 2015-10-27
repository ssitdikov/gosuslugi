<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.10.15
 * Time: 22:20
 */

namespace classes;

use HTTP_Request2;


class Gosuslugi
{

    const HOST = 'https://uslugi.tatarstan.ru';

    static public function query($address, $data = array(), $method = HTTP_Request2::METHOD_GET, $cookies = array())
    {
        $request = new HTTP_Request2(self::HOST . '/' . trim($address, '/'), $method);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $request->addPostParameter($key, $value);
            }
        }

        if (!empty($cookies)) {
            foreach ($cookies as $cookie) {
                $request->addCookie($cookie['name'], $cookie['value']);
            }
        }
        try {
            $response = $request->send();
            if (200 == $response->getStatus() || 302 == $response->getStatus()) {
                return $response;
            }
        } catch (\HttpRequestException $e) {
            print $e->getMessage();
        }
        return $request;
    }
}