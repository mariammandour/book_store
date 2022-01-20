<?php

function Clean($input)
{

   return  trim(strip_tags(stripslashes($input)));
}


function Validate($input, $flag)
{

   $status = true;

   switch ($flag) {
      case 1:
         # code...
         if (empty($input)) {
            $status = false;
         }
         break;

      case 2:
         # code .... 
         if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $status = false;
         }
         break;


      case 3:
         #code .... 
         if (strlen($input) < 6) {
            $status = false;
         }
         break;


      case 4:
         # code .... 
         if (!filter_var($input, FILTER_VALIDATE_INT)) {
            $status = false;
         }
         break;



      case 5:
         #code .... 
         if (strlen($input) != 11) {
            $status = false;
         }
         break;


      case 6:
         #code .... 
         if (!preg_match('/^[a-zA-Z\s]*$/', $input)) {
            $status = false;
         }
         break;


      case 7:
         # Code ....
         $allowedExt = ['png', 'jpeg','jpg'];
         if (!in_array($input, $allowedExt)) {
            $status = false;
         }
         break;

      case 8:
         # code .... 
         if (!filter_var($input,FILTER_VALIDATE_FLOAT)) {
            $status = false;
         }
         break;
         
         // phone
      case 9:
         #code .... 
         if (!preg_match('/^01[0125][0-9]{8}$/',$input)) {
            $status = false;
         }
         break;

         case 10:
            #code .... 
            if (!preg_match('/^(?:.*)\/(?:pages\/[A-Za-z0-9-]+\/)?(?:profile\.php\?id=)?([A-Za-z0-9.]+)/', $input)) {
               $status = false;
            }
            break;
         
         case 11:
            #code .... 
            if (!preg_match('/^(http(s)?:\/\/)?([\w]+\.)?linkedin\.com\/(pub|in|profile)/', $input)) {
               $status = false;
            }
            break;
         case 12:
            #code .... 
            if (!preg_match('/http(?:s)?:\/\/(?:www\.)?twitter\.com\/([a-zA-Z0-9_]+)/', $input)) {
               $status = false;
            }
            break;
         case 13:
            #code .... 
            if (!preg_match('/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am|instagr.com)\/(\w+)/', $input)) {
               $status = false;
            }
            break;
   }

   return $status;
}



function Messages($Message)
{
   foreach ($Message as $key => $value) {
      # code...
      echo '* ' . $key . ' : ' . $value . '<br>';
   }
}

function Url($url = null){

   return   'http://'.$_SERVER['HTTP_HOST'].'/book_store/Admin/'.$url;

}
