@extends('voyager::master')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', $page_title)

@section('page_header')
<h1 class="page-title">
  <i class="voyager-list-add"></i>
  {{$product_name}}

  @can('browse', 'products')
  <a href="{{ route('voyager.products.index') }}" class="btn btn-warning">
    <i class="glyphicon glyphicon-list"></i> <span
      class="hidden-xs hidden-sm">{{ __('voyager::generic.return_to_list') }}</span>
  </a>
  @endcan

  @can('add', 'products')
  <a href="#" id="btn_add_new_sku" name="btn_add_new_sku" class="btn btn-success btn-add-new-sku"
    style="margin-top:7px;">
    <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
  </a>
  @endcan
</h1>
@stop

@section('content')
<div class="page-content edit-add container-fluid" style="padding-top:10px;">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-bordered">
        <div class="panel-heading panel-default">
          <h3 class="panel-title text-uppercase">Danh sách sản phẩm con</h3>
          <div class="panel-actions">
          <a href="#" id="btn_add_new_sku" class="btn btn-success float-right btn-add-new panel-action">
                  <i class="voyager-plus" id="ico_add_new_sku"></i> <span id="text_add_new_sku">{{ __('voyager::generic.add_new') }}</span>
              </a>
          </div>
        </div>
        <div class="panel-body">
          
        <div class="font-weight-bold">
        Note: <br>
        - <span style="color:#2ecc71;"> Màu xanh</span> là Sku được đặt mặc định. <br>
        - Nhấn vào dòng muốn chỉnh sửa để cho phép chỉnh sửa.
        </div>
          @include('voyager::alerts')
          <div class="table-responsive">
            <table id="dataTable" class="table table-hover table-condensed table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Màu - Kích thước</th>
                  <th class="text-center">Số lượng</th>
                  <th class="text-center">Giá</th>
                  <th class="text-center">Khuyến mãi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($skus as $key => $sku)
                <tr title="Nhấn để chỉnh sửa!" class="tr-edit" data-id="{{$sku->id}}">
                  <td class="text-center" @if($sku->default) style="background-color:#2ecc71;" @endif>{{$sku->color->name}} - {{$sku->size->name}}</td>
                  <td class="text-center">{{$sku->quantity}}</td>
                  <td class="text-right">{{number_format($sku->price)}}đ</td>
                  <td class="text-right">@if($sku->promotion_price){{number_format($sku->promotion_price). "đ"}}@endif</td>
                </tr>
                @empty
                <tr></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-bordered hidden @if (count($errors) > 0) block @endif @if(Session::has('edit')) block @endif" id="add-edit-panel">
        <div class="panel-heading">
          <h3 class="panel-title text-uppercase" id="text_panel">Thêm</h3>
          <div class="panel-actions">
            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
          </div>
        </div>
        <!-- form start -->
        <form role="form" class="form-edit-add" action="{{route('product.productsku.store')}}" method="POST" enctype="multipart/form-data">

          <!-- CSRF TOKEN -->
          {{ csrf_field() }}

          <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="product_id" id="product_id" value="{{$id}}">
            <input type="hidden" name="sku_id" id="sku_id" value="">

            <div class="form-group">
              <label for="color_id">Màu sắc</label>
              <select class="form-control select2" name="color_id" id="color_id">
                <option value="">Không</option>
                @foreach($colors as $color)
                <option value="{{$color->id}}" @if(old('color_id') == $color->id) selected="selected" @endif>{{$color->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="size_id" class="">Kích thước</label>
              <select class="form-control select2" name="size_id" id="size_id">
                <option value="">Không</option>
                @foreach($sizes as $size)
                <option value="{{$size->id}}" @if(old('size_id') == $size->id) selected="selected" @endif>{{$size->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="quantity" class="">Số lượng <span class="text-danger">*</span></label>
              <input style="@error('quantity') border-color:red; @enderror" class="form-control" type="number" name="quantity" id="quantity" min="0" value="{{ old('quantity') }}">
            </div>

            <div class="form-group">
              <label for="price" class="@error('price') text-danger @enderror">Giá <span class="text-danger">*</span></label>
              <input style="@error('price') border-color:red; @enderror" class="form-control" type="number" name="price" id="price" value="{{ old('price') }}">
            </div>

            <div class="form-group">
              <label for="promotion_price" class="@error('promotion_price') text-danger @enderror">Giá khuyến mãi <span class="text-danger">*</span></label>
              <input style="@error('promotion_price') border-color:red; @enderror" class="form-control" type="number" name="promotion_price" id="promotion_price" value="{{ old('promotion_price') }}">
            </div>

            <input type="hidden" name="default" id="default" value="0">

            <div class="form-group">
              <label for="name">Đặt mặt định</label>
              <br>
              <input type="checkbox" name="status" class="toggleswitch" data-width="120"
                  data-on="Có"
                  data-off="Không đặt">
            </div>
          </div>

          <!-- panel-body -->

          <div class="panel-footer">
            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>            
            <button type="button" class="btn btn-danger hidden delete" style="margin-right:5px;">{{ __('voyager::generic.delete') }}</button>
            <button type="reset" class="btn btn-default hidden cancel" style="margin-right:5px;">Hủy sửa</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

@stop

@section('javascript')
<script>
  $('document').ready(function() {
    $('.toggleswitch').bootstrapToggle();
    $('[data-toggle="tooltip"]').tooltip();
    $('#btn_add_new_sku').on('click', function(e) {
      e.preventDefault();
      $('.form-edit-add').removeClass('add');
      $('.form-edit-add').parent().removeClass('hidden');
      $(this).addClass('hidden');      
      $('.cancel').removeClass('hidden');
      $('#sku_id').val('');
    });
    //delete
    $('.delete').on('click', function(e) {
      e.preventDefault();
      let id = $('#sku_id').val();
      $.ajax({
        type: "post",
        url: '/admin/products/sku/delete',
        dataType: "json",
        data: {
            "id": id,
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
          if(response == 200){
            window.setTimeout(function(){location.reload()},1000)
            toastr.success("Thành công!");
          }
          else{
            toastr.info("Lỗi! Đang có giỏ hàng chứa thông tin sản phẩm này!");
          }
        },
      }); 
    });
    //cancel button
    $('.cancel').on('click', function() {
      $('#btn_add_new_sku').removeClass('hidden');
      $('.form-edit-add').parent().addClass('hidden');
    });
    $('.tr-edit').on('click', function() {
      let taget = $(this);
      let id = taget.data('id');
      let form = $('.form-edit-add');
      
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: "put",
        url: '/admin/products/sku/get/'+id,
        dataType: "json",
        data: {
            "Id": id,
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
          $('.delete').removeClass('hidden');
          $('.cancel').removeClass('hidden');
          $('#text_panel').text('Chỉnh sửa');
          $('#sku_id').val(response.sku.id);
          $('#size_id').val(response.sku.size_id);
          $('#size_id').trigger('change');
          $('#color_id').val(response.sku.color_id);
          $('#color_id').trigger('change');
          $('#quantity').val(response.sku.quantity);
          $('#price').val(response.sku.price);
          $('#promotion_price').val(response.sku.promotion_price);
          if(response.sku.default){
            $('.toggleswitch').bootstrapToggle('on');
          }else{
            $('.toggleswitch').bootstrapToggle('off')
          }          
        },
        error: function (xhr) {
          toastr.info("Có lỗi xảy ra!");
        }
      });  
      if(form.parent().hasClass("hidden")){
        $('.form-edit-add').parent().removeClass('hidden');
      }
    });
    // get default
    $('.form-group input[type=checkbox]').on('change', function() {
      if($('.form-group input[type=checkbox]').parent().hasClass("off")){
        $('#default').val('0');
      }else{
        $('#default').val('1');
      };
    });
  });
</script>
@stop
