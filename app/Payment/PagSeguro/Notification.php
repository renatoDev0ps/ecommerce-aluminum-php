<?php

namespace App\Payment\PagSeguro;

class Notification
{
    public function getTransaction()
    {
        if (\Pagseguro\Helper\Xhr::hasPost()) throw new \InvalidArgumentException($_POST);

        $response = \Pagseguro\Services\Translations\Notification::check(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $response;
    }
}
