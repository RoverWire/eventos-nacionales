<?php
if( ! function_exists('jgritter_script') ){
	function jgritter_script($arg, $var = ''){
		if( is_array($arg) ){
			$opt = array_keys($arg);
			$tam = count($opt);
			$string = '';
			
			for($i=0; $i<$tam; $i++){				
				$string .= $opt[$i].':';
				if( is_bool($arg[$opt[$i]]) ){
					if( $arg[$opt[$i]] == true ){
						$string .= 'true,';
					}else{
						$string .= 'false,';
					}
				}else{
					$string .= "'".$arg[$opt[$i]]."',";
				}
				
				if( ($i+1) < $tam ){
					$string .= "\r\n";
				}				
			}
			
			$string = "$.gritter.add({\r\n".substr($string, 0, -1)."\r\n});";
			if(!empty($var)){
				$string = 'var '.$var.' = '.$string;
			}			
			return $string;
		
		}else{			
			return false;
		}
	}
	
}

if( ! function_exists('notify_script'))
{
	function notify_script($arg, $tag  = FALSE)
	{
		if(is_array($arg))
		{
			$opt = array_keys($arg);
			$tam = count($opt);
			$string = '';
			
			for($i=0; $i<$tam; $i++)
			{				
				$string .= $opt[$i].':';
				if( is_bool($arg[$opt[$i]]) )
				{
					if( $arg[$opt[$i]] == true )
					{
						$string .= 'true,';
					}
					else
					{
						$string .= 'false,';
					}
				}
				else
				{
					$string .= "'".$arg[$opt[$i]]."',";
				}
				
				if( ($i+1) < $tam)
				{
					$string .= "\r\n";
				}				
			}
			
			$string = "$.notifyBar({\r\n".substr($string, 0, -1)."\r\n});";
			if($tag == TRUE)
			{
				$string = '<script type="text/javascript">'.$string.'</script>'."\n\r";
			}
			
			return $string;
		}
		else
		{
			return FALSE;
		}
	}
}
?>