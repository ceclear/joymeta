<div class="btn">
    <a class="btn btn-sm btn-default  pull-right my_button_class"
       @if ($is_ajax == 0)
       href="{{$url}}"
       @endif
    ><i class="fa {{$icon}}"></i> {{$text}}</a>
</div>