@extends('layouts.backend.app')

@section('title','Likes')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div style="margin-top:90px;margin-left:300px;" class="container-fluid">
            
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All LIKES
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th class ="text-center">Liked By</th>
                                            <th class ="text-center">Post Info</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class ="text-center">Liked By</th>
                                            <th class ="text-center">Post Info</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($posts as $key=>$post)
                                            @foreach($post->favorite_to_users as $user)
                                            <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-left">
                                                        <a href ="#">
                                                            <img class="media-object" src="{{ Storage::
                                                            url('profile/'.$user->image)}}"
                                                            width="64" height ="64">
                                                        </a>

                                                    </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading">{{ $user->name}}
                                                                
                                                            </h4>
                                                            
                                                            
                                                            </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-left">
                                                        <a target="blank" href="{{ route('post.details',
                                                            $post->slug)}}">
                                                        <img class="media-object" src="{{ Storage::
                                                        url('post/'.$post->image)}}"
                                                        width="64" height ="64">
                                                        </a>

                                                    </div>
                                                    
                                                        <div class="media-body">
                                                            
                                                            <a target="blank" href="{{ route('post.details',
                                                            $post->slug)}}">
                                                            <h4 class="media-heading">{{ str_limit 
                                                            ($post->title,'40')}}
                                                            </h4>
                                                            </a>

                                                            <p>by <strong>{{$post->user->name}}</strong></p>
                                                            </div>

                                                    </div>
                                                </td>
                                        

                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>

    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script type ="text/javascript">
        function deleteComment(id) {


                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsstyling: false,
                    reverseButtons: true
                }).then((result) => {
                        if (result.value) {
                            event.preventDefault();
                            document.getElementById('delete-form-'+id).submit();
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === swal.DismissReason.cancel
                        ) {
                            swal(
                            'Cancelled',
                            'Your data is safe :)',
                            'error'
                            )
                        }
            })
}

    </script>

@endpush