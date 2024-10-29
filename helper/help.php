<?php
include ("support.php");
class format{
    public function formatedate($date)
    {
        return date('F j,Y, g:i a', strtotime($date));
    }

    public function textshort($text, $limit)
    {
        $text = $text . "";
        $text = substr($text, 0, $limit);
//    $text = substr($text,
//        strpos( $text,'20'));
        $text = $text . "......";
        return $text;
    }

    public function validation($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }

    public function url()
    {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        if ($title == 'index') {
            $title = 'Home';
        } elseif ($title == 'contact') {
            $title = 'Contact';
        }
        return $title = ucfirst($title);

    }


}

?>