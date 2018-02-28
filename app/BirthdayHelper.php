<?php

namespace App;

class BirthdayHelper
{
    /**
     * Get birthday dates in order
     *
     * @return array
     */
    public static function getBirthdays()
    {
        return Birthday::where('birthday','>',\Carbon\Carbon::parse('-1 year')->toDateString())->orderBy('birthday','desc')->get();
    }
}
