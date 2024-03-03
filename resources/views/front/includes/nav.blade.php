<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{admin_url("processmodel/welcome")}}" class="navbar-brand"><b>{{config('admin.name')}}</b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if(isset($isphaseone)):?> class="active" <?php endif;?>><a href="{{admin_url("processmodel/phaseone")}}">{{__("front.phaseone")}} <span class="sr-only"></span></a></li>

                    <li <?php if(isset($isphasetwo)):?> class="active" <?php endif;?>><a href="{{admin_url("processmodel/phasetwo")}}">{{__("front.phasetwo")}} <span class="sr-only"></span></a></li>
                    <li <?php if(isset($isphasethree)):?> class="active" <?php endif;?>><a href="{{admin_url("processmodel/phasethree")}}">{{__("front.phasethree")}} <span class="sr-only"></span></a></li>
                    <li <?php if(isset($isphasefour)):?> class="active" <?php endif;?> ><a href="{{admin_url("processmodel/phasefour")}}">{{__("front.phasefour")}} <span class="sr-only"></span></a></li>

                    <li <?php if(isset($isphasefour)):?> class="active" <?php endif;?> ><a href="{{admin_url("processmodel/phasefive")}}">Phase Five<span class="sr-only"></span></a></li>

                </ul>

            </div>

        </div>

    </nav>
</header>
