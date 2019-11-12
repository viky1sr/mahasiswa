@extends('layout/main');

@section('kepo')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Posts</h3>
                                <div class="right">
                                    <a href="{{route('posts.add')}}" class="btn btn-primary">Add new posts</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITLE</th>
                                        <th>USER</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{{$post->user->name}}</td>
                                            <td>
                                                <a target="_blank" href="{{route('site.single.post', $post->slug)}}" class="btn btn-info btn-sm">View</a>
                                                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm delete" post-id="{{$post->id}}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @stop

        @section('footer')
            <script>
                $('.delete').click(function (){
                    var user_id = $(this).attr('post-id');

                    swal({
                        title: "Yakin anda?",
                        text: "Mau di hapus posts dengan id "+user_id+" ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            console.log(willDelete);
                            if (willDelete) {
                                window.location = "/posts/"+user_id+"/delete";
                            }
                        });

                });
            </script>
@stop

