<?php

function __autoload($class_name) {
     $parts = preg_split('/(?<=\\w)(?=[A-Z])/', $class_name, null, PREG_SPLIT_NO_EMPTY);
     $dirs = array_reverse($parts);
     $dirs = array_map('strtolower', $dirs);
     $path = ConfigLib::g('directory/base') . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $dirs) . '.class.php';
     if(file_exists($path)) { include_once($path); }
     else { throw new Exception("Could not load $class_name, looking in $path."); }
}

function ufix($url = '', $append_mtime = false) {
     $full_url = dirname($_SERVER['SCRIPT_NAME']);
     $url = '/' . ltrim($url,'/');
     $full_url = $full_url == '/' ? $url : $full_url . $url;
     if($append_mtime) {
        $mtime = filemtime(ConfigLib::g('directory/web') . $url);
        $full_url .= '?' . $mtime;
     }
     return $full_url;
}
function eUfix($url = '', $append_mtime = false) { echo ufix($url,$append_mtime); }

function url($controller = null, $view = null, $params = array(), $url_params = array()) {
     $url = ufix(basename($_SERVER['SCRIPT_NAME']) . '/');
     if($controller) { $url .= $controller . '/'; }
     if($view) { $url .= $view . '/'; }
     if(is_array($params)) { $url .= implode('/', $params); }
     else { $url .= $params; }
     $url = rtrim($url,'/');
     
     $url_params = http_build_query($url_params);
     if($url_params) { $url .= '?' . $url_params; }     
     return $url;
}
function eUrl($controller = null, $view = null, $params = array(), $url_params = array()) { echo url($controller, $view, $params, $url_params); }

function img($src, $class = '') {
     return sprintf(' <img src="%s" class="%s" alt="%s" /> ', ufix('img/' . $src), $class, basename($src));
}
function eImg($src, $class = '') { echo img($src, $class); }

function icon($icon) {
     return img('icons/' . $icon . '.png');
}
function eIcon($icon) { echo icon($icon); }

function isError($fieldname, $errors) {
    if(isset($errors[$fieldname])) return true;
    return false;
}
function eIsError($fieldname, $errors) { echo isError($fieldname, $errors) ? 'error' : ''; }

function ePost($key, $default = '') { echo isset($_POST[$key]) ? $_POST[$key] : $default; }
function rPost($key, $default = '') { return isset($_POST[$key]) ? $_POST[$key] : $default; }

//------------------------------------------ 
// This function returns the necessary 
// size to show some string in display 
// For example: 
// $a = strlen_layout("WWW"); // 49 
// $a = strlen_layout("..."); // 16 
// $a = strlen_layout("Hello World"); // 99 
// 
// http://www.php.net/manual/en/function.strlen.php#76043
//------------------------------------------ 
function strlen_pixels($text) { 

	$text = iconv("UTF-8", "ASCII//IGNORE", $text);

    /* 
        Pixels utilized by each char (Verdana, 10px, non-bold) 
        04: j 
        05: I\il,-./:; <espace> 
        06: J[]f() 
        07: t 
        08: _rz* 
        09: ?csvxy 
        10: Saeko0123456789$ 
        11: FKLPTXYZbdghnpqu 
        12: AÇBCERV 
        13: <=DGHNOQU^+ 
        14: w 
        15: m 
        16: @MW 
    */ 

    // CREATING ARRAY $ps ('pixel size') 
    // Note 1: each key of array $ps is the ascii code of the char. 
    // Note 2: using $ps as GLOBAL can be a good idea, increase speed 
    // keys:    ascii-code 
    // values:  pixel size 

    // $t: array of arrays, temporary 
    $t[] = array_combine(array(106), array_fill(0, 1, 4)); 

    $t[] = array_combine(array(73,92,105,108,44), array_fill(0, 5, 5)); 
    $t[] = array_combine(array(45,46,47,58,59,32), array_fill(0, 6, 5)); 
    $t[] = array_combine(array(74,91,93,102,40,41), array_fill(0, 6, 6)); 
    $t[] = array_combine(array(116), array_fill(0, 1, 7)); 
    $t[] = array_combine(array(95,114,122,42), array_fill(0, 4, 8)); 
    $t[] = array_combine(array(63,99,115,118,120,121), array_fill(0, 6, 9)); 
    $t[] = array_combine(array(83,97,101,107), array_fill(0, 4, 10)); 
    $t[] = array_combine(array(111,48,49,50), array_fill(0, 4, 10)); 
    $t[] = array_combine(array(51,52,53,54,55,56,57,36), array_fill(0, 8, 10)); 
    $t[] = array_combine(array(70,75,76,80), array_fill(0, 4, 11)); 
    $t[] = array_combine(array(84,88,89,90,98), array_fill(0, 5, 11)); 
    $t[] = array_combine(array(100,103,104), array_fill(0, 3, 11)); 
    $t[] = array_combine(array(110,112,113,117), array_fill(0, 4, 11)); 
    $t[] = array_combine(array(65,195,135,66), array_fill(0, 4, 12)); 
    $t[] = array_combine(array(67,69,82,86), array_fill(0, 4, 12)); 
    $t[] = array_combine(array(78,79,81,85,94,43), array_fill(0, 6, 13)); 
    $t[] = array_combine(array(60,61,68,71,72), array_fill(0, 5, 13)); 
    $t[] = array_combine(array(119), array_fill(0, 1, 14)); 
    $t[] = array_combine(array(109), array_fill(0, 1, 15)); 
    $t[] = array_combine(array(64,77,87), array_fill(0, 3, 16));   
   
    // merge all temp arrays into $ps 
    $ps = array(); 
    foreach($t as $sub) $ps = $ps + $sub; 
   
    // USING ARRAY $ps 
    $total = 1; 
    for($i=0; $i<mb_strlen($text); $i++) { 
    	$j = ord(mb_strcut($text,$i,1));
        $temp = isset($ps[$j]) ? $ps[$j] : false;
        if (!$temp) $temp = 10.5; // default size for 10px 
        $total += $temp; 
    } 
    return $total; 
} 

// http://www.php.net/manual/en/function.date-diff.php#101771
function dateDifference($startDate, $endDate = null) 
{ 
    if($endDate === null) { $endDate = time(); }

    if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate) 
        return false; 

    $years = date('Y', $endDate) - date('Y', $startDate); 

    $endMonth = date('n', $endDate); 
    $startMonth = date('n', $startDate); 
    
    // Calculate months 
    $months = $endMonth - $startMonth; 
    
    if ($months < 0)  { 
        $months += 12; 
        $years--; 
    } 
    if ($years < 0) 
        return false; 
    
    // Calculate the days 
    $offsets = array(); 
    if ($years > 0) 
        $offsets[] = $years . (($years == 1) ? ' year' : ' years'); 
    if ($months > 0) 
        $offsets[] = $months . (($months == 1) ? ' month' : ' months'); 
    $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now'; 

    $days = $endDate - strtotime($offsets, $startDate); 
    $days = date('z', $days);    

    return array($years, $months, $days); 
}

function eDateDifference($startDate, $endDate = null)
{
    $split = dateDifference($startDate, $endDate);
    if($split === false) { echo 'invalid dates'; return; }
    $out = '';
    $out .= $split[0] ? $split[0] . ($split[0] > 1 ? ' years ' : ' year ') : '';
    $out .= $split[1] ? $split[1] . ($split[1] > 1 ? ' months ' : ' month ') : '';
    $out .= $split[2] ? $split[2] . ($split[2] > 1 ? ' days ' : ' day ') : ' 0 days ';
    echo trim($out);
}

function _($text, $lang = null) 
{
	echo TranslateLib::translateText($text, $lang);
}

function dt($datetime, $style = 'long')
{
    if(!$datetime)
    {
        return '';
    }
    elseif(is_numeric($datetime))
    {
        switch($style)
        {
            case 'short':
                $format = 'H:i';
                break;
            case 'medium':
                $format = 'd M H:i';
                break;
            case 'long':
            default:
                $format = 'Y/m/d H:i';
        }
        return date($format,$datetime);
    }
    else
    {
        if(preg_match('~([0-9]{2,4})/([0-9]{1,2})/([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2})~',$datetime,$matches))
        {
            return mktime( $matches[4], $matches[5], 0, $matches[2], $matches[3], $matches[1] );
        }
        throw new Exception("Invalid datetime format: '$datetime'' (YYYY/MM/DD HH:MM)");
    }
    return false;
}

// http://stackoverflow.com/questions/1017599/how-do-i-remove-accents-from-characters-in-a-php-string
function remove_accents($string) {
    if ( !preg_match('/[\x80-\xff]/', $string) )
        return $string;

    $chars = array(
        // Decompositions for Latin-1 Supplement
        chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
        chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
        chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
        chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
        chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
        chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
        chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
        chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
        chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
        chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
        chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
        chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
        chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
        chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
        chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
        chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
        chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
        chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
        chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
        chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
        chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
        chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
        chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
        chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
        chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
        chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
        chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
        chr(195).chr(191) => 'y',
        // Decompositions for Latin Extended-A
        chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
        chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
        chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
        chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
        chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
        chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
        chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
        chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
        chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
        chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
        chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
        chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
        chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
        chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
        chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
        chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
        chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
        chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
        chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
        chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
        chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
        chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
        chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
        chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
        chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
        chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
        chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
        chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
        chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
        chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
        chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
        chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
        chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
        chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
        chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
        chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
        chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
        chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
        chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
        chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
        chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
        chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
        chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
        chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
        chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
        chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
        chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
        chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
        chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
        chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
        chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
        chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
        chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
        chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
        chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
        chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
        chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
        chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
        chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
        chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
        chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
        chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
        chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
        chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
    );

    $string = strtr($string, $chars);

    return $string;
}

function l($type,$level,$text)
{
    LogLib::log($type,$level,$text);
}