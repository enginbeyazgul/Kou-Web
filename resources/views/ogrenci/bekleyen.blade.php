@extends('layouts.ogrenciMain')
@section('container')
    <div class="containerr">
        <div class="columnn">
            <div class="row"><h2>Bekleyen Başvurularım</h2></div>
            @if($errors->any())
                <div class="error-info"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</div>
            @endif

            @if(count($durum->rows()) > 0)
                <div  class="row">
                    <div  style="justify-content: space-between;" class="basvuru">
                        <div><b>Tarih</b></div>
                        <div style="margin-right: 10px"><b>Başvuru Türü</b></div>
                        <div style="margin-right: 30px"><b>Durum</b></div>
                        <div style="margin-right: 10px"><b>İşlem</b></div>
                    </div>
                </div>
            @foreach($durum as $elem)
            <div class="row">

                <div class="basvuru">
                    <div>{{$elem->data()["date"]}}</div><div>{{$elem->data()["type"]}}</div><div>İmza Bekleniyor</div>
                    <div>
                        <form style="display: flex" id="imzaForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <input name="documentId" type="hidden" value="{{$elem->id()}}">
                            <input name="documentType" type="hidden" value="{{$elem->data()["type"]}}">
                            <label>
                                <input class="file-input" id="dilekce" name="dilekce" value="" type="file">
                                <span style="font-size: 22px;margin:5px; padding: 5px 10px" class="file-input-aa"><i class="far fa-file-pdf"></i></span>
                            </label>
                            <button type="submit" style="font-size: 18px;margin:5px; padding: 5px 9px" class="file-input-aa"><i class="far fa-upload"></i></button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
            @elseif( count($durum2->rows()) > 0)
                <div  class="row">
                    <div  style="justify-content: space-between;" class="basvuru">
                        <div><b>Tarih</b></div>
                        <div style="margin-right: 5px"><b>Başvuru Türü</b></div>
                        <div style="margin-right: 5px"><b>Durum</b></div>
                    </div>
                </div>
            @foreach($durum2 as $elem)
                <div class="row">

                    <div class="basvuru">
                        <div>{{$elem->data()["date"]}}</div><div>{{$elem->data()["type"]}}</div><div>İletildi</div>
{{--                        <div>--}}
{{--                            <span style="font-size: 18px;margin:5px; padding: 7px 12px" class="file-input-aa"><i class="fas fa-file-upload"></i></span>--}}
{{--                            <span style="font-size: 18px;margin:5px; padding: 7px 12px" id="indirdilekce" class="file-input-aa"><i class="fas fa-file-download"></i></span>--}}
{{--                        </div>--}}
                    </div>

                </div>
            @endforeach
            @else
                <div  class="row"><div style="justify-content: center" class="basvuru"><div >Başvuru Bulunamadı.</div></div></div>
            @endif
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        //turan
        // $("#imzaForm").on("submit",function (e){
        //     var data = new FormData();
        //     jQuery.each($('#dilekce')[0].files, function(i, file) {
        //         data.append('file-'+i, file);
        //     });
        //     $.ajax({
        //         type: "POST",
        //         url: "https://koubasvuru.herokuapp.com/signature-detection",
        //         data: {files:data},
        //         success: function (data) {
        //             console.log(data);
        //         }
        //     });
        //     e.preventDefault();
        // })

        $('input[type="file"]').change(function (){
            $(this).parent().children('span').css("font-size","14px");
            $(this).parent().children('span').html("Dosya Seçildi!");
        });
    </script>

@endsection
