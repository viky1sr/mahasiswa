@extends('layout/main');

@section('kepo')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Edit Posts</h3>
                            </div>
                            <div class="panel-body">
                                <form action="/posts/{{$post->id}}/update" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                    <div class="form-grup">
                                        <label for="exampleInputEmaill">Title</label>
                                        <input name="title" type="text" class="form-control" id="exampleInputEmaill" aria-describedby="emailHelp" placeholder="Title" value="{{$post->title}}">
                                    </div>
                                    <div class="form-grup">
                                        <label for="exampleFormControlTextareal">Content</label>
                                        <textarea name="content" class="form-control" id="content" rows="3" >{{$post->content}}</textarea>
                                    </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group">
                                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                              <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                    <input id="thumbnail" class="form-control" type="text" name="thumbnail" value="{{$post->thumbnail}}">
                                </div>
                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                <div class="input-group">
                                    <input type="submit" class="btn btn-info" value="Submit">
                                </div>
                            </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            });
        $(document).ready(function () {
            $('#lfm').filemanager('image');
        });
    </script>
@stop
