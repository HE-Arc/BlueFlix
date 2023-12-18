<p class="d-inline-flex gap-1">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Add to list
    </a>
</p>

<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <input type="hidden" id="elementId" value="{{$elementId}}">
        <input type="hidden" id="elementType" value="{{$elementType}}">
        @if ($lists->isEmpty())
                <p>You don't have any list yet.</p>
                <a class ="btn btn-outline-primary" href="{{ url('/lists/create') }}">Create a new list</a>
        @else
            @foreach ($lists as $list)
            <div>
                <input type="checkbox" class="cbxList" value="{{$list->id}}" @checked(in_array($list->id, $checkedLists))> {{$list->nom}}
            </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    //Ajax call to update asynchroneously the lists
    $(document).ready(function() {
        $('.cbxList').change(function() {
            var data = $(this);
            var checked = data.is(":checked") == true ? 1 : 0; //needed to convert boolean to 1 or 0 because laravel validation doesn't work with "true" or "false" for boolean but with 1 or 0
            $.ajax({
                    url: '/lists/ajax',
                    type: 'POST',
                    data: {
                        listId: data.val(),
                        isChecked: checked,
                        elementData: $('#elementId').val(),
                        elementType: $('#elementType').val()
                    },
                    success: function(response) {
                        console.log('Success :', response);
                        alert("List updated successfully");
                    },
                    error: function(error) {
                        console.log('Erreur :', error);
                    }
                });
        });
    });


</script>
