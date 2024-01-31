<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($carousels as $carousel)
            <div class="carousel-item {{$loop->first ? 'active':''}}" style="height: 410px;">
                <img class="img-fluid" src="{{asset('uploads/carousel/'.$carousel->image)}}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">{{$carousel->description??''}}</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{$carousel->title??''}}</h3>
                        <a href="{{$carousel->link??''}}" class="btn btn-light py-2 px-3">open</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-prev-icon mb-n2"></span>
        </div>
    </a>
    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-next-icon mb-n2"></span>
        </div>
    </a>
</div>
