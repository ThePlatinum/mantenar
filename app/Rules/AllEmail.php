<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\InvokableRule;

class AllEmail implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
      $emails = explode(',', $value);
  
      foreach ($emails as $keyemail) {
        if ( !filter_var( str_replace(' ', '', $keyemail) , FILTER_VALIDATE_EMAIL) )
          $fail('All entries must be an email');
        if ( User::withTrashed()->where('email', str_replace(' ', '', $keyemail))->get()->count() > 0 )
          $fail('You can not invite an exiting user');
      }
    }
}