<?php

namespace App\Listeners;

use App\Events\NewOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use App\QuanTri;
use Mail;
class NotificationAfterNewOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewOrder  $event
     * @return void
     */
    public function handle(NewOrder $event)
    {
        $data['content'] = 'Có đơn hàng mới với ID ' . $event->order->id;
        //email nguoi mua hang
        $quantri=QuanTri::find(3);
        $email=$quantri->Email;
        $data['name']=$quantri->HoTen;
        //link
        $url=route('get.link.order',[
            'order_id'    =>$event->order->id ,
        ]);
        $data['route']=$url;
        //gui mail
        Mail::send('frontend.email-template.new_order',$data, function($message) use ($email){
            $message->from('thuan.dh51600602@gmail.com','Đức Thuận');
            $message->to($email, 'Thông báo đơn hàng mới');
            $message->subject('Thông báo đơn hàng mới');
        });
        return true;
    }
}
