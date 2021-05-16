@php
    function formatDate($date)
    {
        if (!$date) return null;
        $date = date_create($date);
        return date_format($date, "d M Y");
    }

    function formatColor($value, $lower, $upper, $pass, $type = 'Maximize')
    {
        if($type == 'Maximize') $type = 1;
        else if($type == 'Minimize') $type = 2;
        else $type = 3;

        if(($type==1 && $value >= $pass) || ($type==2 && $value <= $pass) || ($type==3 && $value == $pass)) return "greenyellow";
        else if(($type==1 && $value < $lower) || ($type==2 && $value > $upper) || ($type==3 && ($value > $upper || $value < $lower))) return "red";
        else return "yellow";
    }

    function formatColorRisiko($value, $result=true)
    {
        if(!$result) {
            if($value==1) return "blue";
            else if($value==2) return "greenyellow";
            else if($value==3) return "yellow";
            else if($value==4) return "orange";
            else if($value==3) return "red";
        } else {
            if($value>=20) return "red";
            else if($value>=16) return "orange";
            else if($value>=12) return "yellow";
            else if($value>=6) return "greenyellow";
            else return "blue";
        }
    }
@endphp
