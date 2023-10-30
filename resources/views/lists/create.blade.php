@extends("layout.app")

@section("content")
<div class="row mb-3">
    <div class="col-12">
        <a class="btn btn-primary" href="{{route("lists.index")}}"><i class="bi bi-arrow-return-left"></i></a>
    </div>
</div>

<form action="{{route("lists.store")}}" method="POST">
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
                            <label for="inputImgURL">Image URL</label>
                            <input type="url" name="urlImage" value="{{old('urlImage')}}" class="form-control" id="inputImgURL">
                        </div>

                        <input type="hidden" name="user_id" value="1"> <!-- TODO: a supprimer, utilisé pour tester la création tant que le login n'est pas complètement implémenté -->

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
