@extends('layouts.admin')
@section('title')
@section('content')
<section class="ftco-section ftco-no-pt bg-white" style="background-color: #fbd341;">
    <div class="row justify-content-center">
        <div class="col-md-8  ">
            <form method="post" action="{{ url('makeinvestment') }}">
                @csrf
                <table class="table mt-5 table-dark px-3" style="border-radius: 10px;">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>ITEM</th>
                            <th>COST</th>
                            <th>TOTAL COST</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Land Clearing</td>
                            <td>Land Seeding</td>
                            <td>Land Weeding</td>
                            <td>Land Planting</td>
                            <td>Land Transport</td>
                      
                       
                        
                        </tr>  
                    </tbody>
                    
                </table>
            </form>

        </div>
    </div>
</section>
@endsection
