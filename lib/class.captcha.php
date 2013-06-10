<?php
class Captcha {
	private $_width = 200; // image width
	private $_height = 80; // image height
	private $_fontSize = 18; // captcha font size. default 18
	private $_fontFile = "arial.ttf"; // path-to-font-file
	private $_bg = array( 'R' => 255, 'G' => 255, 'B' => 255); // default - white background
	private $_textColor = array( 'R' => 0, 'G' => 0, 'B' => 0); // default - black text
	private $_lineColor = array( 'R' => 255, 'G' => 255, 'B' => 255); // default - line color
 
 // Generates captcha image.
 // outputs generated image in png format.
 
function showImage() {
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
	/* generate random lines in background */
	for ($i = 0; $i <= 10; $i++) {
		imageline($img, $i*20+mt_rand(4, 26), 0, $i*20-mt_rand(4, 26), 39, $LineColor);
	}
	for ($i = 0; $i <= 10; $i++) {
		imageline($img, $i*20+mt_rand(4, 26), 39, $i*20-mt_rand(4, 26), 0, $LineColor);
	}
	// create a 200*200 image
	$img2 = imagecreatetruecolor(200, 50);
	// allocate some colors
	$white = imagecolorallocate($img, 255, 255, 255);
	/* generate random arc lines in background */
	imagearc($img,mt_rand(10, 26),10,mt_rand(4, 40),mt_rand(4, 40), 15, 165, $white);
	//imagefilter($img, 7);
	header("Content-Type: image/png"); 
	imagepng($img); 
	imagedestroy($img);
 }
 
 // generates captcha security code.    
 function generateSecurityCode() {
 $md5_hash = md5(rand(0,999)); 
 $security_code = substr($md5_hash, 15, 6); 
 $_SESSION["sec_code"] = $security_code;
 return $security_code;
 }
 
 // Sets the background color of captcha image.
 // parameters - $r -> Red, $g -> green, $b -> blue. [ RGB format ]
 
 function setBGColor( $r, $g, $b ) {
 $this->_bg['R'] = $r;
 $this->_bg['G'] = $g;
 $this->_bg['B'] = $b;
 }
 
 /* Sets the font size.
 parameter - The font size. Depending on your version of GD, 
 this should be specified as the pixel size (GD1) or point size (GD2). */
 
 function setFontSize( $size ) {
 $this->_fontSize = $size;
 } 
 
 /* Sets the captcha images size.
 parameters : $width -> image width, $height -> image height. */
 
 function setSize( $width, $height ) {
 $this->_width = $width;
 $this->_height = $height;
 }
  
 /* Sets the font of captcha.
 parameter - path to TrueType font file.  */
 
 function setFont( $font ) {
 $this->_fontFile = $font;
 }
 
 // Sets the text color.
 // parameters - $r -> Red, $g -> green, $b -> blue. [ RGB format ]
  function setTextColor( $r, $g, $b ) {
 $this->_textColor['R'] = $r;
 $this->_textColor['G'] = $g;
 $this->_textColor['B'] = $b;
 }
  
 /* validates captcha. if valid returns true, otherwise false. 
 parameter: $code -> user input to be validated */
 public static function isValid( $code ) {
 if( @$_SESSION['sec_code'] == $code )
 return true;
 return false;    
 }
}
?>
