@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{session('success')}}
        <button class="close" data-dismiss="alert" type="button" ><span>&times;</span></button>
    </div>
@endif
