
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class PHPMailerAutoload {
    
    public function index() 
    {
        require_once('PHPMailer/class.phpmailer.php');
    }
}