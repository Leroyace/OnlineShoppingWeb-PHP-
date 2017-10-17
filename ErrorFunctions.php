<?php
// we will do our own error handling
error_reporting(0);

// user defined error handling function
function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars) 
{
   // timestamp for the error entry
   $dt = date("Y-m-d H:i:s (T)");

   // define an assoc array of error string
   // in reality the only entries we should
   // consider are E_WARNING, E_NOTICE, E_USER_ERROR,
   // E_USER_WARNING and E_USER_NOTICE
   $errortype = array (
               E_ERROR              => 'Error',
               E_WARNING            => 'Warning',
               E_PARSE              => 'Parsing Error',
               E_NOTICE            => 'Notice',
               E_CORE_ERROR        => 'Core Error',
               E_CORE_WARNING      => 'Core Warning',
               E_COMPILE_ERROR      => 'Compile Error',
               E_COMPILE_WARNING    => 'Compile Warning',
               E_USER_ERROR        => 'User Error',
               E_USER_WARNING      => 'User Warning',
               E_USER_NOTICE        => 'User Notice',
               E_STRICT            => 'Runtime Notice',
               E_RECOVERABLE_ERROR  => 'Catchable Fatal Error'
               );
   // set of errors for which a var trace will be saved
   $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
   
   $err = "<errorentry><br>\n";
   $err .= "\t<datetime>" . $dt . "</datetime><br>\n";
   $err .= "\t<errornum>" . $errno . "</errornum><br>";
   $err .= "\t<errortype>" . $errortype[$errno] . "</errortype><br>\n";
   $err .= "\t<errormsg>" . $errmsg . "</errormsg><br>\n";
   $err .= "\t<scriptname>" . $filename . "</scriptname><br>\n";
   $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum><br>\n";

   if (in_array($errno, $user_errors)) {
       $err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace><br>\n";
   }
   $err .= "</errorentry><br>\n";
   
   // for testing
   // echo $err;

   // save to the error log, and e-mail me if there is a critical user error
   error_log($err, 3, "../uploads/PHPUploaded/error.log");
   if ($errno == E_USER_ERROR) {
       mail("xli@unitec.ac.nz", "Critical User Error", $err, "FROM: PHPPractical@dochyper.unitec.ac.nz");
   }
   
}
?>
