<!DOCTYPE html>
<html>
<head>
    @include("layouts.header")

</head>
<body  data-spy="scroll" data-target="#main-navbar">
<div class="page-loader"></div>
<div class="body">
    @include("layouts.menu")
    @yield("content")
    @include('layouts.footer')
</div>



</body>
</html>
