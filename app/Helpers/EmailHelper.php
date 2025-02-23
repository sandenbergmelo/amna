<?php

namespace App\Helpers;

class EmailHelper
{
    /**
     * Verifica se o email existe.
     *
     * @param string $email
     * @return bool
     */
    public static function emailExists($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $domain = substr(strrchr($email, "@"), 1);

        if (!checkdnsrr($domain, "MX")) {
            return false;
        }

        return true;
    }
}
