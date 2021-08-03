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
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Danh sách sản phẩm con</h3>
          <div class="panel-actions">
            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
          </div>
        </div>
        <div class="panel-body">
          @include('voyager::alerts')
          <div class="table-responsive">
              <a href="#" class="btn btn-success float-right btn-add-new">
                  <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
              </a>
            <table id="dataTable" class="table table-hover table-condensed table-bordered">
              <thead>
                <tr>
                  <th>#No</th>
                  <th>Màu</th>
                  <th>Kích thước</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                  <th>Khuyến mãi</th>
                  <th class="actions text-right dt-not-orderable">

                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($skus as $key=>$sku)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$sku->size->name}}</td>
                  <td>{{$sku->color->name}}</td>
                  <td>{{$sku->quantity}}</td>
                  <td>{{$sku->price}}</td>
                  <td>{{$sku->promotion_price}}</td>
                  <td class="no-sort no-click bread-actions">
                    123123
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-bordered">
        <div class="panel-heading">
          <h3 class="panel-title" id="text_panel">Thêm</h3>
          <div class="panel-actions">
            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
          </div>
        </div>
        <!-- form start -->
        <form role="form" class="form-edit-add" action="/" method="POST" enctype="multipart/form-data">

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

            <input type="hidden" name="product_id" value="{{$id}}">

            <div class="form-group">
              <label for="color_id">Màu sắc</label>
              <select class="form-control select2" name="color_id">
                <option value="">Không</option>
                @foreach($colors as $color)
                <option value="{{$color->id}}">{{$color->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="size_id" class="">Kích thước</label>
              <select class="form-control select2" name="size_id">
                <option value="">Không</option>
                @foreach($sizes as $size)
                <option value="{{$size->id}}">{{$size->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="quantity" class="">Số lượng</label>
              <input class="form-control" type="number" name="quantity" id="quantity" min="0" required>
            </div>

            <div class="form-group">
              <label for="price" class="">Giá</label>
              <input class="form-control" type="number" name="price" id="price" required>
            </div>

            <div class="form-group">
              <label for="promotion_price" class="">Khuyến mãi</label>
              <input class="form-control" type="number" name="promotion_price" id="promotion_price">
            </div>
          </div>

          <!-- panel-body -->

          <div class="panel-footer">
            @section('submit-buttons')
            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
            @stop
            @yield('submit-buttons')
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
      </div>

      <div class="modal-body">
        <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
        <button type="button" class="btn btn-danger"
          id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete File Modal -->
<div class="modal fade modal-static" id="show_image_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <img style="width:100%;" src=" " alt=" " class="image_modal_src">
      </div>
    </div>
  </div>
</div>
<!-- End Show Image Modal -->
@stop

@section('javascript')
<script>
  var params = {};
  var $file;

  function deleteHandler(tag, isMulti) {
    return function() {
      $file = $(this).siblings(tag);
      params = {
        slug: '/',
        filename: $file.data('file-name'),
        id: $file.data('id'),
        field: $file.parent().data('field-name'),
        multi: isMulti,
        _token: '{{ csrf_token() }}'
      }
      $('.confirm_delete_name').text(params.filename);
      $('#confirm_delete_modal').modal('show');
    };
  }

  function showImages(tag, isMulti) {
    return function() {
      $file = $(this);
      console.log($file.attr('src'));
      $('.image_modal_src').attr('src', $file.attr('src'));
      $('#show_image_modal').modal('show');
    };
  }
  $('document').ready(function() {
    $('.toggleswitch').bootstrapToggle();
    //Init datepicker for date fields if data-datepicker attribute defined
    //or if browser does not handle date inputs
    $('.form-group input[type=date]').each(function(idx, elt) {
      if (elt.hasAttribute('data-datepicker')) {
        elt.type = 'text';
        $(elt).datetimepicker($(elt).data('datepicker'));
      } else if (elt.type != 'date') {
        elt.type = 'text';
        $(elt).datetimepicker({
          format: 'L',
          extraFormats: ['YYYY-MM-DD']
        }).datetimepicker($(elt).data('datepicker'));
      }
    });
    $('.side-body input[data-slug-origin]').each(function(i, el) {
      $(el).slugify();
    });
    $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
    $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
    $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
    $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));
    $('.form-group').on('click', '.show-multi-image', showImages('img', true));
    $('.form-group').on('click', '.show-single-image', showImages('img', false));
    $('#confirm_delete').on('click', function() {
      $.post('/', params, function(response) {
        if (response &&
          response.data &&
          response.data.status &&
          response.data.status == 200) {
          toastr.success(response.data.message);
          $file.parent().fadeOut(300, function() {
            $(this).remove();
          })
        } else {
          toastr.error("Error removing file.");
        }
      });
      $('#confirm_delete_modal').modal('hide');
    });
    $('[data-toggle="tooltip"]').tooltip();
    $('#btn_add_new_sku').on('click', function() {
      $('.form-edit-add').attr("action", "/");
      $('.form-edit-add').attr("method", "POST");
    });
  });
</script>
@stop