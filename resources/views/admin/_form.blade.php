@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<file-field label="商品圖片" type="image" field="product_image_id" :init-file="{{ $model->product_image ?? 'null' }}"></file-field>
<files-field :init-files="{{ $model->files }}"></files-field>
<div class="form-row">
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Title'), 'title') !!}
    </div>
    <div class="col-md-6">
        {!! TranslatableBootForm::text(__('Website'), 'link')->placeholder('https://') !!}
    </div>
</div>

<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
{!! TranslatableBootForm::textarea(__('Summary'), 'summary') !!}
<div style="color:#f6416c;position: relative; color: rgb(246, 65, 108); top: -17px;">字數限制：200字元以內</div>
