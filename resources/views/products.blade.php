@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
    <div class="alert alert-success">
           {!! \Session::get('success') !!}
    </div>
@endif
   
       
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" style="float:right;">Add Product</button>
 

<div class="container py-5">
    <div class="row text-center text-white mb-5">
        <div class="col-lg-7 mx-auto">
          <form action="/products">
            <h1 class="display-4" style="color:#000;">Product List</h1>
            <input type="text" name="q" placeholder="Search..." class="form-control" value="{{$search}}">
            <br/>
            <input type="submit" name="" value="Search" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- List group-->
            <ul class="list-group shadow">
                <!-- list group item-->
                @foreach($data as $key=>$value)
                  <li class="list-group-item">
                      <!-- Custom content-->
                      <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                          <div class="media-body order-2 order-lg-1">
                              <h5 class="mt-0 font-weight-bold mb-2">{{ucfirst($value->name)}}</h5>
                              <p class="font-italic text-muted mb-0 small">{{ucfirst($value->short_description)}}</p>
                            
                          </div>
                          <a href="/product/{{$value->id}}">
                           <img src="{{ asset('images/'.$value->images[0]->image_path) }}" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                          </a>
                      </div> <!-- End -->
                  </li> <!-- End -->
                @endforeach
        </div>
    </div>
</div>


<div id="exampleModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/product-add" method="post" id="formData" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="email">Product Name:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter Name" name="name">
          </div>
          <div class="form-group">
            <label for="pwd">Short Description:</label>
            <input type="text" class="form-control" id="pwd" placeholder="Enter Short Description" name="short_description">
          </div>
          <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control" rows="3" id="comment" placeholder="Enter Description" name="description"></textarea>
          </div>
          <div class="form-group">
            <select id="category_id" name="category_id" class="form-control">
              <option value="">--- Select Category ---</option>
                @foreach ($categories as $cat_key => $cat_value)

                  <option value="{{ $cat_key }}" />{{ $cat_value }}</option>
                @endforeach
            </select>
          </div>
        <label>Status:</label><br>
        <div class="form-check">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <label class="form-check-label">
            <input type="radio" class="form-check-input" value='0' name="status">Inactive
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" value='1' name="status" checked>Active
          </label>
        </div>

        <div class="form-group">
          <label for="comment">Upload Image:</label>
          <input type="file" name="attachment[]" multiple accept="image/*">

        </div>

      </div>
      <div class="modal-footer">
        <input type="submit" class="save btn btn-primary" value="Save changes">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
      
  </div>
</div>
</div>
@endsection

