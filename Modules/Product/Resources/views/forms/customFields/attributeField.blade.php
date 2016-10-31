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
                    <input type="text" name="{{$name}}[][name]" class="form-control" placeholder="Enter Custom Attribute Name">
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
                    <input type="text" name="{{$name}}[][value]" class="form-control" placeholder="Enter Custom Attribute Value">
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
            var elem = $('#form_{{$name}}_attribute').clone();
            elem.attr('id',elem.attr('id') + index);
            $('#form_{{$name}}_attribute').after(elem);
        });
        $(document).on('click','.removeAttribute',function () {
            $(this).parents('div.row').remove();
        })
    });
</script>