## empty() Alternative

```
function is_var_empty($var){

   if(is_array($var)) { // checks for empty array, single dimensional.
           if (count($var) > 0) {
               return false;
           } else {
               return true;
           }
       } elseif(is_object($var)) {
           if (count($var) > 0) {
               return false;
           } else {
               return true;
           }
   } else {         
      if(!isset($var) || $var == false){ return true; } else { // equivilant of empty() 
         $var = trim($var);
         if ($var === 0 || $var === 0.0 || $var == '0' || $var == '0.0' || $var == '0.00' || $var == ''){ return true; } else { return false; } // additional empty checks
      }
   }

}
```
