<?php
class browser{
	
	/* test :
	 	$ua=getBrowser($_SERVER['HTTP_USER_AGENT']);
		print($yourbrowser= "Your browser: " . $ua['name'] .
	    " " . $ua['version'] . " on " .$ua['platform'] . "<br >");
	*/
	
	function getBrowser($userAgent) 
	{ 
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";
	
	    //First get the platform?
	    if (preg_match('/linux/i', $userAgent)) {
	        $platform = 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
	        $platform = 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $userAgent)) {
	        $platform = 'windows';
	    }
	    
	    // Next get the name of the useragent yes seperately and for good reason
	    if(preg_match('/MSIE/i',$userAgent) && !preg_match('/Opera/i',$userAgent)) 
	    { 
	        $bname = 'Internet Explorer'; 
	        $ub = "MSIE"; 
	    } 
	    elseif(preg_match('/Firefox/i',$userAgent)) 
	    { 
	        $bname = 'Mozilla Firefox'; 
	        $ub = "Firefox"; 
	    } 
	    elseif(preg_match('/Chrome/i',$userAgent)) 
	    { 
	        $bname = 'Google Chrome'; 
	        $ub = "Chrome"; 
	    } 
	    elseif(preg_match('/Safari/i',$userAgent)) 
	    { 
	        $bname = 'Apple Safari'; 
	        $ub = "Safari"; 
	    } 
	    elseif(preg_match('/Opera/i',$userAgent)) 
	    { 
	        $bname = 'Opera'; 
	        $ub = "Opera"; 
	    } 
	    elseif(preg_match('/Netscape/i',$userAgent)) 
	    { 
	        $bname = 'Netscape'; 
	        $ub = "Netscape"; 
	    } 
	    
	    // finally get the correct version number
	    $known = array('Version', $ub, 'other');
	    $pattern = '#(?<browser>' . implode('|', $known) .
	    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    if (!preg_match_all($pattern, $userAgent, $matches)) {
	        // we have no matching number just continue
	    }
	    
	    // see how many we have
	    $i = count($matches['browser']);
	    if ($i != 1) {
	        //we will have two since we are not using 'other' argument yet
	        //see if version is before or after the name
	        if (strripos($u_agent,"Version") < strripos($userAgent,$ub)){
	            $version= $matches['version'][0];
	        }
	        else {
	            $version= $matches['version'][1];
	        }
	    }
	    else {
	        $version= $matches['version'][0];
	    }
	    
	    // check if we have a number
	    if ($version==null || $version=="") {$version="?";}
	    
	    return array(
	        'userAgent' => $userAgent,
	        'name'      => $bname,
	        'version'   => $version,
	        'platform'  => $platform,
	        'pattern'    => $pattern
	    );
	} 

		/* test :
			print "Your Operating System: " .
		    getOS($_SERVER['HTTP_USER_AGENT']). "<br>";
		*/
		
	function getOS($userAgent) {
	  // Create list of operating systems with operating system name as array key 
		$oses = array (
			'iPhone' => '(iPhone)',
			'Windows 3.11' => 'Win16',
			'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
			'Windows 98' => '(Windows 98)|(Win98)',
			'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
			'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
			'Windows 2003' => '(Windows NT 5.2)',
			'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
			'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
			'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'Windows ME' => 'Windows ME',
			'Open BSD'=>'OpenBSD',
			'Sun OS'=>'SunOS',
			'Linux'=>'(Linux)|(X11)',
			'Safari' => '(Safari)',
			'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
			'QNX'=>'QNX',
			'BeOS'=>'BeOS',
			'OS/2'=>'OS/2',
			'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
		);
	
		foreach($oses as $os=>$pattern){ // Loop through $oses array
	    // Use regular expressions to check operating system type
			if(eregi($pattern, $userAgent)) { // Check if a value in $oses array matches current user agent.
				return $os; // Operating system was matched so return $oses key
			}
		}
		return 'Unknown'; // Cannot find operating system so return Unknown
	}


}
?>