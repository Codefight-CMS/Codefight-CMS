<?php
//If BASEPATH is not defined, simply exit.
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
|
| Some code replacement like [bold][/bold]
|
*/
class Cf_bbcode_lib {

  var $pattern_replacement  = array(
			'#\[php\]#is' => " &lt;?php ",
			'#\[\/php\]#is' => " ?&gt; ",
			'#\[b\]#is' => " <strong> ",
			'#\[\/b\]#is' => " </strong> ",
                      );

  function output($string){
	//return the formated string
    return preg_replace(array_keys($this->pattern_replacement), array_values($this->pattern_replacement), $string);
  }
}

?>
