<?php
namespace core\Controller\Helpers;

class InjectHTML{


    public static function input($name, $label,$value="", $type='text', $require=true)//:string
    {
        $input = "<div class=\"form-group\"><label for=\"".
        $name."\">".$label.
        "</label><input id=\"".
        $name."\" type=\"".$type.
        "\" name=\"".$name."\" value=\"".$value."\" ";
        $input .= ($require)? "required": "";
        $input .= "></div>";

        return $input;
    }
    function input($name, $label,$value="", $type='text', $require=true)//:string
    {
        $input = "<div class=\"form-group\"><label for=\"".
        $name."\">".$label.
        "</label><input id=\"".
        $name."\" type=\"".$type.
        "\" name=\"".$name."\" value=\"".$value."\" ";
        $input .= ($require)? "required": "";
        $input .= "></div>";
    
        return $input;
    }
}