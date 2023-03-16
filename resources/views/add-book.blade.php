@extends('layout2')
@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Elements</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">General Form Elements</h5>

          <!-- General Form Elements -->
          <form action="{{('create-book')}}" method="POST">
            @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Author</label>
              <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="author_id">
                  @foreach($result as $value)
                  <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                 @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail" class="col-sm-2 col-form-label">Release Date</label>
              <div class="col-sm-10">
                <input type="date" name="release_date" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="test" name="description" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">ISBN</label>
              <div class="col-sm-10">
                <input type="text" name="isbn" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Format</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="format">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Number Of Pages</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="number_of_pages">
              </div>
            </div>

            

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>

    </div>

    
  </div>
</section>

</main>

@endsection