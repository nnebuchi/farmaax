@extends('layouts.dashboard_master')

@section('content')
<style>
    .farm-cover-img {
        height: 200px;
    }

    .blog-entry {
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.296);
    }

</style>
    

        <div class="row mb-3">
            <div class="col-md-6 offset-md-3 item">
                <h2 class="text-center">My Setups</h2>

            </div>
        </div>
   



    <!-- detail Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>

            </div>
        </div>
    </div>

    <!-- invest Modal -->
    <div class="modal fade" id="invest-modal" tabindex="-1" role="dialog" aria-labelledby="invest-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-titl" id="exampleModalLabel">Make Investment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-bod px-3 py-3">
                    <h3>Available Units: <span class="aval-unit"></span></h3>
                    <form method="post" action="{{ url('confirminvestment') }}">
                        @csrf
                        <div class="form-group">
                            <label>Units</label>
                            <input type="number" name="units" class="form-control units" required>
                        </div>
                        <input type="hidden" name="farm_id" class="farm_id" required>
                        {{-- <input type="hidden" name="farm_id" class="farm_id">
                        --}}
                        <button class="btn btn-block primary-btn">Make Investment</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                @foreach ($farmArr as $farm)
                    

                    <div class="col-md-4 col-sm-6 mt-5">
                <div class="card card-body myBorder myFarmSelect bg-white">
                    <div class="myImg d-flex justify-content-center mb-3">
                        <img src="{{ asset('storage/farmcategoryImages/'.$farm->image) }}" alt="">
                    </div>
                    <!-- row1 -->
                   <h4 class="text-center">{{ $farm->name }}</h4>
                   @if(!empty($farm->landDetail))
                   ({{ $farm->landDetail->town }}- {{ $farm->landDetail->lgaName }} LGA - {{ $farm->landDetail->stateName }})
                   @endif
                   
                       <div class="row text-dark px-4 mt-1">
                           <div class="col-6">
                               <div class="text-left nanumGothic">
                                    Size (Acres)
                                </div>

                           </div>
                           
                           <div class="col-6">
                                <div class="text-left">
                                   {{ $farm->size }} Acres
                                </div>
                           </div>
                       </div>
                  
                  
                       <div class="row text-dark px-4">
                           <div class="col-6">
                               <div class="text-left nanumGothic">
                                  Farm Cost
                                </div>

                           </div>
                           
                           <div class="col-6">
                                <div class="text-left">
                                    {{number_format($farm->total_farm_cost)}} NGN
                                </div>
                           </div>
                       </div>

                       @if(!empty($farm->landDetail))
                   
                  
                            <div class="row text-dark px-4">
                               <div class="col-6">
                                   <div class="text-left nanumGothic">
                                       Land Cost
                                    </div>

                               </div>
                               
                               <div class="col-6">
                                    <div class="text-left">
                                        {{number_format($farm->total_land_cost) }} NGN
                                    </div>
                               </div>
                            </div>

                        @endif

                </div>
             </div>
                @endforeach

            </div>
            
        </div>
    </section>




<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Carter+One&display=swap');

@import url('https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap');
.main-wrapper{
    width:100%;
    margin:0 auto;
    text-align:center;
    /* font-family: 'Roboto', sans-serif; */
    position:relative;
}


body{
    background: #f8f4e7!important;
    font-family: 'Carter One', cursive;
}

button{
    background:none;
    border:none;
}
.menu-icon{
    color:#fff;
}
.opennav{
    /* position:fixed;
    left: 20px;
    top: 40px;
    outline:none;
    transition:ease 0.8s; */
}

.myNavlink{
 font-weight: 500!important;
 color:#2f5f13!important;
}

.myCardStyle{
    border-radius: 90px!important;
    border: 0!important;
    margin-top:35px ;
    background: #fbd341!important;
}

.myCardStyleGreen{
    border-radius: 90px!important;
    border: 0!important;
    margin-top:35px ;
    background: #4e9525!important;
}

.mySmCard{
    border-radius: 90px!important;
    border:0!important;
    margin-top:50px!important;
    background: #C1C530!important;
}



.myCardTitle{
    font-size:25px!important;
    text-transform: uppercase;
    font-weight: 800!important;
}


.myCardStyle img{
    width:120px;
    position: relative;
    top:-40px;
    border: solid 5px #fbd341!important;
    /* min-height:00px!important; */
}

.myCount{
    font-size: 85px!important;
    font-weight: 1000;
    position: relative;
    top:-160px;
    color:#fff!important;
}

.total{
    font-size: 16px;
    font-weight: 900;
    position:relative;
    top:-181px;
    color:#fff!important;
}

.mypadding-bottom{
    min-height:350px;
}


.noLgScr{
    display:none
}


.closeing{
    position: relative;
    right:-220px;
    padding-right: 20px;
    transition:ease 0.8s;
}
.opennav:focus {
    outline:none;
}
.closeing:focus {
    outline:none;
}
.sidebar-panel.activate{
    margin-left:0px;
    transition:ease 0.8s;
}
.sidebar-panel.unactivate{
    margin-left:-300px;
    transition:ease 0.8s;
}

.black-overlay.dark{
    background:#000;
    z-index:99;
    position:fixed;
    top:0;
    height:100%;
    width:100%;
    opacity:0.5;
}


.sub-head{
    text-align:center;
    width: 100%;
    font-weight:500;
    color:#fff;
    padding:40px 0 30px;
    text-transform:uppercase;
    font-size:2em;
    background:#000;
}
.sidebar-panel{
    /* background:#337ab7; */
    background: #fbd341;
    width: 300px;
    position: fixed;
    height: 100%;
    padding-top:20px;
    margin-left:-300px;
    padding-top: 40px;
    z-index: 999;
    overflow-y: scroll;
    overflow-x: hidden!important;
}





/* sidebar scrollbar styles */


.sidebar-panel::-webkit-scrollbar {
    width: 1em;
}
 
.sidebar-panel::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px  rgba(3, 28, 4, 0.3);
}
 
.sidebar-panel::-webkit-scrollbar-thumb {
  background-color: #4e9525;
  outline: 1px solid #4e9525;
}



/* sidebar scrollbar end */





.sidebar-panel ul{
    list-style:none;
    padding:0;
    margin:0;
    margin-top:20px;
}

.sidebar-panel ul li{
    background: #000;
    color: #fff;
    font-size: 1.4em;
    margin-bottom: 20px;
    border-radius: 10px;
    padding: 10px 0;
    border: 5px solid #4e9525;
    transition:ease 0.4s;
}

.sidebar-panel ul li:hover {
    background: #4e9525;
    color: #fbd341;
    box-shadow: 2px 3px 6px 2px #000;
    font-weight:bold;
    transition:ease 0.4s;
    letter-spacing: 5px;
}


.side-content{
    width:100%;
    max-width:991px;
    margin:0 auto;
}

.myFontIcon{
    font-size: 25px!important;
    padding: 0px 20px!important;
}

.myFontIcon:hover{
    color:#d1a916!important;
    transition: all .5s ease-in-out;
}   

.myFontBars{
    font-size: 25px!important;
}

.myFontBars:hover{
    color:#d1a916!important;
    transition: all .5s ease-in-out;
}

.closeFontIcon{
    color:#000!important;
}


.myBorder{
    border: solid 5px green!important;
    border-radius: 80px;
}

.myImg img{
    width: 200px;
    border-top-right-radius: 50px;
    border-top-left-radius: 50px;
    border-bottom-right-radius: 50px;
    border-bottom: solid 10px green!important;
}


.nanumGothic{

    font-family: 'Nanum Gothic', sans-serif!important;
    font-weight:lighter!important;
}

.myDetails{
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 50px!important;
    border: solid 3px #0a0909!important;
    font-weight: 600!important;
    color:#0a0909!important;
}

.myDetails:hover{
    background: 0!important;
    color:#0a0909!important;
}
/* Modal css settings */
.myModal{
    border-radius: 50px!important;
   
}

.myExit{
background: red!important;
color:#fff!important;
font-size:20px!important;
width:40px!important;
height: 40px!important;
border-radius: 50px!important;
position: relative;
left: 60px;
top: -20px;

}

.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: 1!important;
}

.myPaddingTB{
    padding: 20px 0px!important;
    padding-left: 15px!important;
}

.myLabel{
    font-weight:700!important;
}

.myControl{
    border: solid 3px #000!important;
}

.form-control:focus{
    box-shadow: 0!important;
    outline: 0!important;
    border-color:0!important;
}


.myOutline{
    outline:0!important;
    box-shadow: 0!important;
}

/* Modal css settings end */

.mySelect{
    background: #0a0909!important;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 50px!important;
    border: solid 3px #0a0909!important;
    font-weight: 600!important;
    color:#ffffff!important;
}

.mySelect:hover{
background: #161616!important;
transition: all ease-in-out .5s!important;
color:#f5f1f1!important;
}

.myDetails:hover{
    background: 0!important;
    color:#0a0909!important;
}


.userID{
    position: relative;
    top:-19px;
    font-size: 14px;
}

.myFarmText{
    font-size:15px;
    color:#000!important;
    padding: 50px 0px;
    font-size: 13px;
}

@media(max-width:369px){
    .closeing{
        /* position: relative;
        right:-350px;
        padding-right: 20px; */
        display: flex;
       justify-content: left;
        transition:ease 0.8s;
        
    }



    .myFontIcon{
        font-size: 14px!important;
        color:#fbd341!important;
        padding:0px 10px!important;


    }

    .myFontBars{
        color:#fbd341!important;
        font-size: 14px!important;


    }
}

@media (max-width:576px){
    .closeing{
        /* position: relative;
        right:-350px;
        padding-right: 20px; */
        display: flex;
       justify-content: left;
        transition:ease 0.8s;
        
    }

    .myNavlink{
        display: none!important;
    }

    .noLgScr{
        display: block;
    }

    .navbar{
        background:#1c2830!important;
    }

    .myFontIcon{

        color:#fbd341!important;
        padding:0px 10px!important;


    }

    

    .myFontBars{
        color:#fbd341!important;

    }

    .sidebar-panel.activate{
        width: 100%!important;
    }

    .myCardStyle{
        width:355px!important;
        display: flex!important;
        justify-content:center!important;
        margin: auto!important;
        margin-top:35px!important;
    }

    .myFarmSelect{
        width:355px!important;
        display: flex!important;
        justify-content:center!important;
        margin: auto!important;
        margin-top:35px!important;
    }
}

@media(max-width:751px){
    .myFontIcon{

        color:#fbd341!important;
        padding:0px 3px!important;
        


    }


    .myCardStyle{
        width:355px!important;
        display: flex!important;
        justify-content:center!important;
        margin: auto!important;
        margin-top:35px!important;
    }

    .myFarmSelect{
        width:355px!important;
        display: flex!important;
        justify-content:center!important;
        margin: auto!important;
        margin-top:35px!important;
    }


    
    .navbar-expand .navbar-nav .nav-link {
        padding-right: 0!important;
        padding-left: .5rem;
        font-size: 13px;
    }

    .myFontBars{
        color:#fbd341!important;

        

    }

}



</style>
@endsection
