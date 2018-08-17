<?php

class Validation_rules {
	public static function perfectValidation($data){
        foreach ($data as $key => $value) {
          if(!empty($value)){
            if($key=='string'){
                if(ctype_alpha($value)) {
                   return true;
                }
                else{
                   return false;
                }
            }
          }
          else
          {
            return false;
          }
            if($key=='number'){
                if(preg_match("/^[0-9]+$/", $value) == 1) {
                   return true;
                }
                else{
                   return false;
                }

            }
            if($key=='email'){
                if (filter_var($value, FILTER_VALIDATE_EMAIL))
                  {return true;}
                else
                  {return false;}
            }
        }
    }
    public static function validPassword(){
         if(empty($_POST['pwd']) || empty($_POST['cpwd'])) {
          $_SESSION['msg']="Field Can't Be Blank";
          return false;
         }
         else{
          if(strcmp($_POST['pwd'],$_POST['cpwd'])==0){
            return true;
          }
          else{
            return false;
          }
         }
    }
}

               //some validation rules
// ctype_alnum()	Check for alphanumeric characters (a-z A-Z 0-9)
// ctype_alpha()	Check for alphabetic character (a-z A-Z)
// ctype_cntrl()	Check for control characters (\n \r \t)
// ctype_digit()	Check for numeric characters (0-9)
// ctype_graph()	Check if all the characters in a string create visible output
// ctype_lower()	Check for lowercase characters (a-z)
// ctype_print()	Check for printable characters including space
// ctype_punct()	Check for printable characters other than alphanumeric or space
// ctype_space()	Check for spaces in string
// ctype_upper()	Check for uppercase characters
// ctype_xdigit()	Check for hexadecimal characters