@extends('layouts.ogrenciMain')
@section('container')

    <div class="containerr">
        <div class="columnn">
            <div class="row"><h2>Onaylanan Başvurularım</h2></div>
            @if($errors->any())
                <div class="error-info"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</div>
            @endif
            <div  class="row">
                <div  style="justify-content: space-between;" class="basvuru">
                    <div><b>Tarih</b></div>
                    <div><b>Başvuru Türü</b></div>
                    <div style="margin-right: 25px"><b>Durum</b></div>
                    <div style="margin-right: 10px"><b>İşlem</b></div>
                </div>
            </div>
            @if(count($durum->rows()) > 0)
            @foreach($durum as $elem)
                <div class="row">

                    <div class="basvuru">
                        <div>{{$elem->data()["date"]}}</div><div>{{$elem->data()["type"]}}</div><div>Onaylandı</div>
                        <div>
{{--                            <span style="font-size: 18px;margin:5px; padding: 7px 12px" class="file-input-aa"><i class="fas fa-file-upload"></i></span>--}}
{{--                            <span style="font-size: 18px;margin:5px; padding: 7px 12px" class="file-input-aa"><i class="fas fa-file-download"></i></span>--}}
                        </div>
                    </div>

                </div>
            @endforeach
            @else
                <div  class="row"><div style="justify-content: center" class="basvuru"><div >Başvuru Bulunamadı.</div></div></div>
            @endif
        </div>
    </div>
@endsection
