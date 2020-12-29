<?php
namespace App\Http;


class Flash {
	
	function message($message){
	 session()->flash('flash_message', $message);
    }

  function create($title=null,$msg,$type){
	session()->flash('flash_message',[
	  'title'=>$title,
	  'message'=>$msg,
	  'type'=>$type
	]);
  }
  
  function success($title,$msg){
	return $this->create($title , $msg ,'success');
  }
  
  function error($title,$msg){
	return $this->create($title , $msg ,'error');
  }
  
  function info($title,$msg){
	return $this->create($title , $msg ,'info');
  }

}