<section style="background-color: #f8f4e7;">
       
            <div class="container text-center py-5">
                <div class="h4 myFontsize2 myAmaranth font-weight-bold pt-md-5 pt-2 text-uppercase">Choose your farm type From the category</div>
                <p class="text-center text-dark pb-3">Create your Farmaax account today and get your farm project started. </p>
                <div class="row mx-auto my-auto">
                    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            @php $farm_count =1; @endphp
                            @foreach($farms as $farm)
                            <div class="carousel-item @php echo $farm_count==1? 'active' : '' @endphp">
                                <div class="col-md-4 col-sm-8 offset-sm-2 offset-md-0 col-12">
                                    {{-- <div class="col-md-4 col-sm-6 offset-sm-3 offset-md-0 col-10 offset-1"> --}}
                                    <div class="card card-body bg-transparent myBorder align-content-center farm-type-card">
                                        <img class="img-fluid farm-type-img" src="{{ asset('storage/farmcategoryImages/'.$farm->image) }}">
                                        <div class="h3 text-center smalltext myAmaranth text-dark">{{ $farm->name }}</div>
                                        {{-- <div class="col-6"> --}}
                                <!-- <small class="headin mb-0"><a href="#">6 Months</a></small> -->
                                <!-- <span> Duration</span> -->
                                <p><a href="{{ url('start-farm') }}" id="farm-{{ $farm->id }}-invest" farm-id="{{ $farm->id }}" class="btn primary-btn btn-block" style="border-radius: 10px;">Select</a></p>
                            {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                            @php $farm_count ++; @endphp
                            @endforeach
                           
                        </div>
                        <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark border border-dark p-3 rounded-circle" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon bg-dark border border-dark p-3 rounded-circle" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            
            </div>
       
        


        <style>
            @media (max-width: 768px) {
                .carousel-inner .carousel-item > div {
                    display: none;
                }
                .carousel-inner .carousel-item > div:first-child {
                    display: block;
                }
            }
            
            .carousel-inner .carousel-item.active,
            .carousel-inner .carousel-item-next,
            .carousel-inner .carousel-item-prev {
                display: flex;
            }
            
            /* display 3 */
            @media (min-width: 768px) {
                
                .carousel-inner .carousel-item-right.active,
                .carousel-inner .carousel-item-next {
                  transform: translateX(33.333%);
                }
                
                .carousel-inner .carousel-item-left.active, 
                .carousel-inner .carousel-item-prev {
                  transform: translateX(-33.333%);
                }
            }
            
            .carousel-inner .carousel-item-right,
            .carousel-inner .carousel-item-left{ 
              transform: translateX(0);
            }
            
            .myBorder{
                border: solid 10px #4e9525!important;
                border-radius: 100px!important;
            }
            
    
        </style>
    </section>