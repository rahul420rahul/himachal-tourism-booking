<?php
namespace App\Exceptions;

use Exception;

class BookingException extends Exception
{
    public static function slotNotAvailable()
    {
        return new self('Selected time slot is not available', 422);
    }
    
    public static function invalidPackage()
    {
        return new self('Invalid package selected', 422);
    }
}
