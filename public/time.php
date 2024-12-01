<?php
//Creating Function
function TimeAgo ($oldTime, $date) { //$oldTime tgl postingan dibuat,  $date adalah waktu sekarang
    $tz = "Asia/Jakarta";//zona waktu
    $dt = new DateTime("now", new DateTimeZone($tz));//waktu sekarang
    $date = $dt->format('Y-m-d H:i:s');//format waktu
    $timeCalc = strtotime($date) - strtotime($oldTime);//strtotime adalah mengubah string ke waktu, waktu skrg - waktu postinagn
    if ($timeCalc >= (60*60*24*30*12*2)){
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " years ago";
        }else if ($timeCalc >= (60*60*24*30*12)){
            $timeCalc = intval($timeCalc/60/60/24/30/12) . " year ago";
        }else if ($timeCalc >= (60*60*24*30*2)){
            $timeCalc = intval($timeCalc/60/60/24/30) . " months ago";
        }else if ($timeCalc >= (60*60*24*30)){
            $timeCalc = intval($timeCalc/60/60/24/30) . " month ago";
        }else if ($timeCalc >= (60*60*24*2)){
            $timeCalc = intval($timeCalc/60/60/24) . " days ago";
        }else if ($timeCalc >= (60*60*24)){
            $timeCalc = " Yesterday";
        }else if ($timeCalc >= (60*60*2)){
            $timeCalc = intval($timeCalc/60/60) . " hours ago";
        }else if ($timeCalc >= (60*60)){
            $timeCalc = intval($timeCalc/60/60) . " hour ago";
        }else if ($timeCalc >= 60*2){
            $timeCalc = intval($timeCalc/60) . " minutes ago";
        }else if ($timeCalc >= 60){
            $timeCalc = intval($timeCalc/60) . " minute ago";
        }else if ($timeCalc > 0){
            $timeCalc .= " seconds ago";
        }
    return $timeCalc;
    }
?>