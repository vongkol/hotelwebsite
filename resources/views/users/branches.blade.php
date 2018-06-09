@extends('layouts.app')
@section('content')
    <?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
    <?php include(app_path()."/lang/". $lang); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> {{$lb_user_branch}}&nbsp;&nbsp;
                </div>
                <div class="card-block">
                    {{$lb_username}}: <strong>{{$user->name}}</strong>, {{$lb_email}}: <strong>{{$user->email}}</strong>, {{$lb_role}}: <strong>{{$user->role_name}}</strong>
                    <hr>
                    <form action="#" class="form-inline">
                        {{csrf_field()}}
                        <input type="hidden" id="user_id" value="{{$user->id}}">
                        <label>{{$lb_branch}}:&nbsp;</label>
                        <select name="branch" id="branch" class="form-control">
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary" id="btnAdd" onclick="addBranch('{{$lb_confirm_add}}')">{{$lb_add}}</button>
                    </form>
                    <br>
                    <table class="table table-condensed table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>{{$lb_id}}</th>
                            <th>{{$lb_name}}</th>

                            <th>{{$lb_action}}</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        @php($i=1)
                        @foreach($user_branches as $b)
                            <tr id="{{$b->id}}">
                                <td>{{$i++}}</td>
                                <td>{{$b->name}}</td>
                                <td>
                                    <a href="#"
                                       onclick="rmBranch(this,'{{$b->id}}', event,'{{$lb_confirm_delete}}')" title="{{$lb_delete}}"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
@section('js')
    <script>
        function addBranch(sms) {
            var user_id = $("#user_id").val();
            var branch_id = $("#branch").val();
            var o = confirm(sms);
            if(o)
            {
                var user_branch = {user_id: user_id, branch_id: branch_id};
                $.ajax({
                    type: "POST",
                    url: burl + "/user/branch/save",
                    data: user_branch,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                    },
                    success: function (id) {
                        if(id)
                        {
                           var i = $("#data tr").length + 1;
                           var tr = "<tr id='" + id + "'>";
                           tr += "<td>" + i + "</td>";
                           tr += "<td>" + $("#branch :selected").text() + "</td>";
                           tr += "<td>" + "<a href='#' onclick='rmBranch(this," + id + ",event,\"{{$lb_confirm_delete}}\")' title='{{$lb_delete}}'><i class='fa fa-remove text-danger'></i></a>" + "</td>";
                           tr += "</tr>";
                           if(i>1)
                           {
                               $("#data tr:last-child").after(tr);
                           }
                            else{
                               $("#data").html(tr);
                           }
                        }
                    }
                });
            }
        }
        function rmBranch(obj, id, evt, sms) {
            evt.preventDefault();
            var o = confirm(sms);
            if(o)
            {
                $.ajax({
                    type: "GET",
                    url: burl + "/user/branch/delete/" + id,
                    success: function (x) {
                        if(x)
                        {
                            $(obj).parent().parent().remove();
                        }
                    }
                });
            }
        }
    </script>
@endsection