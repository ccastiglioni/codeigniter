<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('constructEmail')) {
	function constructEmail($hash,$name){
		$logo    = base_url('assets/frontend/images/logo.png');
		$urlhash = base_url('dashboard/do.hash/'.$hash);
		$url     = base_url('login');

		$msg  = "<table align='center' cellspacing='0' id='m_4378950839619069710container' cellpadding='0'>
		    <tbody>
		    <tr>
		      <td>
		        <table cellspacing='0' id='m_4378950839619069710content' cellpadding='0'>
		          <tbody>
		          <tr>
		            <td id='m_4378950839619069710header'>
		              <table cellspacing='0' cellpadding='0'>
		                <tbody>
		                <tr>
		                  <td width='250' id='m_4378950839619069710logo'>
							<img src='$logo' id='m_4378950839619069710amazonLogo' class='CToWUd'>                  </td>
		                  <td width='250' id='m_4378950839619069710title' valign='top' align='right'><p> Login authentication</p></td>
		                </tr>
		                </tbody>
		              </table>
		            </td>
		          </tr>
		          <tr>
		            <td id='m_4378950839619069710verificationMsg'>
		              <p><span class='il'>Hello $name, </span>to authenticate please use the following One Time Password :</p>
		              <p class='m_4378950839619069710otp'> $hash </p>
		              <p> This code expires in 24h!</p>
		            </td>
		          </tr>
		          <tr>
		            <td id='m_4378950839619069710accountSecurity'>
		              <p>
		              To check your email use this code to login to the site. <br> in : $url 
		              </p>
		            </td>
		          </tr>
		          <tr>
		            <td id='m_4378950839619069710closing'>
		              <p>We hope to see you again soon.
		              </p>
		            </td>
		          </tr>
		          </tbody>
		        </table>
		      </td>
		    </tr>
		    </tbody>
		  </table>";
		return $msg ;
    }
}
 
if (!function_exists('randomLetterNum')) {
	function randomLetterNum(){

	 $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 3);
		$storeMe = bin2hex( substr(md5(microtime()),rand(0,29),3));
		return $storeMe . strtoupper( $randomletter);
		  
	}
}
 
if (!function_exists('activeCheck')) {
	function activeCheck($urlSegment){
		$ci =& get_instance();
		$ci->load->database();

		if(is_array($urlSegment)){
			foreach ($urlSegment as $url) {
				if($ci->uri->segment(1) == $url)
					return "class='active'";
			}
		}else{
			if ($ci->uri->segment(1) == $urlSegment)
				return "class='active'";
			else
				return "";	
		}
	}
}
 
if(!function_exists('format_numbers')){ 
function format_numbers($amount, $casas, $separador=','){
   $amountformat = substr($amount, 0, - $casas) .$separador. substr($amount, -$casas);
   return $amountformat;
  }
}

if(!function_exists('ms')){ 
    function ms($array){
        print_r(json_encode($array));
        exit(0);
    }
}

if (!function_exists('isMobile')) {
    function isMobile() {
    	$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
    	return $isMobile;
    }
}

if (!function_exists('back')) {
	function back($default = '') {
		$default = base_url($default);
		return (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : $default;
		
	}
}

if (!function_exists('onlyNumbers')) {

    function onlyNumbers($value) {
        return preg_replace('/\D/', '', $value);
    }
}

if (!function_exists('get_file_extension'))
{
	function get_file_extension($file_name)
	{
		return substr(strrchr($file_name,'.'),1);
	}
}

if ( ! function_exists('config'))
{
	function config($i)
	{
		$ci =& get_instance();
		$ci->load->database();
		
		$sql = "SELECT dsConteudo FROM ".$ci->db->dbprefix('config')." WHERE dsConfig = '".$i."'";
		$row = $ci->db->query($sql);
		
		if ($row->num_rows() > 0)
		{
			return $row->row(0)->dsConteudo;	
		}	
	}
}

if ( ! function_exists('dt'))
{
	function dt($data)
	{
		$dataN = substr($data, 2, 1);
		
		if($dataN == '/')
		{
			return implode('-', array_reverse(explode('/', $data)));
		}
		else
		{
			return implode('/', array_reverse(explode('-', $data)));
		}
	}
}

if ( ! function_exists('dthr'))
{
	function dthr($data)
	{
		$dataE	= explode(' ', $data);
		$dataN	= substr($dataE[0], 2, 1);

		if($dataN == '/')
		{
			return implode('-', array_reverse(explode('/', $dataE[0]))).' - '.$dataE[1];
		}
		else
		{
			return implode('/', array_reverse(explode('-', $dataE[0]))).' - '.$dataE[1];
		}
	}
}
 function validaCPF($number) {

    $cpf = preg_replace('/[^0-9]/', "", $number);

    if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
        return false;
    }
    $number_quantity_to_loop = [9, 10];
    foreach ($number_quantity_to_loop as $item) {
        $sum = 0;
        $number_to_multiplicate = $item + 1;
  
        for ($index = 0; $index < $item; $index++) {
            $sum += $cpf[$index] * ($number_to_multiplicate--);
        }
        $result = (($sum * 10) % 11);
        if ($cpf[$item] != $result) {
            return false;
        }
    }
    return true;
  

}

function dataHojeOntem($data) {
	
	if (date('Y-m-d') == substr($data,0,10))
		$html = 'hoje';
	elseif (date('Y-m-d', strtotime("-1 day")) == substr($data,0,10))
		$html = 'ontem';
	elseif (date('Y-m-d', strtotime("-2 day")) == substr($data,0,10))	
		$html = diaSemana(substr($data,0,10));
	elseif (date('Y-m-d', strtotime("-3 day")) == substr($data,0,10))	
		$html = diaSemana(substr($data,0,10));
	else
		$html = substr(dt(substr($data,0,10)),0,5);
	
	return $html;
}

function diaSemana($data)
{
	$ano =  substr($data, 0, 4);
	$mes =  substr($data, 5, -3);
	$dia =  substr($data, 8, 9);

	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": $diasemana = "Domingo";       		break;
		case"1": $diasemana = "Segunda-Feira"; 		break;
		case"2": $diasemana = "Ter&ccedil;a-Feira";	break;
		case"3": $diasemana = "Quarta-Feira";  		break;
		case"4": $diasemana = "Quinta-Feira";  		break;
		case"5": $diasemana = "Sexta-Feira";   		break;
		case"6": $diasemana = "S&aacute;bado";      break;
	}

	return $diasemana;
}

function getmonth($dateValue=''){
	$dateElements = explode('-', $dateValue);
	  
	switch ($dateElements[1]) {

	   case '01'    :
	     $mo = "Jan";
	   break;
	   case '02'    : 
	    $mo = "Feb";
	     break;
	   case '03'    :  
	   $mo = "Mar";
	    break;
	   case '04'    :  
	   $mo = "Apr";
	    break;
	   case '05'    :  
	   $mo = "Mai";
	    break;
	   case '06'    :  
	   $mo = "jun";
	    break;
	   case '07'    :  
	   $mo = "Jul";
	    break;
	   case '08'    :  
	   $mo = "Aug";
	    break;
	   case '09'    :  
	   $mo = "Sep";
	    break;
	   case '10'    :  
	   $mo = "Oct";
	    break;
	   case '11'    :  
	   $mo = "Nov";
	    break;
	   case '12'    :  
	   $mo = "Dec";
	   break;
}

return $mo;    
}

if (!function_exists('get_file_extension')) {
	function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
}
 
function _ckdir($fn) {
	if (strpos($fn,"/") !== false) {
		$p=substr($fn,0,strrpos($fn,"/"));
		if (!is_dir($p)) {
			_o("Mkdir: ".$p);
			mkdir($p,755,true);
		}
	}
}

function get_string_between_regex ($str,$from,$to) {

    $string = substr($str, strpos($str, $from) + strlen($from));

    if (strstr ($string,$to,TRUE) != FALSE) {

        $string = strstr ($string,$to,TRUE);

    }

    return $string;

}
 

?>
