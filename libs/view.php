<?php

class View{

    function __construct(){
        //echo "<p>Vista principal</p>";
    }

    function render($nombre){
    	//$ruta='views/' . $nombre . '.php';
    	//echo $nombre;
        require 'views/' . $nombre . '.php';
    }
}

?>