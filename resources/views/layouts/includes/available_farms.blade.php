<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10 text-center heading-section ftco-animate">
                <span class="subheading">Invest a Farm</span>
                <h2 class="mb-4">Available Farms</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-seasonal owl-carousel ftco-owl">
                    @foreach($farms as $farm)

                    <div class="card card-body bg-transparent myBorder" style="">
                        <img class="img-fluid" src="{{asset('storage/farmcategoryImages/'.$farm->typeimage) }}"
                            style="border-radius: 20px;height: 200px;">
                        <div class="text text-center ">
                            <h3><a href="#">{{ $farm->farmtype}}</a></h3>
                            <a href="{{ url('dashboard') }}" class="btn secondary-btn btn-start">Start Farm</a>
                        </div>

                    </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

</section>
