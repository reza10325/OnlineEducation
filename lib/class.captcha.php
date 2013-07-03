/*
*$cap = new Captcha(); // instantiate Captcha class
*$cap->setBGColor(255,0,0);  // sets background color of image
*$cap->setTextColor(0,255,0); // sets the text color
*$cap->setSize(100,40); // sets the image size. 
*$cap->show(); // outputs captcha image.
*/
<?php

class Captcha {
	private $_width = 200; // image width
	private $_height = 80; // image height
	private $_fontSize = 18; // captcha font size. default 18
	private $_fontFile = "../view/font/arial.ttf";
	private $_bg = array( 'R' => 255, 'G' => 255, 'B' => 255); // default - white background
	private $_textColor = array( 'R' => 0, 'G' => 0, 'B' => 0); // default - black text
	private $_lineColor = array( 'R' => 255, 'G' => 255, 'B' => 255); // default - line color
 
	public function show() {
		$sec_code = $this->generateSecurityCode();
		$img = @imagecreatetruecolor($this->_width, $this->_height);
		$text_color = imagecolorallocate($img, $this->_textColor['R'],
		$this->_textColor['G'], $this->_textColor['B']);
		$bg   = imagecolorallocate($img, $this->_bg['R'], $this->_bg['G'], $this->_bg['B']);
		imagefill($img, 0, 0, $bg);
		$textbox = imageftbbox($this->_fontSize, 0, $this->_fontFile, $sec_code);
		$x = ($this->_width - ($textbox[2] - $textbox[0])) / 2;
		$y = ($this->_height - ($textbox[7] - $textbox[1])) / 2;
		imagefttext($img, $this->_fontSize, 0, $x, $y, $text_color, $this->_fontFile, $sec_code);
		$LineColor = imagecolorallocate($img,$this->_lineColor['R'], $this->_lineColor['G'], 
		$this->_lineColor['B']);//line color
		for ($i = 0; $i <= $this->_width/10 ; $i++) {
			imageline($img, $i*20+mt_rand($this->_height, $this->_width), 0, $i*20-mt_rand($this->_height, $this->_width), $this->_height, $LineColor);
		}
		for ($i = 0 ; $i <= $this->_width/10; $i++) {
			imageline($img, $i*20+mt_rand($this->_height, $this->_width), 39, $i*20-mt_rand($this->_height, $this->_width), 0, $LineColor);
		}
		// create a 200*200 image
		$img2 = imagecreatetruecolor(200, 50);
		// allocate some colors
		$white = imagecolorallocate($img, 255, 255, 255);
		/* generate random arc lines in background */
		imagearc($img,mt_rand($this->_height, $this->_width),10,mt_rand($this->_height, $this->_width),mt_rand($this->_height, $this->_width), 15, 165, $white);
		//imagefilter($img, 7);
		header("Content-Type: image/png"); 
		imagepng($img); 
		imagedestroy($img);
	 }
	 
	function generateSecurityCode() {
	 	$md5_hash = md5(rand(0,999)); 
		$security_code = substr($md5_hash, 15, 6); 
		$_SESSION["sec_code"] = $security_code;
		return $security_code;
	}
	 
	function setBGColor( $r, $g, $b ) {
		$this->_bg['R'] = $r;
		$this->_bg['G'] = $g;
		$this->_bg['B'] = $b;
	}
	 
	function setFontSize( $size ) {
		$this->_fontSize = $size;
	} 
	 
	function setSize( $width, $height ) {
		$this->_width = $width;
		$this->_height = $height;
	}
	 
	function setFont( $font ) {
		$this->_fontFile = $font;
	}

	function setTextColor( $r, $g, $b ) {
		$this->_textColor['R'] = $r;
		$this->_textColor['G'] = $g;
		$this->_textColor['B'] = $b;
	}
  
	public static function isValid( $code ) {
		if( @$_SESSION['sec_code'] == $code )
		return true;
		return false;    
	}
}
?>
