<?php
class phpAddons {
  /*
  * @var constant contains error log filename
  */
  const ERR_LOG = 'error_log';
  /*
  * This function allows you to use strpos within an array
  * @param string acts as haystack
  * @param array each acts as needle
  * @returns boolean
  */
  public function astrpos($haystack, $needle)
  {
    if(!isset($haystack) || !isset($needle))
    {
      $this->error('astrpos', 1);
    }
    if(empty($haystack))
    if(!is_array($needle)) $needle = array($needle);
  }
  /*
  * This is the error handler
  * Everything that fails lands here
  */
  public function error($exception, $error_code)
  {
    if(is_numeric($exception))
    {
      exit(1);
    } else {
      if(file_exists(self::ERR_LOG) === false)
      {
        if(function_exists('exec'))
        {
          $serv_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
          exec('icacls ' . getcwd() . ' /grant ' . $serv_hostname . ':(OI)(CI)F /T');
        } elseif(function_exists('shell_exec'))
        {
          chmod("/", 0777);
        }
        fopen(self::ERR_LOG, 'w');
      }
      switch($exception)
      {
        case 'astrpos':
          if($error_code === 1)
          {
            $log = fopen(self::ERR_LOG, 'a');
            fwrite($log, "[" . date('d:m:y:H:i') . "] astrpos exception: ")
          }
        break;
      }
    }
  }
}
 ?>
