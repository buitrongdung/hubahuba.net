@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tính lương nhân viên</h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="col-lg-7" style="margin-left: 15px">
                    <div class="form-group">
                        <strong>Mã NV: </strong>
                        {{$emp->id_employer}}
                    </div>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Chức vụ: </strong>
                            @if ($emp['type_employer'] == 0)
                                {!! "None" !!}
                            @else
                                <?php
                                $data = DB::table('type_employer')->where('id_employer', $emp['type_employer'])->first();
                                echo $data->description;
                                ?>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Họ và tên: </strong>
                            {{$emp->name}}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Chứng minh nhân dân: </strong>
                            {{$emp->cmnd}}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Ngày sinh: </strong>
                            <?php
                            echo date("d-m-Y", strtotime($emp->birthday));
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Giới tính: </strong>
                            {{$emp->gender}}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Số điên thoại: </strong>
                            0{{$emp->phone}}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <strong>Email: </strong>
                            {{$emp->email}}
                        </div>
                    </div>

                    <div class="image-face" style="margin-top: -238px;">
                        <img class="image-emp" src="{{asset('images/employer/'.$emp->image)}}">
                    </div>

                </div>
            </div>
            <div class="container">
                <div style="float: left;margin-top: -114px;">
                    <input name="_token" type="hidden" value="{!! csrf_token() !!}"/>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr align="center">
                            <th>Tháng</th>
                            <th>Năm</th>
                            <th style="width: 46px">Ngày công chuẩn</th>
                            <th>Lương cơ bản</th>
                            <th>Phụ cấp</th>
                            <th>Tổng thu nhập</th>
                            <th style="width: 46px">Ngày công thực tế</th>
                            <th>Tổng lương thực tế</th>
                            <th>Khoản trừ</th>
                            <th>Lương thực lĩnh</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($saraly as $item)
                                <tr class="odd gradeX" align="center">
                                    <td> {{ $item->month }} </td>
                                    <td> {{ $item->year }} </td>
                                    <td id="NCC" class="NCC" name="NCC"> {{ $item->ngay_cong_chuan }} </td>
                                    <td> {!! number_format($item->luong_co_ban,0,".",".") !!} VNĐ</td>
                                    <td> {!! number_format($item->phu_cap,0,".",".") !!} VNĐ</td>
                                    <td id="TTN">
                                        {!! number_format($item->luong_co_ban + $item->phu_cap,0,".",".") !!} VNĐ
                                    </td>
                                    <td>

                                        @if (!empty($item->ngayCong))
                                            <input type="text" name="ngayCong" id="ngayCong"
                                                   value="{!! $item->ngayCong !!}"
                                                   style="width: 46px;border: none;background-color: #f9f9f9;text-align: center;"
                                                   readonly
                                                   data-NCC="{!! $item->ngay_cong_chuan !!}"
                                                   data-LCB="{!! $item->luong_co_ban !!}"
                                                   data-PC="{!! $item->phu_cap !!}"
                                                   data-KT="{!! $item->khoan_tru !!}"
                                            />
                                        @else
                                            <?php echo "None";?>
                                        @endif
                                    </td>
                                    <td id="TLTT">{!! number_format(($item->luong_co_ban+$item->phu_cap)/$item->ngay_cong_chuan*$item->ngayCong,0,".",".") !!}
                                        VNĐ
                                    </td>
                                    <td>{!! number_format($item->khoan_tru,0,".",".") !!} VNĐ</td>
                                    <td id="LTL">{!! number_format(($item->luong_co_ban+$item->phu_cap)/$item->ngay_cong_chuan*$item->ngayCong-$item->khoan_tru,0,".",".") !!}
                                        VNĐ
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop