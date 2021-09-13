

function checkExt(){

  var el = document.getElementById('arquivoXML').value;
  var btn = document.getElementById('btn-xml');
  var file = el.split('.');

  if( file.length < 2 ){
    alert('Por favor, insira um arquivo XML')
    btn.disabled=true;
  }

  if(file[1] != ''){
    var xml = file[1].toLowerCase();
    if( xml !== 'xml' ) {
      alert('Por favor, insira um arquivo XML');
      btn.disabled=true;
    }
  }


  btn.disabled=false;

}
