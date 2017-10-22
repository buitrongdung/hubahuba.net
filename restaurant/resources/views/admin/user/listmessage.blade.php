@extends('admin.layouts.master2')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách lời nhắn khách hàng</h1>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th style="width: 0px;">STT</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Lời nhắn</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stt = 0 ?>
                    @foreach ($message as $mesg)
                        <?php $stt += 1 ?>
                        <tr>
                            <th scope="row">{{ $stt }}</th>
                            <td>{{ $mesg->name }}</td>
                            <td>{{ $mesg->email }}</td>
                            <td>0{{ $mesg->phone }}</td>
                            <td>{{ $mesg->message}}</td>
                            <th style="width: 0px;">
                                <form method="POST" action="{{route('admin.message.destroy', $mesg['id'])}}">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button style="height: 31px;margin-top: -4px; font-size: 15px;"
                                            class="btn btn-danger fa fa-trash-o fa-lg"
                                            onclick="return xacnhanxoa('Bạn có muốn xóa không?')" type="submit"
                                            class="btn btn-danger" value="Delete"> Xóa
                                    </button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="top-menu pull-left" style="margin-top: 12px">
                    <ul>
                        @if ($message->currentPage() != 1)
                            <li><a href="{{str_replace('/?', '?', $message->url($message->currentPage() - 1)) }}"
                                   style="color:black;font-size: 18px"><i class="fa fa-backward" aria-hidden="true"></i></a>
                            </li>
                        @endif
                        @for ($i = 1; $i <= $message->lastPage(); $i = $i + 1 )
                            <li class="{{$message->currentPage() == $i ? 'scroll' : ''}}">
                                <a href="{{str_replace('/?', '?', $message->url($i)) }}"
                                   style="color:black; font-size: 18px">{{$i}}</a>
                            </li>
                        @endfor
                        @if ($message->currentPage() != $message->lastPage())
                            <li><a href="{{str_replace('/?', '?', $message->url($message->currentPage() + 1)) }}"
                                   style="color:black; font-size: 18px"><i class="fa fa-forward" aria-hidden="true"></i></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop