<?php

namespace App\Handler\trt\set;

Trait Redir
{

/**
 * ha a controller azonosítójával redir érték érkezik (PAR['get_key']_redir)
 * létrehozza  $this->PAR['routes']['redir'] értéket
 */
function set_redir(){
    $redirkey=$this->PAR['get_key'].'_redir'; //wru_redir
  //  echo 'redir----------'.$redirkey;
   $redir=$this->PAR['getT'][$redirkey] ?? 'nincs';
  
   if($redir!='nincs')
   {
       $this->PAR['routes']['redir']=$this->PAR['routes'][ $redir];
   }
//   echo 'redir----------'.$this->PAR['routes']['redir'].'---------------ZZZZ';
}
}