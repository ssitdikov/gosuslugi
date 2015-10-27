<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.10.15
 * Time: 22:20
 */

namespace classes;

use HTTP_Request2;

class Auth
{

    const LOGIN_PATH = '/user/login/';

    protected $login = '';
    protected $password = '';

    protected $cookies = array();

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param array $cookies
     */
    public function setCookies($cookies)
    {
        $this->cookies = $cookies;
    }


    public function __construct($login, $password)
    {
        $this->setLogin($login);
        $this->setPassword($password);
        $this->auth();
        return $this;
    }

    protected function auth()
    {

        $authData = array(
            'user_login_form_model[phone_number]' => $this->getLogin(),
            'user_login_form_model[password]' => $this->getPassword(),
            'user_login_form_model[remember_me]' => 1
        );

        $response = Gosuslugi::query(self::LOGIN_PATH, $authData, HTTP_Request2::METHOD_POST);

        if ($response instanceof \HTTP_Request2_Response) {
            $cookies = $response->getCookies();
            if (sizeof($cookies) == 3) {
                $this->setCookies($cookies);
            }
        }
    }

}