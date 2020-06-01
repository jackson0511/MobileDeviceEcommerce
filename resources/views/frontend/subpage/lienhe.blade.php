@extends("frontend.index")
@section('content')
<div class="page-title parallax parallax1">
  <div class="container">
     <div class="row">
        <div class="col-md-12">
           <div class="page-title-heading">
            <h1 class="title">Liên Hệ</h1>
        </div><!-- /.page-title-heading -->
        <div class="breadcrumbs">
          <ul>
             <li><a href="/">TRANG CHỦ</a></li>
         </ul>
     </div><!-- /.breadcrumbs -->
 </div><!-- /.col-md-12 -->
</div><!-- /.row -->
</div><!-- /.container -->
</div><!-- /.page-title -->

<section class="flat-row flat-iconbox">
    <div class="container">
     <div class="clearfix"></div>
     <!-- /.col-lg-12 -->
     @if(session('ThongBao'))
     <div class="alert alert-info">
        {{session('ThongBao')}}
    </div>
    @endif
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="title-section">
                <h2 class="title">
                    Get In Touch
                </h2>
            </div><!-- /.title-section -->
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <div class="iconbox text-center">
                <div class="box-header nomargin">
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-content">
                    <p>270 Tôn thất thuyết phường 3 quận 4</p>
                </div><!-- /.box-content -->
            </div><!-- /.iconbox -->
        </div><!-- /.col-md-4 -->
        <div class="col-md-4">
            <div class="divider h0"></div>
            <div class="iconbox text-center">
                <div class="box-header">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-content">
                    <p>0772818495</p>
                </div><!-- /.box-content -->
            </div><!-- /.iconbox -->
        </div><!-- /.col-md-4 -->
        <div class="col-md-4">
            <div class="divider h0"></div>
            <div class="iconbox text-center">
                <div class="box-header">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-content">
                    <p>thuannguyen14897@gmail.com</p>
                </div><!-- /.box-content -->
            </div><!-- /.iconbox -->
        </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
    <div class="divider h43"></div>
    <div class="row">
        <div class="col-md-12">

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.757217234572!2d106.69422295079703!3d10.753185262524008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f0c5a5cbc43%3A0x6df9bff21d87e7db!2zMjcwIFTDtG4gVGjhuqV0IFRodXnhur90LCBQaMaw4budbmcgMywgUXXhuq1uIDQsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1542445429211" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->

<section class="flat-row flat-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin_bottom_17">
                    <h2 class="title">
                        Viết Góp Ý
                    </h2>
                </div><!-- /.title-section -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                @if(count($errors)>0)
                   <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}
                    <br>
                    @endforeach
                  </div>   
                @endif
            </div>
        <div class="wrap-contact">
            <form novalidate="" class="contact-form" id="contactform" method="post" action="gopy/lienhe">
                {{ csrf_field() }}  
                 <div class="contact-message clearfix margin-top-40">
                    <input type="hidden" name="hoten" value="{{Auth::guard('KhachHang')->user()->id}}">                                      
                </div>     
                <div class="contact-message clearfix margin-top-40">
                    <label>Nội Dung</label> 
                    <textarea class="" tabindex="4" name="noidung"></textarea>                                      
                </div>                                                     
                <div class="form-submit margin-top-32 ">                 
                    <button class="contact-submit">Gửi</button>
                </div>
            </form>
        </div><!-- /.wrap-contact -->
    </div><!-- /.row -->
</div><!-- /.container -->
</section><!-- /.flat-row -->
@endsection