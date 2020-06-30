<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\KhuyenMai;
use Carbon\Carbon;
class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $promotions=KhuyenMai::all();
        Carbon::setLocale('vi');
        $now=Carbon::now();
        $ngay=$now->toDateString();
        foreach ($promotions as $promotion){
            $ngaybatdau=$promotion->NgayBatDau;
            $ngayketthuc=$promotion->NgayKetThuc;
            if($ngay>$ngayketthuc){
                $promotion->TrangThai=0;
                $promotion->save();
            }
            if($ngay>=$ngaybatdau && $ngay<=$ngayketthuc){
                $promotion->TrangThai=1;
                $promotion->save();
            }
        }
        $this->info('update status successfully!');
    }
}
