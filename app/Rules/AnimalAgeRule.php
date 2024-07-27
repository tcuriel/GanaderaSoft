<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AnimalAgeRule implements ValidationRule
{
  private $edad;

  public function __construct($edad)
  {
      $this->edad = $edad;
  }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        switch($value){
          case 'Becerra':
           if($this->edad<0 && $this->edad>8){
             $fail("La becerra debe comprender edad entre 0 a 8 meses aproximadamente");
           }
            break;

          case 'Maute':
            if($this->edad<8 && $this->edad>24){
              $fail("El maute debe comprender edad entre 8 a 24 meses");
            }
           break;

          case 'Novilla':
            if($this->edad<24 && $this->edad>30){
              $fail("La novilla debe comprender edad entre 24 a 30 meses");
            }
           break;
          
          case 'Vaca':
            if($this->edad<28){
              $fail("La vaca debe comprender edad mas de 28 meses");
            }
           break;

          default:
            $fail("El tipo de animal no corresponde con los aceptados por el sistema");
          break;
        }
    }
}
