<!Doctype html>
<html>
    <head>
        <title>Edit Category</title>
        @if(Auth::user()->isAdmin())
            <script type="text/javascript">
                window.location.href="{{url('admin/login')}}"
            </script>
        @endif
    </head>
    <body>
        <div class="container">
            <form action="{{ route('category.update') }}" method="POST">
                @csrf

                @foreach($categories as $category)
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
                        <input type="hidden" class="form-control" id="categoryID" name="categoryID" value="{{$category->id}}">
                    </div>
                @endforeach
                
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