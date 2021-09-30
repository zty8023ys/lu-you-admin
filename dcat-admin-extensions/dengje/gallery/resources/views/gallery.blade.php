
<img src="{{$src}}" class="img-border" id="{{$src}}" width="{{$width}}" height="{{$height}}" alt="">

<script type="text/javascript">
    var image = new Viewer(document.getElementById('{{$src}}'),{
        url: 'data-original'
    });
</script>
