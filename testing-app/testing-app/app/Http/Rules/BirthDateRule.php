<?php
namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\RegistrationModel;
use App\Libraries\PPDB;

class BirthDateRule implements Rule
{
	protected $msg  = '';
	
	function __construct()
	{
		# code...
	}

	/**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $date      = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        $diffYears = \Carbon\Carbon::now()->diffInYears($date);

        if ($diffYears > 21) {
            $this->msg  = ':attribute tidak boleh lebih dari 21 tahun';
            return false;
        }

        return true;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }

}
