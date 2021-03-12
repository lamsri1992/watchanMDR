<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="background-image: url(https://new.watchanhospital.com/assets/img/hospital_front.jpg); 
    background-size: cover; background-position: bottom;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h1 class="display-2 text-white">{{ $title }}</h1>
                @if(isset($description) && $description)
                    <p class="text-white mt-0 mb-5">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
