<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.10.15
 * Time: 22:40
 */

namespace classes;


class User
{

    protected $auth = Auth::class;

    /**
     * @return mixed
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param mixed $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }


    public function __construct()
    {
        $auth = new Auth('*', '*');
        $this->setAuth($auth);
    }

    public function getUserPage()
    {
        $cookies = $this->getAuth()->getCookies();
        $page = Gosuslugi::query('/user/', [], \HTTP_Request2::METHOD_GET, $cookies);
    }

}