<?php

namespace App;

class Validator {
  public static function validate($data, $rules) {
      $errors = [];
      foreach ($rules as $field => $rule) {
          $ruleParts = explode('|', $rule);

          foreach ($ruleParts as $part) {
              if ($part === 'required' && empty($data[$field])) {
                  $errors[$field] = "$field is required.";
              }
  
              if (strpos($part, 'min:') === 0)  {
                  $min = explode(':', $part)[1];
                  if (isset($data[$field]) && strlen($data[$field]) < $min) {
                      $errors[$field] = "The $field must be at least $min characters.";
                  }
              }
          }     
      }
      return $errors;
  }
}