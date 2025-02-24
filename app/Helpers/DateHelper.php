<?php

namespace App\Helpers;

class DateHelper
{
    /**
     * Verifica se o email existe.
     *
     * @param string $email
     * @return bool
     */
    public static function formatDate($date)
    {
        if (empty($date)) {
            return null;
        }

        return date('d/m/Y \à\s H:i', strtotime($date));
    }
}
