@if(isset($options['value']))
    @php
        $attributes = json_decode($options['value']);
        $itemsCount= count($attributes) -1 ;
    @endphp
    @foreach( $attributes as $attribute)
        <div class="row" id="form_{{$name}}_attribute">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    @if($showLabel && $options['label'] !== false && $options['label_show'])
                        <label for="{{$name}}">{{$options['label']}}</label>
                    @endif
                    @if($showField)
                        <div class="input-group input-group-sm">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-info addNewAttribute"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" name="{{$name}}[{{$loop->index}}][name]" value="{{$attribute->name}}" class="form-control" placeholder="Enter Custom Attribute Name">
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    @if($showLabel && $options['label'] !== false && $options['label_show'])
                        <label for="{{$name}}">{{$options['label']}}</label>
                    @endif
                    @if($showField)
                        <div class="input-group input-group-sm">
                            <input type="text" name="{{$name}}[{{$loop->index}}][value]" value="{{$attribute->value}}" class="form-control" placeholder="Enter Custom Attribute Value">
                            <span class="input-group-btn">
                      <button type="button" class="btn btn-danger removeAttribute"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                    </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <script>
        $(document).ready(function() {
            var index = {{$itemsCount}};
            $(document).on('click','.addNewAttribute',function () {
                index++;
                var elem = $(this).closest('div.row').clone();
                elem.attr('id',elem.attr('id') + index);
                var formFields = elem.find('input.form-control');
                $.each(formFields, function (i, item) {
                    if(i === 0){
                        $(item).attr('name','{{$name}}['+index+'][name]');
                    }else {
                        $(item).attr('name','{{$name}}['+index+'][value]');
                    }
                    $(item).val('');
                });
                $(this).closest('div.row').after(elem);
            });
            $(document).on('click','.removeAttribute',function () {
                $(this).closest('div.row').remove();
            })
        });
    </script>
@else
    <div class="row" id="form_{{$name}}_attribute">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                @if($showLabel && $options['label'] !== false && $options['label_show'])
                    <label for="{{$name}}">{{$options['label']}}</label>
                @endif
                @if($showField)
                    <div class="input-group input-group-sm">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-info addNewAttribute"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                        </div>
                        <!-- /btn-group -->
                        <input type="text" name="{{$name}}[0][name]" class="form-control" placeholder="Enter Custom Attribute Name">
                    </div>
                @endif
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                @if($showLabel && $options['label'] !== false && $options['label_show'])
                    <label for="{{$name}}">{{$options['label']}}</label>
                @endif
                @if($showField)
                    <div class="input-group input-group-sm">
                        <input type="text" name="{{$name}}[0][value]" class="form-control" placeholder="Enter Custom Attribute Value">
                        <span class="input-group-btn">
                      <button type="button" class="btn btn-danger removeAttribute"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                    </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var index = 0;
            $(document).on('click','.addNewAttribute',function () {
                index++;
                var elem = $(this).closest('div.row').clone();
                elem.attr('id',elem.attr('id') + index);
                var formFields = elem.find('input.form-control');
                $.each(formFields, function (i, item) {
                    if(i === 0){
                        $(item).attr('name','{{$name}}['+index+'][name]');
                    }else {
                        $(item).attr('name','{{$name}}['+index+'][value]');
                    }
                    $(item).val('');
                });
                $(this).closest('div.row').after(elem);
            });
            $(document).on('click','.removeAttribute',function () {
                $(this).closest('div.row').remove();
            })
        });
    </script>
@endif

