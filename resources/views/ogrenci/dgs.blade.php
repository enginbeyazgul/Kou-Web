@extends('layouts.ogrenciMain')
@section('container')

    <div class="containerr">
        <div class="columnn">
            <div class="row"><h2>Dikey Geçiş Başvuru</h2></div>
            @if($errors->any())
                <div class="error-info"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</div>
            @endif
            <form id="dgsForm" action="{{route('ogrencimain/dgs')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row"><h4>Gerekli Belgeler</h4></div>
                <div class="row">
                    <label>
                        <input  class="file-input" id="transkript" name="transkript" value="{{ old('transkript') }}" type="file">
                        <span class="file-input-aa">Transkript Yükle!</span>
                    </label>
                </div>
                <div class="row">
                    <label>
                        <input  class="file-input" name="derslistesi" value="{{ old('derslistesi') }}" type="file">
                        <span class="file-input-aa">Ders Listesi Yükle!</span>
                    </label>
                </div>
                <div class="row"><input style="margin-bottom: 50px" value="Başvuru Yap" type="submit"></div>
            </form>
        </div>
    </div>
    <script>
        //turan
        // $("#dgsForm").on("submit",function (){
        //     var data = new FormData();
        //     jQuery.each(jQuery('#transkript')[0].files, function(i, file) {
        //         data.append('file-'+i, file);
        //     });
        //     $.ajax({
        //         type: "POST",
        //         url: "https://koubasvuru.herokuapp.com/signature-detection",
        //         data: {'files[]':data},
        //         success: function (data) {
        //             console.log(data);
        //         }
        //     });
        // })


    </script>
@endsection
