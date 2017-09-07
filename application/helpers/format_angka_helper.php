<?php
function decimal($num) 
 { 
     $result = number_format($num, 2); 
	 return $result;
 }
 
 function decimal_notail($num) 
 { 
     $result = number_format($num, 0); 
	 return $result;
 }

 