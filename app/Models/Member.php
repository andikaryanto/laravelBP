<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Validate model
     *
     * @throws Exception
     * @return Member
     */
    public function validate()
    {
        if ($this->emailIsRegistered()) {
            throw new Exception('Email has been registered, try another email');
        }

        return $this;
    }

    /**
     * Define email has been registered or not
     *
     * @return bool
     */
    private function emailIsRegistered()
    {
        $existData = Member::where('email', $this->email)->get();
        return  $existData->count() > 0;
    }
}
