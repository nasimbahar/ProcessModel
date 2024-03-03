<!DOCTYPE html>
<html>
<head>
@include("front.includes.header")

</head>
<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">
@include("front.includes.nav")
    <div class="content-wrapper" style="min-height: 308px;">
        <div class="container">
            <section class="content-header">
               @include("front.includes.contentheader")
            </section>
         @yield("main")

        </div>

    </div>

@include("front.includes.footer")
</div>

@include("front.includes.scripts")
@yield("scripts")

</body>

</html>
