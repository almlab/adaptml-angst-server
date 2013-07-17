<?php

/**
 * Obfuscate Email
 **/
function obfuscateEmail($email, $text=''){
    $email = str_rot13($email);
    if($text == ''){
        $text = $email;
    }else{
        $text = str_rot13($text);
    }   
    return '<script type="text/javascript">
        document.write("<n uers=\"znvygb:'.$email.'\" ery=\"absbyybj\">'.$text.'</n>".replace(/[a-zA-Z]/g, 
        function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));
        </script>';
}

/**
 * Used by upload to save files
 **/
function saveFile($location, $text){
    $handle = fopen($location, 'w');
    fwrite($handle, $text);
    fclose($handle);
    chmod($location, 0777);
}

?>


<!DOCTYPE html>

<html lang="en-US">
    <head>
    <title><?php echo $title; ?></title>
    
    <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400' rel='stylesheet' type='text/css'>
    
    <link rel="icon" type="image/png" href="../img/a_square.png">
    
    <link rel="stylesheet" type="text/css" href="../css/almLayouts.css" />
    <link rel="stylesheet" type="text/css" href="../css/almLists.css" />
    <link rel="stylesheet" type="text/css" href="../css/almLinks.css" />
    <link rel="stylesheet" type="text/css" href="../css/almLooks.css" />
    <link rel="stylesheet" type="text/css" href="../css/almThumbnail.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="include/angst.css" />
    <script src="../javascript/hover.js" language="JavaScript" type="text/javascript"></script>
    <script type="text/javascript" src="include/angst.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </head>
    <body>
        <!--<div style='width:80%; margin-bottom:20em; margin-right: 20em;'>-->
        <!-- the header -->
        
        <!-- the navigation menu -->
        <div id="topnav">
            <ul class="topmenu">
            <li class="menu"><a class="menu" href="../index.html">Home</a></li>
            <li class="menu"><a class="menu" href="../press.html">Press</a></li>
            <li class="menu"><a class="menu" href="../publications.html">Publications</a></li>
            <li class="menu"><a class="menu" href="../software.html">Software</a></li>
            <li class="menu"><a class="menu" href="../members.html">Lab Members</a></li>
            <li class="menu"><a class="menu" href="../contact.html">Contact</a></li>


            </ul>
         </div>
        
        <div id="banner">
            <!-- alm lab -->
            alm lab
        <!-- MIT logo -->
        <a href="http://web.mit.edu/"><img src="../img/mit-redgrey-footer3.gif"/></a>
        </div>

        
        <!-- everything else is in the container div, the main body -->
        <div id="container">
            <div id="content">
            </div><!-- end of div content -->
            <div id="rightPane">    
            </div>
            <div id="midPane">
                
