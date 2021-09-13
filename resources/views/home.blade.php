@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <br />
          <h3>Carregar arquivo XML</h3>
          <br />
          <div id="msg"></div>
          <form id="nota" name="formNotas" enctype="multipart/form-data">

            <div class="form-row">
              <div class="form-group col-md-4">
                <input type="file" name="arquivoXML"
                     id="arquivoXML" value=""
                      required
                     accept="text/xml" oninput="checkExt()">
                <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
              </div>
              <div class="form-group col-md-6">
                <button style="width: 100px" type="submit"
                        id="btn-xml" disabled
                        class="btn btn-primary">
                    Enviar
                </button>
              </div>
            </div>
          </form>

          <hr />

          <table>
            <thead>
              <tr>
                <th></th>
                <th></th>
              </tr>
            </thead>
          </table>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

<script>

$(function(){
  $('form[name="formNotas"]').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: "/upload",
      type: "post",
      "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function(response){
        if(response.status == 0){
            $("#msg").html('<div class="alert alert-danger">'+response.msg+'</div>');
            $("#msg").slideDown('slow');
            retirarMsg();
        } else {
            $("#msg").html('<div class="alert alert-success">'+response.msg+'</div>');
            $("#msg").slideDown('slow');
            retirarMsg();
        }
        console.log(response.status);
      }
    });
    function retirarMsg(){
        setTimeout( function (){
            $("#msg").slideUp('slow', function() {});
        }, 1700);
    }
    setTimeout( function(){
        document.location.reload(true);
    }, 1900)
  });
});

  /*


  $.ajax({
    url: '/uploadFile',
    type: 'POST',
    data: formData,
    success: function(data){
      console.log(data);
    }
  })
  */

</script>
