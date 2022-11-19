@extends('layout')
@section('content')
               <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Liên hệ với chúng tôi</h2>

                        <div class="row">
                            <div class="col-md-12">
                               @foreach($contact as $key => $cont)
                               {!!$cont ->info_contact!!}
                                {!!$cont ->info_fanpage!!}
                                       

                                
                            </div>
                            <div class="col-md-12">
                                <h4>Map</h4>
                                {!!$cont ->info_map!!}
                                    
                            </div>

                            <div class="col-md-12">
                                <h4>Mã QR</h4>
                                {{QrCode::size(100)->generate('techgear.com/techgear')}}
                                    
                            </div>
                        </div>
                        @endforeach
                </div><!--features_items-->

@endsection

