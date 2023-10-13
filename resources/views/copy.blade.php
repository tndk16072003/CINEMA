getNow() {
	const today = new Date();
	const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
	this.timestamp = date;
},

{{-- LẤY NGÀY THÁNG HIỆN TẠI --}}

format_day(value) {
	return moment(String(value)).format('MM/DD/YYYY');
},

{{-- FORMAT NGÀY/THÁNG/NĂM --}}



<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mo_ta'); // replace name mô tả
    CKEDITOR.replace('update_mo_ta'); // replace name mô tả
</script>
{{-- JS --}}
... = CKEDITOR.instances['Name'].getData();
{{-- LẤY DỮ LIỆU --}}
CKEDITOR.instances['Name'].setData(value);
{{-- GỬI DỮ LIỆU --}}
{{-- TẠO KHUNG TEXT --}}



<script>
    var route_prefix = "/laravel-filemanager";
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $("#lfm").filemanager('image', {prefix : route_prefix});
    // $("#lfm_update").filemanager('image', {prefix : route_prefix});
</script>
{{-- JS --}}

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
{{-- WEB ROUTE --}}



composer require unisharp/laravel-filemanager
php artisan vendor:publish --tag=lfm_config
php artisan vendor:publish --tag=lfm_public
php artisan storage:link
{{-- TERMINAL --}}
<div class="input-group">
    <input id="hinh_anh" class="form-control" type="text" name="filepath">
    <span class="input-group-prepend">
        <a id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
        </a>
    </span>
</div>
<div id="holder" style="margin-top:15px;max-height:100px;"></div>
{{-- HTML --}}
{{-- CÀI env --}}
{{-- CÀI FILE MANANGER CHỌN ẢNH --}}



toSlug(str) {
    str = str.toLowerCase();
    str = str
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');
    str = str.replace(/[đĐ]/g, 'd');
    str = str.replace(/([^0-9a-z-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/-+/g, '-');
    str = str.replace(/^-+|-+$/g, '');
    return str;
},
{{-- TO SLUG --}}

DB::raw('date_format(phims.ngay_khoi_chieu , "%d/%m/%Y") as ngay_khoi_chieu')
{{-- FORMAT DATE --}}

<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
{{-- ĐOẠN DÙNG ĐỂ HIỆN TOASTR TỪ REQUEST (PHIMPAGE) --}}

@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
{{-- ĐOẠN DÙNG ĐỂ HIỆN TOASTR TỪ REQUEST (PHIMPAGE) HTML --}}

<?php
    $date = new DateTimeImmutable($dateTime);
    echo $date->format('H:i d/m/Y');
?>
{{-- FORMAT DATETIME BY PHP --}}

<script>
    $(document).ready(function() {
        $('button').on('click', function() {
            if($('#').val() == '') {
                $('button').attr('disabled', 'disabled');
            }
        });
        $('input').on('keyup', function() {
            $('button').attr('disabled', false);
        });
    });
</script>
{{-- VÔ HIỆU HOÁ BUTTON NẾU KHÔNG NHẬP VÀO  --}}
