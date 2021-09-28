@extends('layouts.app')

   @section('content')
 <div class="container">
        <h1 class="text-center">Product Detail</h1>
    
    

<!--Section: Block Content-->
<section class="mb-5">

  <div class="row">
    <div class="col-md-6 mb-4 mb-md-0">

      <div id="mdb-lightbox-ui"></div>

      <div class="mdb-lightbox">

        <div class="row product-gallery mx-1">

          <div class="col-12 mb-0">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                 @foreach($products_images as $key=>$products_image)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                      <img src="{{ asset('images/'.$products_image->image_path) }}" class="d-block w-100" alt="...">
                    </div>
                 @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

          </div>
         
        </div>

      </div>

    </div>
    <div class="col-md-6">
      <h5>{{ ucfirst($data->name)}}</h5>
      <p class="mb-2 text-muted text-uppercase small">{{$data->category }}</p>
      <p class="pt-1">{{$data->description }}</p>
     
      <hr>
      
      <button type="button" class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
      <button type="button" class="btn btn-light btn-md mr-1 mb-2"><i
          class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
    </div>
  </div>

</section>
<!--Section: Block Content-->
  </div>
@endsection

