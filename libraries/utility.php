<?php

function elements($items, $array, $default = FALSE)
{
    $return = array();

    if ( ! is_array($items))
    {
        $items = array($items);
    }

    foreach ($items as $item)
    {
        if (isset($array[$item]))
        {
            $return[$item] = $array[$item];
        }
        else
        {
            $return[$item] = $default;
        }
    }

    return $return;
}

function to_array($data = null)
{
    // If not just null, but nothing is provided
    if ($data === null and ! func_num_args())
    {
        $data = $this->_data;
    }

    $array = array();

    foreach ((array) $data as $key => $value)
    {
        if (is_object($value) or is_array($value))
        {
            $array[$key] = $this->to_array($value);
        }

        else
        {
            $array[$key] = $value;
        }
    }

    return $array;
}

// Format XML for output
function to_xml($data = null, $structure = null, $basenode = 'xml')
{
    if ($data === null and ! func_num_args())
    {
        $data = $this->_data;
    }

    // turn off compatibility mode as simple xml throws a wobbly if you don't.
    if (ini_get('zend.ze1_compatibility_mode') == 1)
    {
        ini_set('zend.ze1_compatibility_mode', 0);
    }

    if ($structure === null)
    {
        $structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
    }

    // Force it to be something useful
    if ( ! is_array($data) AND ! is_object($data))
    {
        $data = (array) $data;
    }

    foreach ($data as $key => $value)
    {

        //change false/true to 0/1
        if(is_bool($value))
        {
            $value = (int) $value;
        }

        // no numeric keys in our xml please!
        if (is_numeric($key))
        {
            // make string key...
            $key = (singular($basenode) != $basenode) ? singular($basenode) : 'item';
        }

        // replace anything not alpha numeric
        $key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

        // if there is another array found recursively call this function
        if (is_array($value) || is_object($value))
        {
            $node = $structure->addChild($key);

            // recursive call.
            $this->to_xml($value, $node, $key);
        }

        else
        {
            // add single node.
            $value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, "UTF-8");

            $structure->addChild($key, $value);
        }
    }

    return $structure->asXML();
}

// Format HTML for output
function to_html()
{
    $data = $this->_data;

    // Multi-dimensional array
    if (isset($data[0]) && is_array($data[0]))
    {
        $headings = array_keys($data[0]);
    }

    // Single array
    else
    {
        $headings = array_keys($data);
        $data = array($data);
    }

    $ci = get_instance();
    $ci->load->library('table');

    $ci->table->set_heading($headings);

    foreach ($data as &$row)
    {
        $ci->table->add_row($row);
    }

    return $ci->table->generate();
}

// Format CSV for output
function to_csv()
{
    $data = $this->_data;

    // Multi-dimensional array
    if (isset($data[0]) && is_array($data[0]))
    {
        $headings = array_keys($data[0]);
    }

    // Single array
    else
    {
        $headings = array_keys($data);
        $data = array($data);
    }

    $output = implode(',', $headings).PHP_EOL;
    foreach ($data as &$row)
    {
        $output .= '"'.implode('","', $row).'"'.PHP_EOL;
    }

    return $output;
}
