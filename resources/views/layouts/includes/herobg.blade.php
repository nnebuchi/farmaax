<style type="text/css">
      .hero-text p{
        font-size: 20px;
      }
      .hero-bg{
        background-image: url({{ asset('images/wheat.jpg') }}); background-size: cover; height: 400px; background-position: bottom; z-index: 10;
      }

      .hero-overlay{
        position: absolute;top: 0; left: 0; right: 0; bottom: 0; background-color: black; opacity: 0.8; z-index: 100;
      }

      .hero-text{
        position: absolute; z-index: 1000; margin-top: 30px;
      }

      .hero-title{
        font-weight: bold;
      }

      .hero-img{
        width: 480px;
      }


      @media(max-width: 992px){
        .hero-img{
            width: 350px;
          }
      }

  </style>


    <section class="ftco-section ftco-no-pt">
        <div class="row">
            <div class="col-12 hero-bg">

                <div class="hero-overlay">
                    
                </div>
                <div class="text-white row hero-text">
                    <div class="col-md-6 offset-md-1 pl-5 pt-5">
                        {{-- <h1 class="display-4"><strong class="hero-title">{{ $page->title }}</strong> </h1> --}}
                        <p >{{ $page->description }}...</p>
                        <a href="{{ url($page->link) }}" class="btn btn-success myLearn">Get started</a>
                    </div>
                    <div class="col-md-5 pr-5 pt-5 d-none d-md-block">
                        
                            <img src="{{ asset('images/tractor_green.png') }}" class="hero-img">
                            
                        
                    </div>
                </div>
                
                
            </div>

        </div>
    </section>