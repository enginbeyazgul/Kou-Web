@extends('layouts.adminMain')
@section('ead')
    <div class="containerr">
        <div class="columnn">
            @if($errors->any())
                <div class="error-info"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</div>
            @endif
            <div class="row"><h2> Bekleyen Yaz Okulu Başvuruları</h2></div>
            @if(isset($durum->rows()[0]) ? $durum->rows()[0]->data()['state'] : "0" === "1")
            @foreach($durum as $elem)
                <div class="row">
                    <div class="basvuru">
                        <div>{{$elem->data()["date"]}}</div><div>{{$elem->data()["type"]}}</div>
                        <div>
                            @switch($elem->data()["state"])
                                @case(1)
                                Onay Bekleniyor
                                @break
                                @case(2)
                                Onaylandı
                                @break
                                @case(3)
                                Reddedildi
                                @break
                                @default
                                Default case...
                            @endswitch
                        </div>
                        <div>
                            <form style="display: flex" action="{{route('adminmain/islem')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="documentId" type="hidden" value="{{$elem->id()}}">
                                <input name="documentType" type="hidden" value="{{$elem->data()["type"]}}">
                                <button style="font-size: 18px;margin:3px; padding: 7px 10px"  name="action" class="file-input-aa" type="submit" value="onayla"><i class="fas fa-check-circle"></i></button>
                                <button style="background-color: #d0143a; font-size: 18px;margin:3px; padding: 7px 10px" name="action" class="file-input-aa" type="submit" value="reddet"><i class="fas fa-times-circle"></i></button>
                                <button style="background-color: #f1c12f; font-size: 18px;margin:3px; padding: 7px 10px" id="bekleyendilekcedrop" type="button" class="file-input-aa"><i class="fas fa-file-download"></i></button>
                        </div>
                    </div>
                    <div id="bekleyenpdfler" class="pdfler">
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir">Dilekçe</button>
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir2">Taban Liste</button>
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir3">Ders Listesi</button>
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir4">Transkript</button>
                    </div>
                    </form>
                </div>
            @endforeach
            @else
                <div  class="row"><div style="justify-content: center" class="basvuru"><div >Başvuru Bulunamadı.</div></div></div>
            @endif
            <div class="row"><h2> Onaylanan Yaz Okulu Başvuruları</h2></div>
            @if(isset($durum2->rows()[0]) ? $durum2->rows()[0]->data()['state'] : "0" === "2")
            @foreach($durum2 as $elem)
                <div class="row">
                    <div class="basvuru">
                        <div>{{$elem->data()["date"]}}</div><div>{{$elem->data()["type"]}}</div>
                        <div>
                            @switch($elem->data()["state"])
                                @case(1)
                                Onay Bekleniyor
                                @break
                                @case(2)
                                Onaylandı
                                @break
                                @case(3)
                                Reddedildi
                                @break
                                @default
                                Default case...
                            @endswitch
                        </div>
                        <div>
                            <form style="display: flex" action="{{route('adminmain/islem')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="documentId" type="hidden" value="{{$elem->id()}}">
                                <input name="documentType" type="hidden" value="{{$elem->data()["type"]}}">
                                <button style="font-size: 18px;margin:3px; padding: 7px 10px"  name="action" class="file-input-aa" type="submit" value="onayla"><i class="fas fa-check-circle"></i></button>
                                <button style="background-color: #d0143a; font-size: 18px;margin:3px; padding: 7px 10px" name="action" class="file-input-aa" type="submit" value="reddet"><i class="fas fa-times-circle"></i></button>
                                <button style="background-color: #f1c12f; font-size: 18px;margin:3px; padding: 7px 10px" id="onaylanandilekcedrop" class="file-input-aa" type="button"><i class="fas fa-file-download"></i></button>
                        </div>
                    </div>
                    <div id="onaylananpdfler" class="pdfler">
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir">Dilekçe</button>
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir2">Taban Liste</button>
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir3">Ders Listesi</button>
                        <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir4">Transkript</button>
                    </div>
                    </form>
                </div>
            @endforeach
            @else
                <div  class="row"><div style="justify-content: center" class="basvuru"><div >Başvuru Bulunamadı.</div></div></div>
            @endif
            <div class="row"><h2> Reddedilen Yaz Okulu Başvuruları</h2></div>
            @if(isset($durum3->rows()[0]) ? $durum3->rows()[0]->data()['state'] : "0" === "3")
            @foreach($durum3 as $elem)
                    <div class="row">
                        <div class="basvuru">
                            <div>{{$elem->data()["date"]}}</div><div>{{$elem->data()["type"]}}</div>
                            <div>
                                @switch($elem->data()["state"])
                                    @case(1)
                                    Onay Bekleniyor
                                    @break
                                    @case(2)
                                    Onaylandı
                                    @break
                                    @case(3)
                                    Reddedildi
                                    @break
                                    @default
                                    Default case...
                                @endswitch
                            </div>
                            <div>
                                <form style="display: flex" action="{{route('adminmain/islem')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input name="documentId" type="hidden" value="{{$elem->id()}}">
                                    <input name="documentType" type="hidden" value="{{$elem->data()["type"]}}">
                                    <button style="font-size: 18px;margin:3px; padding: 7px 10px"  name="action" class="file-input-aa" type="submit" value="onayla"><i class="fas fa-check-circle"></i></button>
                                    <button style="background-color: #d0143a; font-size: 18px;margin:3px; padding: 7px 10px" name="action" class="file-input-aa" type="submit" value="reddet"><i class="fas fa-times-circle"></i></button>
                                    <button style="background-color: #f1c12f; font-size: 18px;margin:3px; padding: 7px 10px" id="reddedilendilekcedrop" class="file-input-aa" type="button"><i class="fas fa-file-download"></i></button>
                            </div>
                        </div>
                        <div id="reddedilenpdfler" class="pdfler">
                            <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir">Dilekçe</button>
                            <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir2">Taban Liste</button>
                            <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir3">Ders Listesi</button>
                            <button style="" id="indirdilekcee" name="action" class="file-input-aa" type="submit" value="indir4">Transkript</button>
                        </div>
                        </form>
                    </div>
            @endforeach
            @else
                <div  class="row"><div style="justify-content: center" class="basvuru"><div >Başvuru Bulunamadı.</div></div></div>
            @endif
        </div>
    </div>
    <script>

        $('#bekleyendilekcedrop').click(function (){
            $('#bekleyenpdfler').slideToggle('medium', function() {
                if ($('#bekleyenpdfler').is(':visible'))
                    $('#bekleyenpdfler').css('display','flex');
            });
        });
        $('#onaylanandilekcedrop').click(function (){
            $('#onaylananpdfler').slideToggle('medium', function() {
                if ($('#onaylananpdfler').is(':visible'))
                    $('#onaylananpdfler').css('display','flex');
            });
        });
        $('#reddedilendilekcedrop').click(function (){
            $('#reddedilenpdfler').slideToggle('medium', function() {
                if ($('#reddedilenpdfler').is(':visible'))
                    $('#reddedilenpdfler').css('display','flex');
            });
        });
    </script>
@endsection
