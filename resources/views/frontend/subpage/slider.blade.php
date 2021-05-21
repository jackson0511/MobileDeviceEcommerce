<div class="container">
    <div id="myCarousel" class="carousel slide border" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php $i=0 ?>
            @foreach($banner as $bn)
                <div
                    @if($i==0)

                    class="carousel-item active"
                    @else
                    class="carousel-item"
                    @endif
                >
                    <a style="width: 100%" href=""><img class="d-block w-100" src="upload/banner/{{$bn->Hinh}}" alt="Leopard"></a>

                </div>
                <?php $i++ ?>
            @endforeach
        </div>
        <!-- Controls -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="divider h20"></div>
</div>
