<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasvuruDurumController extends Controller
{

    public function bekleyen(){
        $data['title'] = "Kou-Web | Bekleyen Başvurularım";
        $resources = app('firebase.firestore')->database()->collection('Resources');
        $query = $resources->where('userUid', '=', Session::get('studentId'))->where('state', '=', '0');
        $query2 = $resources->where('userUid', '=', Session::get('studentId'))->where('state', '=', '1');
        $documents = $query->documents();
        $documents2 = $query2->documents();
        $data['durum'] = $documents;
        $data['durum2'] = $documents2;
        return view('ogrenci.bekleyen',$data);
    }
    public function duzelt($veri){
        switch ($veri) {
            case "Dgs":
                return "DGS";
                break;
            case "Çap":
                return "CAP";
                break;
            case "Yaz Okulu":
                return "YazOkul";
                break;
            case "Yatay Geçiş":
                return "YatayGecis";
                break;
            case "İntibak":
                return "Intibak";
                break;
        }
    }
    public function dilekceYukle(Request $request){
        //firebase storage ders listesi
        $transcript = $request->file('dilekce'); //image file from frontend
        $student   = app('firebase.firestore')->database()->collection('Pdf')->document(Session::get('studentId'));
        $firebase_storage_path = $this->duzelt($request->documentType).'/pdf/Petition/';
        $name     = $student->id();
        $localfolder = public_path('firebase-temp-uploads') .'/';
        $extension = $transcript->getClientOriginalExtension();
        $file      = $name. '.' . $extension;
        if ($transcript->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            unlink($localfolder . $file);
        }

        //firebase firestore
        $updateDocRef = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId);
        $yol = $this->duzelt($request->documentType).'/pdf/Petition/'.Session::get('studentId').'.pdf';
        $updateDocRef->update([
            ['path' => 'date','value' => date('d-m-Y')],
            ['path' => 'state','value' => '1'],
            ['path' => 'petitionPath','value' => $yol],
        ]);

        return redirect('ogrencimain/bekleyen')->withErrors(['msg' => 'İmzalı Dilekçe Yüklendi']);
    }
    public function onaylanan(){
        $data['title'] = "Kou-Web | Onaylanan Başvurularım";
        $resources = app('firebase.firestore')->database()->collection('Resources');
        $query = $resources->where('userUid', '=', Session::get('studentId'))->where('state', '=', '2');
        $documents = $query->documents();
        $data['durum'] = $documents;
        return view('ogrenci.onaylanan',$data);
    }
    public function reddedilen(){
        $data['title'] = "Kou-Web | Reddedilen Başvurularım";
        $resources = app('firebase.firestore')->database()->collection('Resources');
        $query = $resources->where('userUid', '=', Session::get('studentId'))->where('state', '=', '3');
        $documents = $query->documents();
        $data['durum'] = $documents;
        return view('ogrenci.reddedilen',$data);
    }
}
