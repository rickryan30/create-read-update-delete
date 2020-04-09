<?php

if(!function_exists(__NAMESPACE__ . '\url_segment')) {
    function url_segment($segment=null){
        $request = trim($_SERVER['REQUEST_URI'], "/");
        if(!empty($request)) {
            $url = explode('/', $request);
            return (isset($url[$segment])) ? $url[$segment] : '';
        }
    }
}

if(!function_exists(__NAMESPACE__ . '\in_array_foreach_custom')) {
    function in_array_foreach_custom($needle, $haystack=array(), $strict = false) {
        $holder = array();

        if($haystack != null){
            foreach ($haystack as $key => $item) {
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_foreach_custom($needle, $item, $strict))) {
                    array_push($holder, (object) $haystack[$key]);
                }
            }
        }

        return ($holder != null) ? (object) $holder : false;
    }
}

if(!function_exists(__NAMESPACE__ . '\in_array_foreach_custom2')) {
    function in_array_foreach_custom2($key, $value, $haystack = array(), $strict = false) {
        $return = array();
        if($haystack != null){
            foreach ($haystack as $k => $subarray){
                if (isset($subarray[$key]) && ($strict ? $subarray[$key] === $value : $subarray[$key] == $value)) {
                    array_push($return, (object) $subarray);
                }
            }
        }
        return ($return != null) ? (object) $return : false;
    }
}

if(!function_exists(__NAMESPACE__ . '\load_template')) {
    function load_template($templateName){
        if($templateName){
            if(file_exists(ROOT.DS.'views'.DS.'content_holders'.DS.$templateName.".php")){
                include_once ROOT.DS.'views'.DS.'content_holders'.DS.$templateName.".php";
            }
        }
    }
}

if(!function_exists(__NAMESPACE__ . '\is_https')) {
    function is_https(){

        if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off'){
            return TRUE;

        }elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https'){

            return TRUE;

        }elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off'){
            return TRUE;

        }

        return FALSE;
    }
}

if(!function_exists(__NAMESPACE__ . '\get_base_url')) {
    function get_base_url(){
        $base_url = unserialize(base_url);#'http://'.$_SERVER['SERVER_NAME'].'/singleevents-2/';

        if (empty($base_url)){

            if(isset($_SERVER['SERVER_ADDR'])){

                if(strpos($_SERVER['SERVER_ADDR'], ':') !== FALSE){
                    $server_addr = '['.$_SERVER['SERVER_ADDR'].']';
                }else{
                    $server_addr = $_SERVER['SERVER_ADDR'];

                }

                $base_url = ($this->is_https() ? 'https' : 'http').'://'.$server_addr.substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));

            }else{
                $base_url = 'http://localhost/';

            }
            return $base_url;

        }else{
            return false;
        }
    }
}

if(!function_exists(__NAMESPACE__ . '\base_url')) {
    function base_url($uri = '', $protocol = NULL){
        $base_url = 'https://'.$_SERVER['SERVER_NAME'].'/';
        if (isset($protocol)){
            if($protocol === '') {
                $base_url = substr($base_url, strpos($base_url, '//'));
            }else{
                $base_url = $protocol.substr($base_url, strpos($base_url, '://'));
            }
        }

        return $base_url._uri_string($uri);
    }
}

if(!function_exists(__NAMESPACE__ . '\_uri_string')) {
    function _uri_string($uri){
        is_array($uri) && $uri = implode('/', $uri);
        return ltrim($uri, '/');
    }
}

if(!function_exists(__NAMESPACE__ . '\start_session')) {
    function start_session($data,$val=null){
        session_start();
        if(is_array($data)){
            if($data){
                foreach($data as $key=>$row){
                    $_SESSION[$key] = $row;
                }
            }
        }else{
            $_SESSION[$data] = $val;
        }
    }
}

if(!function_exists(__NAMESPACE__ . '\session_destroy')) {
    function session_destroy(){
        session_start();
        if($_SESSION){
            foreach($_SESSION as $key=>$row){
                unset($_SESSION[$key]);
            }
        }
    }
}

if(!function_exists(__NAMESPACE__ . '\get_session')) {
    function get_session($data){
        session_start();
        return $_SESSION[$data];
    }
}

if(!function_exists(__NAMESPACE__ . '\sql_result')) {
    function sql_result($sql) {
        $connEV = mysqli_connect('localhost', 'id10330233_rickryan', 'stimulator1', 'id10330233_sample');
        $sql_result = mysqli_query ($connEV, $sql) or die ('Could not execute MySQL query: '.$sql.' . Error: '.mysqli_error($connEV));
        return $sql_result;
    }
}

if(!function_exists(__NAMESPACE__ . '\ReadHTML')) {
    function ReadHTML($str) {
        return htmlspecialchars(stripslashes($str), ENT_QUOTES);
    }
}

if(!function_exists(__NAMESPACE__ . '\ReadDB')) {
    function ReadDB($str) {
        return stripslashes($str);
    }
}

if(!function_exists(__NAMESPACE__ . '\admin_date')) {
    function admin_date($db_date) {
        return date("M j, Y, g:i a",strtotime($db_date));
    }
}

// function for safety SELECT, INSERT, UPDATE and DELETE sql statements
if(!function_exists(__NAMESPACE__ . '\SafetyDB')){
    function SafetyDB($str) {
        global $connEV;
        return mysqli_real_escape_string($connEV, $str);
    }
}

// function for escaping quotes in INSERT and UPDATE sql statements
if(!function_exists(__NAMESPACE__ . '\SaveDB')){
    function SaveDB($str) {
        if (!get_magic_quotes_gpc()) {
            return addslashes($str);
        } else {
            return $str;
        }
    }
}

// function that invert colors in HTML
if(!function_exists(__NAMESPACE__ . '\invert_colour')){
    function invert_colour($start_colour) {
        if($start_colour!='') {
            $colour_red = hexdec(substr($start_colour, 1, 2));
            $colour_green = hexdec(substr($start_colour, 3, 2));
            $colour_blue = hexdec(substr($start_colour, 5, 2));

            $new_red = dechex(255 - $colour_red);
            $new_green = dechex(255 - $colour_green);
            $new_blue = dechex(255 - $colour_blue);

            if (strlen($new_red) == 1) {$new_red .= '0';}
            if (strlen($new_green) == 1) {$new_green .= '0';}
            if (strlen($new_blue) == 1) {$new_blue .= '0';}

            $new_colour = '#'.$new_red.$new_green.$new_blue;
        } else {
            $new_colour = '#000000';
        }
        return $new_colour;
    }
}
 

// function that generate color picker and color fields
if(!function_exists(__NAMESPACE__ . '\color_field')){
    function color_field($field, $color) {
        $picker  = '<input id="'.$field.'" name="'.$field.'" type="text" size="7" value="'.$color.'" style="background-color:'.$color.';" />';
        $picker .= '<button class="jscolor{valueElement:\''.$field.'\', styleElement:\''.$field.'\', hash:true, required:false, closable:true, width:260, height:150} color_field">&nbsp;</button><sub> - you can pick the color from pallette or you can put it manualy</sub>';

        return $picker;
    }
}


// function that remove unnecessary characters, quotes, spaces in the meta tags
if(!function_exists(__NAMESPACE__ . '\remove_quote')){
    function remove_quote($key_text) {
        $key_text = str_replace("�", "a", $key_text);
        $key_text = str_replace("�", "a", $key_text);
        $key_text = str_replace("�", "a", $key_text);
        $key_text = str_replace("�", "a", $key_text);
        $key_text = str_replace("�", "e", $key_text);
        $key_text = str_replace("�", "e", $key_text);
        $key_text = str_replace("�", "i", $key_text);
        $key_text = str_replace("�", "o", $key_text);
        $key_text = str_replace("�", "o", $key_text);
        $key_text = str_replace("�", "o", $key_text);
        $key_text = str_replace("�", "u", $key_text);
        $key_text = str_replace("\t", "", $key_text);
        $key_text = str_replace("\r", "", $key_text);
        $key_text = str_replace("\n", "", $key_text);
        $key_text = str_replace("&reg;", "", $key_text);
        $key_text = str_replace("&nbsp;", "", $key_text);
        $key_text = str_replace("&trade;", "", $key_text);
        $key_text = str_replace("&amp;", "&", $key_text);
        $key_text = str_replace("&nbsp;", " ", $key_text);
        $key_text = str_replace("&rsquo;", " ", $key_text);
        $key_text = str_replace("&hellip;", ".. ", $key_text);
        $key_text = str_replace("&ntilde;", ".. ", $key_text);
        $key_text = str_replace("&ldquo;", ".. ", $key_text);
        $key_text = str_replace("&rdquo;", ".. ", $key_text);
        $key_text = str_replace("                       ", " ", $key_text);
        $key_text = str_replace("                      ", " ", $key_text);
        $key_text = str_replace("                     ", " ", $key_text);
        $key_text = str_replace("                    ", " ", $key_text);
        $key_text = str_replace("                   ", " ", $key_text);
        $key_text = str_replace("                  ", " ", $key_text);
        $key_text = str_replace("                 ", " ", $key_text);
        $key_text = str_replace("                ", " ", $key_text);
        $key_text = str_replace("               ", " ", $key_text);
        $key_text = str_replace("              ", " ", $key_text);
        $key_text = str_replace("             ", " ", $key_text);
        $key_text = str_replace("            ", " ", $key_text);
        $key_text = str_replace("           ", " ", $key_text);
        $key_text = str_replace("          ", " ", $key_text);
        $key_text = str_replace("         ", " ", $key_text);
        $key_text = str_replace("        ", " ", $key_text);
        $key_text = str_replace("       ", " ", $key_text);
        $key_text = str_replace("      ", " ", $key_text);
        $key_text = str_replace("     ", " ", $key_text);
        $key_text = str_replace("    ", " ", $key_text);
        $key_text = str_replace("   ", " ", $key_text);
        $key_text = str_replace("  ", " ", $key_text);
        $key_text = str_replace("'", "", $key_text);
        $key_text = str_replace('"', '', $key_text);
        return $key_text;
    }
}

// function that cut text to necessay character
if(!function_exists(__NAMESPACE__ . '\cutText')){
    function cutText($strMy, $maxLength)
    {
        $ret = substr($strMy, 0, $maxLength);
        if (substr($ret, strlen($ret)-1,1) != " " && strlen($strMy) > $maxLength) {
            $ret1 = substr($ret, 0, strrpos($ret," "))." ...";
        } elseif(substr($ret, strlen($ret)-1,1) == " " && strlen($strMy) > $maxLength) {
            $ret1 = $ret." ...";
        } else {
            $ret1 = $ret;
        }
        return $ret1;
    }
}


// function for resize image. If $thumbnail is not set then creates the full description image
if(!function_exists(__NAMESPACE__ . '\Resize_File')){
    function Resize_File($full_file, $max_width, $max_height, $thumbnail="") {

        if (preg_match("/\.png$/i", $full_file)) {
            $img = imagecreatefrompng($full_file);
        }

        if (preg_match("/\.(jpg|jpeg)$/i", $full_file)) {
            $img = imagecreatefromjpeg($full_file);
        }

        if (preg_match("/\.gif$/i", $full_file)) {
            $img = imagecreatefromgif($full_file);
        }

        $FullImage_width = imagesx($img);
        $FullImage_height = imagesy($img);

        if (isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0 && $FullImage_width>$max_width && $FullImage_height>$max_height) {
            $new_width = $max_width;
            $new_height = $max_height;
        } elseif (isset($max_width) && $max_width != 0 && $FullImage_width>$max_width) {
            $new_width = $max_width;
            $new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
        } elseif (isset($max_height) && $max_height != 0 && $FullImage_height>$max_height) {
            $new_height = $max_height;
            $new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
        } else {
            $new_height = $FullImage_height;
            $new_width = $FullImage_width;
        }

        $full_id = imagecreatetruecolor((int)$new_width, (int)$new_height);
        if (preg_match("/\.png$/i", $full_file) or preg_match("/\.gif$/i", $full_file)) {
            imagecolortransparent($full_id, imagecolorallocatealpha($full_id, 0, 0, 0, 0));
        }
        imagecopyresampled($full_id, $img, 0, 0, 0, 0, (int)$new_width, (int)$new_height, $FullImage_width, $FullImage_height);


        if (preg_match("/\.(jpg|jpeg)$/i", $full_file)) {
            if($thumbnail!="") {
                imagejpeg($full_id, $thumbnail, 100);
            } else {
                imagejpeg($full_id, $full_file, 100);
            }
        }

        if (preg_match("/\.png$/i", $full_file)) {
            if($thumbnail!="") {
                imagepng($full_id, $thumbnail);
            } else {
                imagepng($full_id, $full_file);
            }
        }

        if (preg_match("/\.gif$/i", $full_file)) {
            if($thumbnail!="") {
                imagegif($full_id, $thumbnail);
            } else {
                imagegif($full_id, $full_file);
            }
        }

        imagedestroy($full_id);
        unset($max_width);
        unset($max_height);
    }
}



// Returns filesystem-safe string after cleaning, filtering, and trimming input
if (!function_exists(__NAMESPACE__ . '\str_file_filter')) {
    function str_file_filter($str, $sep = '_', $strict = false, $trim = 248) {

        $str = strip_tags(htmlspecialchars_decode(strtolower($str))); // lowercase -> decode -> strip tags
        $str = str_replace("%20", ' ', $str); // convert rogue %20s into spaces
        $str = preg_replace("/%[a-z0-9]{1,2}/i", '', $str); // remove hexy things
        $str = str_replace("&nbsp;", ' ', $str); // convert all nbsp into space
        $str = preg_replace("/&#?[a-z0-9]{2,8};/i", '', $str); // remove the other non-tag things
        $str = preg_replace("/\s+/", $sep, $str); // filter multiple spaces
        $str = preg_replace("/\.+/", '.', $str); // filter multiple periods
        $str = preg_replace("/^\.+/", '', $str); // trim leading period

        if ($strict) {
            $str = preg_replace("/([^\w\d\\" . $sep . ".])/", '', $str); // only allow words and digits
        } else {
            $str = preg_replace("/([^\w\d\\" . $sep . "\[\]\(\).])/", '', $str); // allow words, digits, [], and ()
        }

        $str = preg_replace("/\\" . $sep . "+/", $sep, $str); // filter multiple separators
        $str = substr($str, 0, $trim); // trim filename to desired length, note 255 char limit on windows

        return $str;
    }
}

// function that get time zones
if(!function_exists(__NAMESPACE__ . '\get_timezones')){
    function get_timezones() {
        $o = array();

        $t_zones = timezone_identifiers_list();

        foreach($t_zones as $a) {
            $t = '';

            try {
                //this throws exception for 'US/Pacific-New'
                $zone = new DateTimeZone($a);

                $seconds = $zone->getOffset( new DateTime("now" , $zone) );
                $hours = sprintf( "%+02d" , intval($seconds/3600));
                $minutes = sprintf( "%02d" , ($seconds%3600)/60 );

                $t = $a ."  [ $hours:$minutes ]" ;

                $o[$a] = $t;
            }

                //exceptions must be catched, else a blank page
            catch(Exception $e) {
                //die("Exception : " . $e->getMessage() . '<br />');
                //what to do in catch ? , nothing just relax
            }
        }

        ksort($o);

        return $o;
    }
}


// list of all the fonts in select drop-down menu
if (!function_exists(__NAMESPACE__ . '\font_family_list')) {
    function font_family_list($fontSelected) {

        $fonts = array(
            'Arial'=>'Arial,Helvetica Neue,Helvetica,sans-serif',
            'Arial Black'=>'Arial Black,Arial Bold,Gadget,sans-serif',
            'Arial Narrow'=>'Arial Narrow,Arial,sans-serif',
            'Brush Script MT'=>'Brush Script MT,cursive',
            'Book Antiqua'=>'Book Antiqua,Palatino,Palatino Linotype,Palatino LT STD,Georgia,serif',
            'Century Gothic'=>'Century Gothic,CenturyGothic,AppleGothic,sans-serif',
            'Comic Sans MS'=>'Comic Sans MS, cursive, sans-serif',
            'Copperplate'=>'Copperplate,Copperplate Gothic Light,fantasy',
            'Courier New'=>'Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace',
            'Gill Sans'=>'Gill Sans,Gill Sans MT,Calibri,sans-serif',
            'Garamond'=>'Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif',
            'Georgia'=>'Georgia,Times,Times New Roman,serif',
            'Helvetica'=>'Helvetica Neue,Helvetica,Arial,sans-serif',
            'Impact'=>'Impact, Charcoal, sans-serif',
            'Lucida Bright'=>'Lucida Bright,Georgia,serif',
            'Lucida Console'=>'Lucida Console,Lucida Sans Typewriter,monaco,Bitstream Vera Sans Mono,monospace',
            'Lucida Sans Unicode'=>'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'Palatino'=>'Palatino,Palatino Linotype,Palatino LT STD,Book Antiqua,Georgia,serif',
            'Papyrus'=>'Papyrus,fantasy',
            'Tahoma'=>'Tahoma,Verdana,Segoe,sans-serif',
            'Times New Roman'=>'TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif',
            'Trebuchet MS'=>'Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif',
            'Verdana'=>'Verdana,Geneva,sans-serif',
            'inherit'=>'inherit',
            '-- custom fonts --'=>'--custom fonts--',
            'Azbuka04'=>'Azbuka04,Helvetica Neue,Helvetica,sans-serif',
            'Avalon-Bold'=>'Avalon-Bold,Helvetica Neue,Helvetica,sans-serif',
            'Avalon-Plain'=>'Avalon-Plain,Helvetica Neue,Helvetica,sans-serif',
            'Cour'=>'Cour,Helvetica Neue,Helvetica,sans-serif',
            'DSNote'=>'DSNote,Helvetica Neue,Helvetica,sans-serif',
            'HebarU'=>'HebarU,Helvetica Neue,Helvetica,sans-serif',
            'Lato-Regular'=>'Lato-Regular,Helvetica Neue,Helvetica,sans-serif',
            'Montserrat-Regular'=>'Montserrat-Regular,Helvetica Neue,Helvetica,sans-serif',
            'MTCORSVA'=>'MTCORSVA,Helvetica Neue,Helvetica,sans-serif',
            'Nicoletta_script'=>'Nicoletta_script,Helvetica Neue,Helvetica,sans-serif',
            'Oswald-Light'=>'Oswald-Light,Helvetica Neue,Helvetica,sans-serif',
            'Oswald-Regular'=>'Oswald-Regular,Helvetica Neue,Helvetica,sans-serif',
            'Raleway-Regular'=>'Raleway-Regular,Helvetica Neue,Helvetica,sans-serif',
            'Regina Kursiv'=>'Regina Kursiv,Helvetica Neue,Helvetica,sans-serif',
            'Segoe-UI'=>'Segoe-UI,Helvetica Neue,Helvetica,sans-serif',
            'Tex Gyre Adventor'=>'Tex Gyre Adventor,Helvetica Neue,Helvetica,sans-serif',
            'Ubuntu-R'=>'Ubuntu-R,Helvetica Neue,Helvetica,sans-serif'
        );

        $listInput = "";
        foreach($fonts as $Font=>$FontFull) {
            $listInput .= "<option value='".$FontFull."'";
            if($FontFull==$fontSelected) $listInput .= " selected='selected'";
            if($Font=='-- custom fonts --') $listInput .= " disabled";
            $listInput .= ">".$Font."</option>\n\t\t\t\t";
        }

        return $listInput;
    }
}

// list of all the timezones
if (!function_exists(__NAMESPACE__ . '\timezone_list')) {
    function timezone_list(){
        $t_id_list=array(0=>"Africa/Abidjan",1=>"Africa/Accra",2=>"Africa/Addis_Ababa",3=>"Africa/Algiers",4=>"Africa/Asmara",5=>"Africa/Bamako",6=>"Africa/Bangui",7=>"Africa/Banjul",8=>"Africa/Bissau",9=>"Africa/Blantyre",10=>"Africa/Brazzaville",11=>"Africa/Bujumbura",12=>"Africa/Cairo",13=>"Africa/Casablanca",14=>"Africa/Ceuta",15=>"Africa/Conakry",16=>"Africa/Dakar",17=>"Africa/Dar_es_Salaam",18=>"Africa/Djibouti",19=>"Africa/Douala",20=>"Africa/El_Aaiun",21=>"Africa/Freetown",22=>"Africa/Gaborone",23=>"Africa/Harare",24=>"Africa/Johannesburg",25=>"Africa/Kampala",26=>"Africa/Khartoum",27=>"Africa/Kigali",28=>"Africa/Kinshasa",29=>"Africa/Lagos",30=>"Africa/Libreville",31=>"Africa/Lome",32=>"Africa/Luanda",33=>"Africa/Lubumbashi",34=>"Africa/Lusaka",35=>"Africa/Malabo",36=>"Africa/Maputo",37=>"Africa/Maseru",38=>"Africa/Mbabane",39=>"Africa/Mogadishu",40=>"Africa/Monrovia",41=>"Africa/Nairobi",42=>"Africa/Ndjamena",43=>"Africa/Niamey",44=>"Africa/Nouakchott",45=>"Africa/Ouagadougou",46=>"Africa/Porto-Novo",47=>"Africa/Sao_Tome",48=>"Africa/Tripoli",49=>"Africa/Tunis",50=>"Africa/Windhoek",51=>"America/Adak",52=>"America/Anchorage",53=>"America/Anguilla",54=>"America/Antigua",55=>"America/Araguaina",56=>"America/Argentina/Buenos_Aires",57=>"America/Argentina/Catamarca",58=>"America/Argentina/Cordoba",59=>"America/Argentina/Jujuy",60=>"America/Argentina/La_Rioja",61=>"America/Argentina/Mendoza",62=>"America/Argentina/Rio_Gallegos",63=>"America/Argentina/Salta",64=>"America/Argentina/San_Juan",65=>"America/Argentina/San_Luis",66=>"America/Argentina/Tucuman",67=>"America/Argentina/Ushuaia",68=>"America/Aruba",69=>"America/Asuncion",70=>"America/Atikokan",71=>"America/Bahia",72=>"America/Bahia_Banderas",73=>"America/Barbados",74=>"America/Belem",75=>"America/Belize",76=>"America/Blanc-Sablon",77=>"America/Boa_Vista",78=>"America/Bogota",79=>"America/Boise",80=>"America/Cambridge_Bay",81=>"America/Campo_Grande",82=>"America/Cancun",83=>"America/Caracas",84=>"America/Cayenne",85=>"America/Cayman",86=>"America/Chicago",87=>"America/Chihuahua",88=>"America/Costa_Rica",89=>"America/Cuiaba",90=>"America/Curacao",91=>"America/Danmarkshavn",92=>"America/Dawson",93=>"America/Dawson_Creek",94=>"America/Denver",95=>"America/Detroit",96=>"America/Dominica",97=>"America/Edmonton",98=>"America/Eirunepe",99=>"America/El_Salvador",100=>"America/Fortaleza",101=>"America/Glace_Bay",102=>"America/Godthab",103=>"America/Goose_Bay",104=>"America/Grand_Turk",105=>"America/Grenada",106=>"America/Guadeloupe",107=>"America/Guatemala",108=>"America/Guayaquil",109=>"America/Guyana",110=>"America/Halifax",111=>"America/Havana",112=>"America/Hermosillo",113=>"America/Indiana/Indianapolis",114=>"America/Indiana/Knox",115=>"America/Indiana/Marengo",116=>"America/Indiana/Petersburg",117=>"America/Indiana/Tell_City",118=>"America/Indiana/Vevay",119=>"America/Indiana/Vincennes",120=>"America/Indiana/Winamac",121=>"America/Inuvik",122=>"America/Iqaluit",123=>"America/Jamaica",124=>"America/Juneau",125=>"America/Kentucky/Louisville",126=>"America/Kentucky/Monticello",127=>"America/La_Paz",128=>"America/Lima",129=>"America/Los_Angeles",130=>"America/Maceio",131=>"America/Managua",132=>"America/Manaus",133=>"America/Marigot",134=>"America/Martinique",135=>"America/Matamoros",136=>"America/Mazatlan",137=>"America/Menominee",138=>"America/Merida",139=>"America/Metlakatla",140=>"America/Mexico_City",141=>"America/Miquelon",142=>"America/Moncton",143=>"America/Monterrey",144=>"America/Montevideo",145=>"America/Montreal",146=>"America/Montserrat",147=>"America/Nassau",148=>"America/New_York",149=>"America/Nipigon",150=>"America/Nome",151=>"America/Noronha",152=>"America/North_Dakota/Beulah",153=>"America/North_Dakota/Center",154=>"America/North_Dakota/New_Salem",155=>"America/Ojinaga",156=>"America/Panama",157=>"America/Pangnirtung",158=>"America/Paramaribo",159=>"America/Phoenix",160=>"America/Port-au-Prince",161=>"America/Port_of_Spain",162=>"America/Porto_Velho",163=>"America/Puerto_Rico",164=>"America/Rainy_River",165=>"America/Rankin_Inlet",166=>"America/Recife",167=>"America/Regina",168=>"America/Resolute",169=>"America/Rio_Branco",170=>"America/Santa_Isabel",171=>"America/Santarem",172=>"America/Santiago",173=>"America/Santo_Domingo",174=>"America/Sao_Paulo",175=>"America/Scoresbysund",176=>"America/Shiprock",177=>"America/Sitka",178=>"America/St_Barthelemy",179=>"America/St_Johns",180=>"America/St_Kitts",181=>"America/St_Lucia",182=>"America/St_Thomas",183=>"America/St_Vincent",184=>"America/Swift_Current",185=>"America/Tegucigalpa",186=>"America/Thule",187=>"America/Thunder_Bay",188=>"America/Tijuana",189=>"America/Toronto",190=>"America/Tortola",191=>"America/Vancouver",192=>"America/Whitehorse",193=>"America/Winnipeg",194=>"America/Yakutat",195=>"America/Yellowknife",196=>"Antarctica/Casey",197=>"Antarctica/Davis",198=>"Antarctica/DumontDUrville",199=>"Antarctica/Macquarie",200=>"Antarctica/Mawson",201=>"Antarctica/McMurdo",202=>"Antarctica/Palmer",203=>"Antarctica/Rothera",204=>"Antarctica/South_Pole",205=>"Antarctica/Syowa",206=>"Antarctica/Vostok",207=>"Arctic/Longyearbyen",208=>"Asia/Aden",209=>"Asia/Almaty",210=>"Asia/Amman",211=>"Asia/Anadyr",212=>"Asia/Aqtau",213=>"Asia/Aqtobe",214=>"Asia/Ashgabat",215=>"Asia/Baghdad",216=>"Asia/Bahrain",217=>"Asia/Baku",218=>"Asia/Bangkok",219=>"Asia/Beirut",220=>"Asia/Bishkek",221=>"Asia/Brunei",222=>"Asia/Choibalsan",223=>"Asia/Chongqing",224=>"Asia/Colombo",225=>"Asia/Damascus",226=>"Asia/Dhaka",227=>"Asia/Dili",228=>"Asia/Dubai",229=>"Asia/Dushanbe",230=>"Asia/Gaza",231=>"Asia/Harbin",232=>"Asia/Ho_Chi_Minh",233=>"Asia/Hong_Kong",234=>"Asia/Hovd",235=>"Asia/Irkutsk",236=>"Asia/Jakarta",237=>"Asia/Jayapura",238=>"Asia/Jerusalem",239=>"Asia/Kabul",240=>"Asia/Kamchatka",241=>"Asia/Karachi",242=>"Asia/Kashgar",243=>"Asia/Kathmandu",244=>"Asia/Kolkata",245=>"Asia/Krasnoyarsk",246=>"Asia/Kuala_Lumpur",247=>"Asia/Kuching",248=>"Asia/Kuwait",249=>"Asia/Macau",250=>"Asia/Magadan",251=>"Asia/Makassar",252=>"Asia/Manila",253=>"Asia/Muscat",254=>"Asia/Nicosia",255=>"Asia/Novokuznetsk",256=>"Asia/Novosibirsk",257=>"Asia/Omsk",258=>"Asia/Oral",259=>"Asia/Phnom_Penh",260=>"Asia/Pontianak",261=>"Asia/Pyongyang",262=>"Asia/Qatar",263=>"Asia/Qyzylorda",264=>"Asia/Rangoon",265=>"Asia/Riyadh",266=>"Asia/Sakhalin",267=>"Asia/Samarkand",268=>"Asia/Seoul",269=>"Asia/Shanghai",270=>"Asia/Singapore",271=>"Asia/Taipei",272=>"Asia/Tashkent",273=>"Asia/Tbilisi",274=>"Asia/Tehran",275=>"Asia/Thimphu",276=>"Asia/Tokyo",277=>"Asia/Ulaanbaatar",278=>"Asia/Urumqi",279=>"Asia/Vientiane",280=>"Asia/Vladivostok",281=>"Asia/Yakutsk",282=>"Asia/Yekaterinburg",283=>"Asia/Yerevan",284=>"Atlantic/Azores",285=>"Atlantic/Bermuda",286=>"Atlantic/Canary",287=>"Atlantic/Cape_Verde",288=>"Atlantic/Faroe",289=>"Atlantic/Madeira",290=>"Atlantic/Reykjavik",291=>"Atlantic/South_Georgia",292=>"Atlantic/St_Helena",293=>"Atlantic/Stanley",294=>"Australia/Adelaide",295=>"Australia/Brisbane",296=>"Australia/Broken_Hill",297=>"Australia/Currie",298=>"Australia/Darwin",299=>"Australia/Eucla",300=>"Australia/Hobart",301=>"Australia/Lindeman",302=>"Australia/Lord_Howe",303=>"Australia/Melbourne",304=>"Australia/Perth",305=>"Australia/Sydney",306=>"Europe/Amsterdam",307=>"Europe/Andorra",308=>"Europe/Athens",309=>"Europe/Belgrade",310=>"Europe/Berlin",311=>"Europe/Bratislava",312=>"Europe/Brussels",313=>"Europe/Bucharest",314=>"Europe/Budapest",315=>"Europe/Chisinau",316=>"Europe/Copenhagen",317=>"Europe/Dublin",318=>"Europe/Gibraltar",319=>"Europe/Guernsey",320=>"Europe/Helsinki",321=>"Europe/Isle_of_Man",322=>"Europe/Istanbul",323=>"Europe/Jersey",324=>"Europe/Kaliningrad",325=>"Europe/Kiev",326=>"Europe/Lisbon",327=>"Europe/Ljubljana",328=>"Europe/London",329=>"Europe/Luxembourg",330=>"Europe/Madrid",331=>"Europe/Malta",332=>"Europe/Mariehamn",333=>"Europe/Minsk",334=>"Europe/Monaco",335=>"Europe/Moscow",336=>"Europe/Oslo",337=>"Europe/Paris",338=>"Europe/Podgorica",339=>"Europe/Prague",340=>"Europe/Riga",341=>"Europe/Rome",342=>"Europe/Samara",343=>"Europe/San_Marino",344=>"Europe/Sarajevo",345=>"Europe/Simferopol",346=>"Europe/Skopje",347=>"Europe/Sofia",348=>"Europe/Stockholm",349=>"Europe/Tallinn",350=>"Europe/Tirane",351=>"Europe/Uzhgorod",352=>"Europe/Vaduz",353=>"Europe/Vatican",354=>"Europe/Vienna",355=>"Europe/Vilnius",356=>"Europe/Volgograd",357=>"Europe/Warsaw",358=>"Europe/Zagreb",359=>"Europe/Zaporozhye",360=>"Europe/Zurich",361=>"Indian/Antananarivo",362=>"Indian/Chagos",363=>"Indian/Christmas",364=>"Indian/Cocos",365=>"Indian/Comoro",366=>"Indian/Kerguelen",367=>"Indian/Mahe",368=>"Indian/Maldives",369=>"Indian/Mauritius",370=>"Indian/Mayotte",371=>"Indian/Reunion",372=>"Pacific/Apia",373=>"Pacific/Auckland",374=>"Pacific/Chatham",375=>"Pacific/Chuuk",376=>"Pacific/Easter",377=>"Pacific/Efate",378=>"Pacific/Enderbury",379=>"Pacific/Fakaofo",380=>"Pacific/Fiji",381=>"Pacific/Funafuti",382=>"Pacific/Galapagos",383=>"Pacific/Gambier",384=>"Pacific/Guadalcanal",385=>"Pacific/Guam",386=>"Pacific/Honolulu",387=>"Pacific/Johnston",388=>"Pacific/Kiritimati",389=>"Pacific/Kosrae",390=>"Pacific/Kwajalein",391=>"Pacific/Majuro",392=>"Pacific/Marquesas",393=>"Pacific/Midway",394=>"Pacific/Nauru",395=>"Pacific/Niue",396=>"Pacific/Norfolk",397=>"Pacific/Noumea",398=>"Pacific/Pago_Pago",399=>"Pacific/Palau",400=>"Pacific/Pitcairn",401=>"Pacific/Pohnpei",402=>"Pacific/Port_Moresby",403=>"Pacific/Rarotonga",404=>"Pacific/Saipan",405=>"Pacific/Tahiti",406=>"Pacific/Tarawa",407=>"Pacific/Tongatapu",408=>"Pacific/Wake",409=>"Pacific/Wallis",410=>"UTC ");
        return $t_id_list;
    }
}

/// make SEO friendly titles -> from "Title Number One" to "title-number-one" ///
if (!function_exists(__NAMESPACE__ . '\timezone_list')) {
    function url_slug($str, $replace=array('*', '`', '"', "'", ",", ".", "?", "!", ">", "<", "|", "\\", "/", "#", "%", "^", "&", "*", "`", "~", ")", "(", "@"), $delimiter='-', $maxLength=200) {

        $str = trim($str);

        if( !empty($replace) ) {
            $str = str_replace((array)$replace, '', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("%[^-/+|\w ]%", '', $clean);
        $clean = strtolower(trim(substr($clean, 0, $maxLength), '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}


/// make SEO friendly titles -> from "Title Number One" to "title-number-one" ///
if (!function_exists(__NAMESPACE__ . '\url_slug')) {
    function url_slug($str, $options = array()) {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
            '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'AE', '�' => 'C',
            '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I',
            '�' => 'D', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '?' => 'O',
            '�' => 'O', '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'U', '?' => 'U', '�' => 'Y', '�' => 'TH',
            '�' => 'ss',
            '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'ae', '�' => 'c',
            '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i',
            '�' => 'd', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '?' => 'o',
            '�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'u', '?' => 'u', '�' => 'y', '�' => 'th',
            '�' => 'y',
            // Latin symbols
            '�' => '(c)',
            // Greek
            '?' => 'A', '?' => 'B', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', '?' => '8',
            '?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
            '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'Y', '?' => 'F', '?' => 'X', '?' => 'PS', '?' => 'W',
            '?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
            '?' => 'Y',
            '?' => 'a', '?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
            '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => '3', '?' => 'o', '?' => 'p',
            '?' => 'r', '?' => 's', '?' => 't', '?' => 'y', '?' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
            '?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
            '?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',
            // Turkish
            '?' => 'S', '?' => 'I', '�' => 'C', '�' => 'U', '�' => 'O', '?' => 'G',
            '?' => 's', '?' => 'i', '�' => 'c', '�' => 'u', '�' => 'o', '?' => 'g',
            // Russian
            '?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Yo', '?' => 'Zh',
            '?' => 'Z', '?' => 'I', '?' => 'J', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O',
            '?' => 'P', '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'H', '?' => 'C',
            '?' => 'Ch', '?' => 'Sh', '?' => 'Sh', '?' => 'U', '?' => 'Y', '?' => '', '?' => 'E', '?' => 'Yu',
            '?' => 'Ya',
            '?' => 'a', '?' => 'b', '?' => 'v', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'yo', '?' => 'zh',
            '?' => 'z', '?' => 'i', '?' => 'j', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => 'o',
            '?' => 'p', '?' => 'r', '?' => 's', '?' => 't', '?' => 'u', '?' => 'f', '?' => 'h', '?' => 'c',
            '?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => 'u', '?' => 'y', '?' => '', '?' => 'e', '?' => 'yu',
            '?' => 'ya',
            // Ukrainian
            '?' => 'Ye', '?' => 'I', '?' => 'Yi', '?' => 'G',
            '?' => 'ye', '?' => 'i', '?' => 'yi', '?' => 'g',
            // Czech
            '?' => 'C', '?' => 'D', '?' => 'E', '?' => 'N', '?' => 'R', '�' => 'S', '?' => 'T', '?' => 'U',
            '�' => 'Z',
            '?' => 'c', '?' => 'd', '?' => 'e', '?' => 'n', '?' => 'r', '�' => 's', '?' => 't', '?' => 'u',
            '�' => 'z',
            // Polish
            '?' => 'A', '?' => 'C', '?' => 'e', '?' => 'L', '?' => 'N', '�' => 'o', '?' => 'S', '?' => 'Z',
            '?' => 'Z',
            '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'l', '?' => 'n', '�' => 'o', '?' => 's', '?' => 'z',
            '?' => 'z',
            // Latvian
            '?' => 'A', '?' => 'C', '?' => 'E', '?' => 'G', '?' => 'i', '?' => 'k', '?' => 'L', '?' => 'N',
            '�' => 'S', '?' => 'u', '�' => 'Z',
            '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'g', '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'n',
            '�' => 's', '?' => 'u', '�' => 'z'
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
}

if(!function_exists(__NAMESPACE__ . '\AddZero')){
    function AddZero($num) {
        $num_padded = sprintf("%02d", $num);
        return $num_padded;
    }
}

if(!function_exists(__NAMESPACE__ . '\format_time')){
    function format_time($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\format_date')){
    function format_date($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("F d, Y",strtotime($str));#date("d-M-y g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\format_date_with_time')){
    function format_date_with_time($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("F d, Y g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\format_date_with_day')){
    function format_date_with_day($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("F d, Y (l)",strtotime($str));#date("d-M-y g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\format_date_day_of_week')){
    function format_date_day_of_week($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("l",strtotime($str));#date("d-M-y g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\format_date_dispay_month')){
    function format_date_dispay_month($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("F",strtotime($str));#date("d-M-y g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\format_date_day_only')){
    function format_date_day_only($str) {
        //$dates = date("F d, Y",strtotime($date));
        //return $dates;
        return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "" || $str == "0000-00-00 00:00:00") ? null : date("d",strtotime($str));#date("d-M-y g:i A",strtotime($str));
        //return ($str == "0000-00-00" || $str == "01/01/1970" || $str =="1970-01-01" || $str == "") ? null : date("F d, Y",strtotime($str));
    }
}

if(!function_exists(__NAMESPACE__ . '\image_width')){
    function image_width(){
        $img_arr = [
            '700px','680px','660px','640px','620px','600px','580px','560px','540px','520px','500px','480px','460px','440px','420px','400px','380px','360px','340px','320px','300px',
            '280px','260px','240px','220px','200px','180px','160px','140px','120px','100px','80px',
        ];
        return $img_arr;
    }
}

if(!function_exists(__NAMESPACE__ . '\custom_card')){
    function custom_card($title,$start_date,$end_date,$start_time,$end_time,$location,$price,$image,$content){

        $title = ucwords($title);
        $start_date = format_date($start_date);
        $end_date = format_date($end_date);
        $start_time = format_time($start_time);
        $end_time = format_time($end_time);
        $location = ucwords($location);
        $price = (is_int($price)) ? number_format($price,2) : $price;
        $content = ucwords($content);

        if($image !== "" && $image !== null){
            $image = '<img class="custom-card-img-top" src="'.unserialize(base_url).'/events/upload/'.$image.'" alt="Card image cap">';
        }else{
            $image = '<img data-src="holder.js/100px250" class="img-fluid" alt="100%x250" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%221152%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201152%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16b556eb6a1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A58pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16b556eb6a1%22%3E%3Crect%20width%3D%221152%22%20height%3D%22250%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22408.98333740234375%22%20y%3D%22150.8%22%3E1152x250%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 400px; width: 100%; display: block;">';
        }

        $card_content = '';
        $card_content .= '<a class="go-back" href="javascript:void(0)"><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Go Back</a>';
        $card_content .= '<div class="custom-card">';

        $card_content .= '<div class="card-body">';
        $card_content .= '<label>Event Date: '.$start_date.' - '.$end_date.'</label><br>';
        $card_content .= '<label>Event Time: '.$start_time.' - '.$end_time.'</label><br>';
        $card_content .= '<label>Location: <a href="javascript:void(0)">'.$location.'</a></label> &nbsp;&nbsp;<a class="buttonmap" href="javascript:void(0)"><img data-toggle="modal" data-target="#gmap-modal" src="'.unserialize(base_url).'/events/images/gmaps-marker.png" width="20" alt="google maps marker"></a><br>';
        $card_content .= '<label><strong>Price: '.$price.'</strong></label>';
        $card_content .= '<hr>';
        $card_content .= '</div>';

        $card_content .= '<div class="card-body">';
        $card_content .= '<h4 class="card-title"><strong>'.$title.'</strong></h4>';
        $card_content .= $image;
        $card_content .= '<p class="card-text event-desc">'.$content.'</p>';
        $card_content .= '</div>';

        $card_content .= '<div class="share_buttons">';
        $card_content .= '<div class="a2a_kit a2a_default_style">';
        $card_content .= '<a class="a2a_dd" href="https://www.addtoany.com/share"></a>';
        $card_content .= '<a class="a2a_button_facebook"></a>';
        $card_content .= '<a class="a2a_button_twitter"></a>';
        $card_content .= '<a class="a2a_button_google_plus"></a>';
        $card_content .= '<a class="a2a_button_pinterest"></a>';
        $card_content .= '</div>';
        $card_content .= '<script>var a2a_config = a2a_config || {}; a2a_config.locale = "bg"; a2a_config.num_services = 6; a2a_config.color_main = "D7E5ED"; a2a_config.color_border = "AECADB"; a2a_config.color_link_text = "333333"; a2a_config.color_link_text_hover = "333333"; a2a_config.prioritize = ["facebook", "twitter", "pinterest", "google_plus", "email"];</script>';
        $card_content .= '<script async src="https://static.addtoany.com/menu/page.js"></script>';
        $card_content .= '</div>';

        $card_content .= '</div>';

        return $card_content;
    }
}

if(!function_exists(__NAMESPACE__ . '\custom_mini_card')){
    function custom_mini_card($title,$location,$price,$image){
        $title = ucwords($title);
        $location = ucwords($location);
        $price = (is_int($price)) ? number_format($price,2) : $price;

        if($image !== "" && $image !== null){
            $image = '<img class="custom-mini-card-img-top" src="'.base_url().'/events/upload/'.$image.'" alt="Card image cap">';
        }else{
            $image = '<img data-src="holder.js/100px250" class="img-fluid custom-mini-card-img-top" alt="100%x250" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%221152%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201152%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16b556eb6a1%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A58pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16b556eb6a1%22%3E%3Crect%20width%3D%221152%22%20height%3D%22250%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22408.98333740234375%22%20y%3D%22150.8%22%3E1152x250%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 400px; width: 100%; display: block;">';
        }

        $content = '';
        $content .= '<div class="custom-mini-card">';
        $content .= '<div class="mini-card-body">';
        $content .= $image;
        $content .= '<div class="content">';
        $content .= '<label>'.$title.'</label><br>';
        #$content .= '<label>Start Date: '.$start_date.' - '.$end_date.'</label><br>';
        #$content .= '<label>End Time: '.$start_time.' - '.$end_time.'</label><br>';
        $content .= '<label>Location: '.$location.'</label><br>';
        $content .= '<label>Price: '.$price.'</label><br>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

        return $content;
    }
}

/*this function is use to get user public ip address*/
if(!function_exists('get_ip_address')){
    function get_ip_address() {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    if (validate_ip($ip))
                        return $ip;
                }
            } else {
                if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }
}

/*this function is use to validate user public ip address*/
/*Ensures an ip address is both a valid IP and does not fall within
a private network range.*/
if(!function_exists('validate_ip')){
    function validate_ip($ip) {
        if (strtolower($ip) === 'unknown')
            return false;

        // generate ipv4 network address
        $ip = ip2long($ip);

        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647) return false;
            if ($ip >= 167772160 && $ip <= 184549375) return false;
            if ($ip >= 2130706432 && $ip <= 2147483647) return false;
            if ($ip >= 2851995648 && $ip <= 2852061183) return false;
            if ($ip >= 2886729728 && $ip <= 2887778303) return false;
            if ($ip >= 3221225984 && $ip <= 3221226239) return false;
            if ($ip >= 3232235520 && $ip <= 3232301055) return false;
            if ($ip >= 4294967040) return false;
        }
        return true;
    }
}


























