<?php
class ViewHelper
{
    function parser($file)
    {
        $html = file_get_contents($file);
        echo $html;
    }
}
?>