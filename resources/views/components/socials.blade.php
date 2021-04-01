<!-- Footer -->
<footer id="footer" class="section">

    <!-- container -->
    <div class="container">

    <!-- row -->
    <div id="bottom-footer" class="row">

    <!-- social -->
    <div class="col-md-4 col-md-push-8">
    <ul class="footer-social">
        @if($sett->facebook !=null)

        <li>
            <a href="{{$sett->facebook}}" target='_blank' class="facebook">
                <i class="fa fa-facebook"></i>
            </a>
        </li>
        @endif

        @if($sett->twitter !=null)
             <li><a href="{{$sett->twitter}}" target='_blank'class="twitter"><i class="fa fa-twitter"></i></a></li>
        @endif

        @if($sett->instagram !=null)
            <li><a href="{{$sett->instagram}}" target='_blank' class="instagram"><i class="fa fa-instagram"></i></a></li>
        @endif

        @if($sett->youtube !=null)
            <li><a href="{{$sett->youtube}}" target='_blank' class="youtube"><i class="fa fa-youtube"></i></a></li>
        @endif

        @if($sett->linkedin!=null)
             <li><a href="{{$sett->linkedin}}" target='_blank' class="linkedin"><i class="fa fa-linkedin"></i></a></li>
        @endif
    </ul>
    </div>
    <!-- /social -->

    <!-- copyright -->
    <div class="col-md-8 col-md-pull-4">
    <div class="footer-copyright">
        <span>&copy; Copyright 2021. All Rights Reserved. | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">SkillsHub</a></span>
    </div>
    </div>
    <!-- /copyright -->

    </div>
    <!-- row -->

    </div>
    <!-- /container -->

    </footer>
    <!-- /Footer -->
