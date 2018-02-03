    <?php
    class Helper extends CController
    {
		/*
		 * cut string for UTF8 charactor
		 * author by jiameng1015@126.com
		 * date 2012-03-26
		 * */
    	public static function truncate_utf8_string($string, $length, $etc = '...')
            {
                $result = '';
                $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
                $strlen = strlen($string);
                for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
                    {
                    if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
                            {
                        if ($length < 1.0)
                                    {
                            break;
                        }
                        $result .= substr($string, $i, $number);
                        $length -= 1.0;
                        $i += $number - 1;
                    }
                            else
                            {
                        $result .= substr($string, $i, 1);
                        $length -= 0.5;
                    }
                }
                $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
                if ($i < $strlen)
                    {
                            $result .= $etc;
                }
                return $result;
            }
         
      public static function checkEmail($email)
  	 	{
  	 		$email = trim($email);
    		$pregEmail = "/^[a-z]([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i";
    		return preg_match($pregEmail,$email); 
  	 	 }
  	 public static function checkNumber($number)
  	 	{	
  	 	     $pregNum = "/^\d+$/";
  	 	     return preg_match($pregNum,$number); 
  	     }
     public static function checkChinese($str)
  	 	{
  	 	    $str = trim($str); 
  	 		$pregChinese = "/[\x{4e00}-\x{9fa5}]+/u";
  	 	    return preg_match($pregChinese, $str); 
  	     }
  	 public static function checkURL($str){
  	 		$str = trim($str);
  	 		$pregURL ="/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
  	 		return preg_match($pregURL, $str); 
  	 }
     public static function checkCode($str){
  	 		$str = trim($str);
  	 		$pregCode ="/^[0-9]{6}$/";
  	 		return preg_match($pregCode, $str); 
  	 }
  	 /*验证IP地址格式*/
    public static function checkipaddres($ipaddres) {
		$preg="/\A((([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\.){3}(([0-9]?[0-9])|(1[0-9]{2})|(2[0-4][0-9])|(25[0-5]))\Z/";
		if(preg_match($preg, trim($ipaddres) ))return true;
		return false;
	}
	/*JS转码
	 * @author by jiameng1015@126.com
	 * 
	 * */
	public static function unescape($str){ 
		$ret = ''; 
		$len = strlen($str); 
		for ($i = 0; $i < $len; $i++){ 
		if ($str[$i] == '%' && $str[$i+1] == 'u'){ 
		$val = hexdec(substr($str, $i+2, 4)); 
		if ($val < 0x7f) $ret .= chr($val); 
		else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
		else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
		$i += 5; 
		} 
		else if ($str[$i] == '%'){ 
		$ret .= urldecode(substr($str, $i, 3)); 
		$i += 2; 
		} 
		else $ret .= $str[$i]; 
		} 
		return $ret; 
	} 
	
}
   