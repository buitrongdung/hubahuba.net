<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dining;
use App\BookedSeat;
use App\Booking;
use App\Table;
use App\Day;
class ManagementController extends Controller
{
    public function getIndex()
    {
        $days=Day::all();
        $dinings=Dining::all();
        $seats= BookedSeat::orderBy('day_id','ASC')->orderBy('table_id','ASC')->orderBy('status','ASC')->orderBy('booking_id','ASC')->get();
        return view('management/index',['days'=>$days,'dinings'=>$dinings,'seats'=>$seats]);
    }
    public function postIndex(Request $request)
    {
        if($request->get('save-confirmations') ==='')
                return $this->saveSeats($request);
        else if($request->get('send-emails') ==='')
            return $this->sendEmails($request);
        else if($request->get('create-guest-list') ==='')
            return $this->getExport($request);
        else return redirect()->back();
    }
    public function getExport()
    {
        $days=Day::all();
        $dinings=Dining::all();
        $seats= BookedSeat::orderBy('day_id','ASC')->orderBy('table_id','ASC')->where('status','confirmed')->orderBy('booking_id','ASC')->get();
        return view('management/export',['days'=>$days,'dinings'=>$dinings,'seats'=>$seats]);
    }
    private function saveSeats($request)
    {
        $newDays=[];
        $newTables=[];
        foreach ($request->all() as $id => $value) {
            if(substr($id,0,3)==='ds-')
                $newDays[substr($id, 3)]=$value;
            else if(substr($id,0,3)==='ts-')
                $newTables[substr($id, 3)]=$value;
        }
        foreach ($request->all() as $id => $status) {
            if(!is_numeric($id)) continue;
            $seat=BookedSeat::find($id);
            if($seat->status=='reschedule' && $status=='reschedule')
            {
                $seat->day_id=$newDays[$id];
                $seat->table_id=$newTables[$id];
                $seat->status='requested';
            }
            else
            {
                $seat->status=$status;
                if($seat->status==='confirmed')
                {
                    $booking=Booking::find($seat->booking_id);
                    $this->sendEmail($booking);
                }
            }
            $seat->save();
        }
        return redirect()->back();
    }
    private function sendEmails($request)
    {
        $bookings=Booking::all();
        foreach ($bookings as $booking) {
            $email="";
            $email.="Booking confirmation\n\n";
            $email.=$booking->name.", thank you for your booking request ".$booking->id;
            $email.="We are happy to send you the latest infomation about guest confirmation:\n\n";
            foreach ($booking->getSeatsByDays() as $info) {
                $email.=$info['day']->name.", ".$info['table']->dining->name.' '.$info['table']->time;
                if($booking->type==='group')
                {
                    $email.=' for\n';
                    foreach ($info['seats'] as $seat) {
                        $email.=$seat->guest." ". $seat->country.' - '.$seat->status."\n";

                    }

                }
                $email.="\n";
            }
            $email.="\n Please note that your guests need to arrive at Restaurant Service as least 10 minutes prior to theschedule seating time.";
            file_put_contents(__DIR__."/../../../emails/".$booking->id.'_'.date("dmyhis").".txt", $email);
        }
        return redirect()->back();
    }
     private function sendEmail($booking)
    {
       
            $email="";
            $email.="Booking confirmation\n\n";
            $email.=$booking->name.", thank you for your booking request ".$booking->id;
            $email.="We are happy to send you the latest infomation about guest confirmation:\n\n";
            foreach ($booking->getSeatsByDays() as $info) {
                $email.=$info['day']->name.", ".$info['table']->dining->name.' '.$info['table']->time;
                if($booking->type==='group')
                {
                    $email.=' for\n';
                    foreach ($info['seats'] as $seat) {
                        if($seat->status=='confirmed')
                        $email.=$seat->guest." ". $seat->country.' - '.$seat->status."\n";
                    }
                }
                $email.="\n";
            }
            $email.="\n Please note that your guests need to arrive at Restaurant Service as least 10 minutes prior to theschedule seating time.";
            file_put_contents(__DIR__."/../../../emails/".$booking->id.'_confirmed_'.date("dmyhis").".txt", $email);
        
        return redirect()->back();
    }
   
}
