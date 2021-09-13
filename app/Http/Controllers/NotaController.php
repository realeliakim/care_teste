<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Nota;

class NotaController extends Controller {


  public function uploadFile(Request $request){

    if($request->hasFile('arquivoXML')){

      $fileName = $request->file('arquivoXML')->getClientOriginalName();
      $file_store = $request->file('arquivoXML')->storeAs('public/files', $fileName);
      $path = $_SERVER['DOCUMENT_ROOT'].'/storage/files/'.$fileName;
      $xml = simplexml_load_file($path);
      $protocol = 0;
      $cnpj = 0;
      $nota = '';
      $data_nota = '';
      $nome_destino = '';
      $email_destino = '';
      $cpf_destino = '';
      $rua_destino = '';
      $num_destino = '';
      $bairro_destino = '';
      $municipio_destino = '';
      $uf_destino = '';
      $cep_destino = '';
      foreach($xml as $key => $item){
        if(isset($item->infNFe)){
          $cnpj = $item->infNFe->emit->CNPJ;
          $nota = $item->infNFe->ide->nNF;
          $data_nota = $item->infNFe->ide->dhEmi;
          $nome_destino = $item->infNFe->dest->xNome;
          $email_destino = $item->infNFe->dest->email;
          $cpf_destino = $item->infNFe->dest->CNPJ;
          $rua_destino = $item->infNFe->dest->enderDest->xLgr;
          $num_destino = $item->infNFe->dest->enderDest->nro;
          $bairro_destino = $item->infNFe->dest->enderDest->xBairro;
          $municipio_destino = $item->infNFe->dest->enderDest->xMun;
          $uf_destino = $item->infNFe->dest->enderDest->UF;
          $cep_destino = $item->infNFe->dest->enderDest->CEP;
        }
        if(isset($item->infProt)){
          $protocol = $item->infProt->nProt;
        }
      }

      if($protocol === 0){
        $msg = 'Nota não possui protocolo de autorização.';
        if(file_exists( $path )){
          unlink($path);
        }
        return response()->json([
            'msg' => $msg,
            'status' => '0',
        ]);
      }

      if($cnpj != '09066241000884'){
        $msg = 'CNPJ ' . $cnpj . ' não é permitido.';
        if(file_exists( $path )){
          unlink($path);
        }
        return response()->json([
            'msg' => $msg,
            'status' => '0',
        ]);
      }

      $table = new Nota;
      $table->nota = $nota;
      $table->data_nota = $data_nota;
      $table->nome_destino = $nome_destino;
      $table->cpf_destino = $cpf_destino;
      $table->email_destino = $email_destino;
      $table->rua_destino = $rua_destino;
      $table->num_destino = $num_destino;
      $table->bairro_destino = $bairro_destino;
      $table->municipio_destino = $municipio_destino;
      $table->uf_destino = $uf_destino;
      $table->cep_destino = $cep_destino;
      $table->user_id = auth()->user()->id;
      if($table->save()){
        return response()->json([
            'msg' => 'Nota Fiscal salva com sucesso',
            'status' => '1',
        ]);
      } else {
        return response()->json([
            'msg' => 'Erro ao salvar Nota Fiscal',
            'status' => '0',
        ]);
      }
    }
  }
}
