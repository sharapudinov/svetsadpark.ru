<?php


function IsMainPage()
{
    $m_url = trim($_SERVER['REQUEST_URI'],"/");
    $m_url1 = str_split($m_url);
    return ($m_url == "" || $m_url1[0] == "?");
}

function PR($o, $bool = false)
{
    $bt =  debug_backtrace();
    $bt = $bt[0];
    $dRoot = $_SERVER["DOCUMENT_ROOT"];
    $dRoot = str_replace("/","\\",$dRoot);
    $bt["file"] = str_replace($dRoot,"",$bt["file"]);
    $dRoot = str_replace("\\","/",$dRoot);
    $bt["file"] = str_replace($dRoot,"",$bt["file"]);
    global $USER;
    if ($USER->isAdmin() || $bool)
    {
        ?>
        <div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;'>
            <div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
            <pre style='padding:10px;'><?print_r($o)?></pre>
        </div>
        <?
    }
}

function objectToArray($object)
{
    if(!is_object($object) && !is_array($object)){
        return $object;
    }
    if(is_object($object))
    {
        $object = get_object_vars( $object );
    }
    return array_map( 'objectToArray', $object);
}

function str_search($subs, $str, $bool = false)
{
    if(!$bool){
        $str = strtolower($str);
        $subs = strtolower($subs);
    }

    $pos = strpos($str, $subs);
    return !($pos === false);
}