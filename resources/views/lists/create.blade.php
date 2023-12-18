@extends("layout.app")

@section("content")
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{route("lists.index")}}"><i class="bi bi-arrow-return-left"></i></a>
    </div>
</div>

<form action="{{route("lists.store")}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-12 col-lg-6 offset-0 offset-lg-3">
            <div class="card">
                <div class="card-header">
                Create a new list
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="inputName">Name</label>
                            <input type="text" name="nom" value="{{old('nom')}}" class="form-control" id="inputName">
                        </div>

                        <div class="form-group col-12">
                            <label for="inputImgURL">Image</label>
                            <input type="file" accept="image/png, image/jpeg" class="form-control" name="urlImage" value="{{old('urlImage')}}" id="inputImgURL"/>
                        </div>


                        @if ($errors->any())
                            <div class="alert alert-danger mt-3 col-12">
                                <strong>Error!</strong> Please check your inputs.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary mt-3">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
