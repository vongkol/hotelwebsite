@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Page List&nbsp;&nbsp;
                    <a href="{{url('/admin/page/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Title</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($pages as $pag)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$pag->title}}</td>
                                    <td>/page/{{$pag->id}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{url('/admin/page/view/'.$pag->id)}}" title="view"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-xs btn-info" href="{{url('/admin/page/edit/'.$pag->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" href="{{url('/admin/page/delete/'.$pag->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection