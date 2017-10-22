@extends('admin.layouts.master3')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tạo bảng lương theo chức vụ</h1>
                </div>
                <div class="col-lg-7" style="padding-bottom:120px">
                    @include('block.error')
                    <form method="POST" action="{{route('admin.saraly.store')}}" class="form-horizontal"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Ngày công chuẩn</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ngayCongChuan">
                                        <option value="0">Đủ 1 tháng</option>
                                        <option value="26">26 ngày</option>
                                        <option value="27">27 ngày</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Chức vụ </label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="typeEmps" id="typeEmps">
                                        @foreach($typeEmps as $typeEmp)
                                            <option value="{{$typeEmp->id_employer}}">{{$typeEmp->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Lương cơ bản </label>
                                <div class="col-sm-6">
                                    <input type="text" name="luongCoBan" value="{{old('luongCoBan')}}"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Phụ cấp </label>
                                <div class="col-sm-6">
                                    <input type="text" name="phuCap" value="{{old('phuCap')}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Khoản trừ </label>
                                <div class="col-sm-6">
                                    <input type="text" name="khoanTru" value="{{old('khoanTru')}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group" style="margin-left: 128px;">
                                <button type="submit" value="create" name="create" class="btn btn-primary">
                                    <strong>Tạo</strong></button>
                                <button type="reset" value="reset" name="reset" class="btn ">Reset</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop