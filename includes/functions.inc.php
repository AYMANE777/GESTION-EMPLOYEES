<?php
require_once("config.inc.php");
function getBrowser() {

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function getIPAddress() 
{  
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    else{  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }
    return $ip;  
}  


function getOS() { 

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function secureData($text){
    $m = str_replace("'", "&apos;" ,htmlspecialchars($text)) and str_replace('"', "&quot;" ,htmlspecialchars($text));
    return $m;
}

function LoggedIn()
{
	@session_start();
	if (isset($_SESSION['userid'], $_SESSION['type']))
	{
    return $_SESSION['type'];
	}
	else
	{
		return false;
	}
}

function isConseilleur()
{
    global $connect;
    @session_start();
    if(LoggedIn())
    {
        $userid = $_SESSION['userid'];
        $SQLCheck = mysqli_query($connect, "SELECT * FROM employés WHERE cin='$userid' AND fonction='Conseilleur'");
        if(mysqli_num_rows($SQLCheck) > 0)
        {
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}

function isDirecteur()
{
    global $connect;
    @session_start();
    if(LoggedIn())
    {
        $userid = $_SESSION['userid'];
        $SQLCheck = mysqli_query($connect, "SELECT * FROM employés WHERE cin='$userid' AND fonction='Directeur'");
        if(mysqli_num_rows($SQLCheck) > 0)
        {
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
    
}

function checkEngagementID($engid)
{
  global $connect;
  $SQLCheck = mysqli_query($connect, "SELECT * FROM engagements WHERE eng_id='$engid'");
  if(mysqli_num_rows($SQLCheck) > 0)
  {
      return true;
  }else{
      return false;
  }
}

function checkMessageID($msgID, $matricule)
{
  global $connect;
  $SQLCheck = mysqli_query($connect, "SELECT * FROM messages WHERE message_id='$msgID'");
  if(mysqli_num_rows($SQLCheck) > 0)
  {
      return true;
  }else{
      return false;
  }
}

function checkMessageRead($msgID)
{
  global $connect;
  $SQLCheck = mysqli_query($connect, "SELECT * FROM messages WHERE message_id='$msgID'");
  if(mysqli_num_rows($SQLCheck) > 0)
  {
    $message = mysqli_fetch_assoc($SQLCheck);
    if($message['isRead'] == 1)
    {
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }
}

function checkProblemID($prblmID)
{
  global $connect;
  $SQLCheck = mysqli_query($connect, "SELECT * FROM problemes WHERE problem_id='$prblmID'");
  if(mysqli_num_rows($SQLCheck) > 0){
    return true;
  }else{
    return false;
  }
}

function checkEntretienID($entretienID)
{
  global $connect;
  $SQLCheck = mysqli_query($connect, "SELECT * FROM entretiens WHERE entretien_id='$entretienID'");
  if(mysqli_num_rows($SQLCheck) > 0){
    return true;
  }else{
    return false;
  }
}

function checkGroupeID($groupeID)
{
  global $connect;
  $SQLCheck = mysqli_query($connect, "SELECT * FROM groupes WHERE groupe_id='$groupeID'");
  if(mysqli_num_rows($SQLCheck) > 0){
    return true;
  }else{
    return false;
  }
}

function addNotif($receiver_id, $action, $sender_id)
{
  global $connect;
  $currentDate = date("Y-m-d h:m:s");
  mysqli_query($connect, "INSERT INTO notifications (receiver_id, action, sender_id, isRead, date) VALUES ('$receiver_id', '$action', '$sender_id', '0', '$currentDate ')");

}

function format_time_ago($timestamp)  
{  
  $time_ago = strtotime($timestamp);  
  $current_time = time();  
  $time_difference = $current_time - $time_ago;  
  $seconds = $time_difference;  
  $minutes      = round($seconds / 60 );           // value 60 is seconds  
  $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
  $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
  $weeks          = round($seconds / 604800);          // 7*24*60*60;  
  $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
  $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
	if($seconds <= 60)  
	{  
	return "Juste maintenant";  
  }  
	 else if($minutes <=60)  
	 {  
	if($minutes==1)  
		  {  
	  return "il y a une minute";  
	}  
	else  
		  {  
	  return "$minutes minutes";  
	}  
  }  
	 else if($hours <=24)  
	 {  
	if($hours==1)  
		  {  
	  return "il y a une heure";  
	}  
		  else  
		  {  
	  return "$hours heures";  
	}  
  }  
	 else if($days <= 7)  
	 {  
	if($days==1)  
		  {  
	  return "hier";  
	}  
		  else  
		  {  
	  return "$days jours";  
	}  
  }  
	 else if($weeks <= 4.3) //4.3 == 52/12  
	 {  
	if($weeks==1)  
		  {  
	  return "il y a une semaine";  
	}  
		  else  
		  {  
	  return "$weeks semaines";  
	}  
  }  
	  else if($months <=12)  
	 {  
	if($months==1)  
		  {  
	  return "il y a un mois";  
	}  
		  else  
		  {  
	  return "$months mois";  
	}  
  }  
	 else  
	 {  
	if($years==1)  
		  {  
	  return "il y a un an";  
	}  
		  else  
		  {  
	  return "$years années";  
	}  
  }  
} 

function dateToFrench($date, $format) 
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'aAoût', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}

function getColor()
{
  $colors = ['info', 'success', 'warning', 'danger', 'primary'];
  return $colors[rand(0, 4)];
}
?>