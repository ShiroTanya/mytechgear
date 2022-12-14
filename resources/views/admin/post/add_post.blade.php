@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm bài viết
                        </header>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

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
                                <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Tên bài viết không được để trống" name="post_title" value="{{old('post_title')}}" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug </label>
                                    <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                                </div>
                                 <div class="form-group">                           
                                    <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="post_desc"  id="ckeditor1" placeholder="Mô tả danh mục"></textarea> 
                                </div>

                                <div class="form-group">                           
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="post_content"  id="ckeditor2" placeholder="Mô tả danh mục"></textarea> 
                                </div>
                                <div class="form-group">                           
                                    <label for="exampleInputPassword1">Meta từ khóa</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="post_meta_keywords"  id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea> 
                                </div>
                                <div class="form-group">                           
                                    <label for="exampleInputPassword1">Meta nội dung</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="post_meta_desc"  id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh đại diện cho bài viết</label>
                                    <input type="file" name="post_image" class="form-control" id="exampleInputEmail1" required="">
                                </div>

                                <div class="form-group">
                                <label for="emxampleInputPassword1"> Danh mục bài viết</label>
                                <select name="cate_post_id" class="form-control input-sm m-bot15">
                                    @foreach($cate_post as $key => $cate)
                                        <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                    @endforeach
                                </select>    
                                </div>   

                                <div class="form-group">
                                <label for="emxampleInputPassword1"> Hiển thị </label>
                                <select name="post_status" class="form-control input-sm m-bot15">
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                </select>    
                                </div>      

                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm bài viết</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
</div>

@endsection