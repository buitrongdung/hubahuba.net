<?php

namespace App\Traits;

trait FormatCustom
{
    public function hasDate($month, $year, $ngay, $ca, $details = array())
    {
        foreach ($details as $detail) {
//            dd($details);
            if ($detail->ca_lam_viec == $ca && $detail->ngay_lam == $ngay && $detail->month == $month && $detail->year == $year) {
                return "<tr ><td style='text-align: center'><img src=\"/images/ico.2.png\" width=15 height=15></td></tr>";
            }
        }
        return "";
    }

    public function hasChamCong($month, $year, $ngay, $details = array())
    {
        foreach ($details as $detail) {
            if ($detail->ngay_cong == $ngay && $detail->month == $month && $detail->year == $year) {
                return "<tr ><td style='text-align: center'><img src=\"/images/ico.2.png\" width=15 height=15></td></tr>";
            }
        }
        return "";
    }
}