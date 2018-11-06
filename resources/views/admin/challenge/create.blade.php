@extends('masters.nav')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/quill/dist/quill.snow.css')}}">
@endpush
@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="text-dark">
                        <h4 class="card-title"><strong> Challenge </strong></h4>
                    </a>
                    <hr>
                    <form action="@yield('action', route('admin.challenge.store'))" method="post" id="challenge" enctype="multipart/form-data">
                        @csrf
                        @yield('method')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="input-group mb-3">

                            <input type="text" class="form-control" placeholder="Challenge Name" name="name"
                                   value="{{$challenge['name'] ?? old('name')}}">
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-control" name="point_mode" id="point_mode">
                                <option value="point_mode" disabled selected>Mode</option>
                                <option value="static">Static</option>
                                <option value="decrease">Decreasing</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="category_id" disabled selected>Category</option>
                                @foreach($categories as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Flag" name="flag"
                                   value="{{$challenge['flag'] ?? old('flag')}}">
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Point" name="point"
                                   value="{{$challenge['point'] ?? old('point')}}">
                            <input type="number" class="form-control" placeholder="Submission Limit"
                                   name="submission_limit"
                                   value="{{$challenge['submission_limit'] ?? old('submission_limit')}}">
                            <select class="form-control" name="visible" id="visible">
                                <option value="visible" disabled selected>Visibility</option>
                                <option value="1">Visible</option>
                                <option value="0">Invisible</option>
                            </select>
                        </div>

                        @yield('attachment')

                        <h5>Content</h5>
                        <div id="editor" class="mb-3" style="height: 300px;" name="lol">
                        </div>

                        <div class="input-group mb-3">
                            <input type="file" class="form-control" placeholder="Attachment"
                                   aria-label="Attachment" name="attachments[]" multiple>
                        </div>

                        <input type="hidden" name="description" id="content">

                        <button type="button" class="btn waves-effect waves-light btn-outline-success"
                                onclick="check()">
                            Save<i class="ml-2 ti-control-forward"></i></button>
                        <a href="{{route('admin.challenge.index')}}"
                           class="btn waves-effect float-right waves-light btn-outline-warning">
                            Cancel<i class="ml-2 ti-close"></i></a>
                    </form>
                    @yield('delete')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $(document).ready(function () {
            var myEditor = document.querySelector('#editor');
            myEditor.children[0].innerHTML = "{!! $challenge['description'] ?? old('description') !!}"
        });

        function check() {
            var myEditor = document.querySelector('#editor');
            var html = myEditor.children[0].innerHTML;

            $('#content').val(html);
            $('form#challenge').submit();
        }
    </script>
    <script>
        $('#point_mode').val('{{$challenge['point_mode'] ?? old('point_mode', 'point_mode')}}');
        $('#category_id').val('{{$challenge['category_id'] ?? old('category_id', 'category_id')}}');
        $('#visible').val('{{$challenge['visible'] ?? old('visible', 'visible')}}');
    </script>
@endpush