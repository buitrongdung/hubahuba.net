@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách nhân viên
                    <a href="{{route('admin.employer.create')}}" class="btn btn-primary">+ Thêm nhân viên</a>
                </h1>
            </div>
            <span style="margin-left: 13px"><b>Số lượng nhân viên: </b>
                <?php
                $user = DB::table('employer')->get();
                echo count($user);
                ?>
        	</span>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th style="width: 0px;">STT</th>
                        <th>Hình ảnh</th>
                        <th>Họ và tên</th>
                        <th>Chức vụ</th>
                        <th>Số điện thoại</th>
                        <th>Xem chi tiết</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stt = 0 ?>
                    @foreach ($emps as $emp)
                        <?php $stt += 1 ?>
                        <tr class="odd gradeX" align="center">
                            <th scope="row">{{ $stt }}</th>
                            <td>
                                <img style="height: 32px" src="{!!asset('images/employer/'.$emp['image'])!!}">
                            </td>
                            <td>{{ $emp['name'] }}</td>
                            <td>
                                @if ($emp['type_employer'] == 0)
                                    {!! "None"!!}
                                @else
                                    <?php
                                    $data = DB::table('type_employer')->where('id_employer', $emp['type_employer'])->first();
                                    echo $data->description;
                                    ?>
                                @endif
                            </td>
                            <td>0{{ $emp['phone'] }}</td>
                            <td style="width: 0px;">
                                <a style="color: blue;font-size: 16px"
                                   href="{{route('admin.employer.show',$emp['id_employer'])}}"><i
                                            class="fa fa-search-plus" aria-hidden="true"> Xem chi tiết </i>
                                </a>
                            </td>
                            <td style="text-align: center;" class="center"><i class="fa fa-pencil fa-fw"></i>
                                <a href="{{route('admin.employer.edit', $emp['id_employer'])}}">Edit</a>
                            </td>
                            <form method="POST" action="{{route('admin.employer.destroy', $emp['id_employer'])}}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" value="DELETE" name="_method">
                                <td style="text-align: center;" class="center"><i
                                            class="fa fa-trash-o  fa-fw"></i><input type="submit" name="delete"
                                                                                    onclick="return xacnhanxoa('Bạn có muốn xóa đơn hàng này?')"
                                                                                    value="Delete"/></td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@stop