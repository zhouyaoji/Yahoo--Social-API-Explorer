<?
function json_format($json)
{
    if(is_null($json)){
        return "error: { message: 'No response was returned.' }";
    }     
    $tab = "  ";
    $new_json = "";
    $indent_level = 0;
    $in_string = false;
   
    $json_obj = json_decode("$json");
    if($json_obj)
      $json = json_encode($json_obj);

    $len = strlen($json);
    for($c = 0; $c < $len; $c++)
    {
        $char = $json[$c];
        switch($char)
        {
            case '{':
            case '[':
                if(!$in_string)
                {
                    $new_json .= $char . "\n" . str_repeat($tab, $indent_level+1);
                    $indent_level++;
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case '}':
            case ']':
                if(!$in_string)
                {
                    $indent_level--;
                    $new_json .= "\n" . str_repeat($tab, $indent_level) . $char;
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case ',':
                if(!$in_string)
                {
                    $new_json .= ",\n" . str_repeat($tab, $indent_level);
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case ':':
                if(!$in_string)
                {
                    $new_json .= ": ";
                }
                else
                {
                    $new_json .= $char;
                }
                break;
            case '"':
                $in_string = !$in_string;
            default:
                $new_json .= $char;
                break;                   
        }
    }
    return $new_json;
}
function xmlpp($xml, $html_output=false) {
    if(is_null($xml)){
        return "<error><message>No response was returned.</message></error>";
    } 
    $xml_obj = new SimpleXMLElement($xml);
    $level = 4;
    $indent = 0; // current indentation level
    $pretty = array();
   $formatted_string =  preg_replace('/>\s*</', ">\n<", $xml_obj->asXML());
    // get an array containing each XML element
    //$xml = explode("\n", preg_replace('/>\s*</', ">\n<", $xml_obj->asXML()));
    $xml = explode("\n",$formatted_string);

    // shift off opening XML tag if present
    if (count($xml) && preg_match('/^<\?\s*xml/', $xml[0])) {
      $pretty[] = array_shift($xml);
    }

    foreach ($xml as $el) {
      if (preg_match('/^<([\w])+[^>\/]*>$/U', $el)) {
          // opening tag, increase indent
          $pretty[] = str_repeat(' ', $indent) . $el;
          $indent += $level;
      } else {
        if (preg_match('/^<\/.+>$/', $el)) {            
          $indent -= $level;  // closing tag, decrease indent
        }
        if ($indent < 0) {
          $indent += $level;
        }
        $pretty[] = str_repeat(' ', $indent) . $el;
      }
    }   
    $xml = implode("\n", $pretty);   
    return ($html_output) ? htmlentities($xml) : $xml;
}
?>
