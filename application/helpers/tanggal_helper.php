<?php

if (!function_exists('element'))
{
    function get_tanggal_indonesia($str)
    {
        $str = substr($str, 0, 10);
        $string[0] = substr($str, 0, 4);
        $string[1] = substr($str, 5, 2);
        $string[2] = substr($str, 8, 2);
        $tahun = $string[0];
        $bulan = $string[1];
        switch ($bulan)
        {
            case '01': $bulan = 'Januari';
                break;
            case '02': $bulan = 'Februari';
                break;
            case '03': $bulan = 'Maret';
                break;
            case '04': $bulan = 'April';
                break;
            case '05': $bulan = 'Mei';
                break;
            case '06': $bulan = 'Juni';
                break;
            case '07': $bulan = 'Juli';
                break;
            case '08': $bulan = 'Agustus';
                break;
            case '09': $bulan = 'September';
                break;
            case '10': $bulan = 'Oktober';
                break;
            case '11': $bulan = 'November';
                break;
            case '12': $bulan = 'Desember';
                break;
        }
        $tanggal = $string[2];
        $string = $tanggal . " " . $bulan . " " . $tahun;
        return $string;
    }

    function get_waktu($str)
    {
        $str = substr($str, 11, 5);
        return $str;
    }
    function get_tanggal_lengkap($time)
    {
        setlocale(LC_TIME, 'INDONESIA');
        $date = strftime("%A, %d %B %Y %H%M", $time);
        return $date;
    }

    function get_bulan($time)
    {
        setlocale(LC_TIME, 'INDONESIA');
        return strftime("%B", $time);
    }

    function get_tahun($time)
    {
        setlocale(LC_TIME, 'INDONESIA');
        return strftime("%Y", $time);
    }

    function waktu_sejak($original)
    {
        $chunks = array(
            array(60 * 60 * 24 * 365, 'tahun'),
            array(60 * 60 * 24 * 30, 'bulan'),
            array(60 * 60 * 24 * 7, 'minggu'),
            array(60 * 60 * 24, 'hari'),
            array(60 * 60, 'jam'),
            array(60, 'menit'),
        );

        $today = time(); /* Current unix time  */
        $since = $today - $original;

        for ($i = 0, $j = count($chunks); $i < $j; $i++)
        {

            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            // finding the biggest chunk (if the chunk fits, break)
            if (($count = floor($since / $seconds)) != 0)
            {
                // DEBUG print "<!-- It's $name -->\n";
                break;
            }
        }

        $print = ($count == 1) ? '1 ' . $name : "$count {$name}";

        if ($i + 1 < $j)
        {
            $seconds2 = $chunks[$i + 1][0];
            $name2 = $chunks[$i + 1][1];

            if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
            {
                $print .= ( $count2 == 1) ? ', 1 ' . $name2 : ", $count2 {$name2}";
            }
        }
        return $print;
    }

}