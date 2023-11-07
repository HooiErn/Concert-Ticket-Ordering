@extends('backend/layouts/commonMaster')
@section('content')
<!Doctype html>
<html>
    <head>
        <title>Add Category</title>
        @if(Auth::check())
        @if (Auth::user()->isAdmin())
            <script type="text/javascript">
                window.location.href="{{url('admin/login')}}"
            </script>
        @endif
    @endif
    </head>
    <body>
        <div class="container">
            <form action="{{route('category.add')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control" id="c_name" name="c_name">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="text-danger">{{$error}}</p>
                    @endforeach
                @endif
            </form>
        </div>
    </body>
</html>
@endsection