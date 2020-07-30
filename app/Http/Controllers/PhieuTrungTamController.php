<?php

namespace App\Http\Controllers;

use App\PhieuBaoHanh;
use App\PhieuTrungTam;
use Illuminate\Http\Request;

class PhieuTrungTamController extends Controller
{
    public function getList(){
        $phieutrungtam=PhieuTrungTam::all();
        return view('admin.phieutrungtam.danhsach',['phieutrungtam'=>$phieutrungtam]);
    }
    public function update_status($id){
        $phieutrungtam=PhieuTrungTam::find($id);
        return view('admin.phieutrungtam.capnhap_trangthai',['phieutrungtam'=>$phieutrungtam]);
    }
    public function post_update_status($id){
        $trangthai=$this->request->trangthai;
        $phieutrungtam=PhieuTrungTam::find($id);
        $phieutrungtam->TrangThai=$trangthai;
        $phieutrungtam->save();
        return redirect('admin/phieutrungtam/danhsach')->with('ThongBao','Cập nhập thành công');
    }
    public function tra_ve($id){
        $phieutrungtam=PhieuTrungTam::find($id);
        $idpbh=$phieutrungtam->idPBH;
        //update status baohanh
        $phieubaohanh=PhieuBaoHanh::find($idpbh);
        if ($phieubaohanh->TrangThai==4 || $phieubaohanh->TrangThai==5){
            return redirect('admin/phieutrungtam/danhsach')->with('ThongBao','Máy đã được trả về !');
        }else {
            $phieubaohanh->TrangThai = 4;
            $phieubaohanh->save();
        }
        return redirect('admin/phieutrungtam/danhsach')->with('ThongBao','Trả về chi nhánh thành công');
    }
    public function show()
    {
        $phieutrungtam = PhieuTrungTam::get();
        foreach ($phieutrungtam as $key => $ptt) {?>
            <tr align="center">
                <td><?php echo ($key + 1); ?></td>
                <td><?php echo (date('m/d/Y H:i:s', strtotime($ptt->NgayTao))); ?></td>
                <td class="view-phieubaohanh" data-key="<?php echo $ptt->idPBH; ?>">
                    <a href="javascript:void(0)"><?php echo $ptt->idPBH; ?></a>
                </td>
                <td><?php echo $ptt->NgayGui; ?></td>
                <td><?php echo $ptt->NgayTra; ?></td>
                <td>
                    <a class="btn btn-xs <?php
                        if ($ptt->TrangThai == 0) {
                            echo "btn-info";
                        } else {
                            echo "btn-default";
                        } ?>">
                        <?php
                        if ($ptt->TrangThai == 1) {
                            echo "Đang xử lý";
                        } elseif ($ptt->TrangThai == 2) {
                            echo "Đã xử lý";
                        } elseif ($ptt->TrangThai == 3) {
                            echo "Hoàn thành";
                        } else {
                            echo "Tiếp nhận";
                        }
                         ?>
                    </a>
                </td>
                <td>
                     <ul class="nav navbar-nav ">
                          <li class="dropdown navbar-c-items">
                               <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="md md-settings"></i> </a>
                                    <ul class="dropdown-menu" style="min-width: 100px; right: 0;left: unset">
                                        <li><a href="javascript:void(0)" class="view-phieubaohanh" data-key="<?php echo $ptt->id;?>"><i class="fa fa-eye m-r-10"></i>Chi tiết </a></li>
                                            <?php if($ptt->TrangThai==0 || $ptt->TrangThai==1 ||$ptt->TrangThai==2){?>
                                        <li><a href="admin/phieutrungtam/update-status/<?php echo $ptt->id;?>"><i class="md md-forward m-r-10"></i>Chuyển trạng thái</a></li>
                                            <?php }?>
                                            <?php if($ptt->TrangThai==3){?>
                                        <li><a href="admin/phieutrungtam/tra-ve/<?php echo $ptt->id; ?>"><i class="md md-forward m-r-10"></i>Trả về</a></li>
                                            <?php }?>
                                     </ul>
                          </li>
                     </ul>
                </td>
            </tr>
            <?php
        }
    }
}
