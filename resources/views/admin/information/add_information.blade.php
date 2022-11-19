@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thông tin
                        </header>

                        <?php
                            $message = Session::get('message');
                            if($message)
                            {
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message', null);
                            }
                            ?>
                            
                        <div class="panel-body">
                      <div class="position-center">
                        @foreach($contact as $key => $cont)
                                <form role="form" action="{{URL::to('/update-info/'.$cont->info_id)}}" method="post"enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                
                                <div class="form-group">                           
                                    <label for="exampleInputPassword1">Thông tin liên hệ</label>
                                    <textarea style="resize: none" data-validation="length" data-validation-length="min1" data-validation-error-msg="Thông tin liên hệ không được để trống" rows="8" class="form-control" name="info_contact"  id="ckeditor" >
                                     {{$cont->info_contact}}   
                                    </textarea> 
                                </div>

                                <div class="form-group">                           
                                    <label for="exampleInputPassword1">bản đồ</label>
                                    <textarea style="resize: none" data-validation="length" data-validation-length="min1" data-validation-error-msg="Bản đồ không được để trống"  rows="8" class="form-control" name="info_map"  id="exampleInputPassword1" >{{$cont->info_map}}</textarea> 
                                </div>

                                <div class="form-group">                           
                                    <label for="exampleInputPassword1">Fanpage</label>
                                    <textarea style="resize: none" data-validation="length" data-validation-length="min1" data-validation-error-msg="Fanpage không được để trống" rows="8" class="form-control" name="info_fanpage"  id="exampleInputPassword1" >{{$cont->info_fanpage}}</textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh logo</label>
                                    <input type="file" name="info_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{url('public/uploads/contact/'.$cont->info_logo)}}" height="100" width="100">
                                </div>

                                <button type="submit" name="add_info" class="btn btn-info">Cập nhật thông tin</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
</div>

@endsection