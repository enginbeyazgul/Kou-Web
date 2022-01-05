<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminIslemController extends Controller
{
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
    public function duzelt2($veri){
        switch ($veri) {
            case "Dgs":
                return "dgs";
                break;
            case "Çap":
                return "cap";
                break;
            case "Yaz Okulu":
                return "yazokulu";
                break;
            case "Yatay Geçiş":
                return "yataygecis";
                break;
            case "İntibak":
                return "intibak";
                break;
        }
    }
    public function islem(Request $request){
        switch ($request->input('action')) {
            case 'onayla':
                //firebase firestore
                $updateDocRef = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId);
                $updateDocRef->update([
                    ['path' => 'state','value' => '2'],
                ]);
                return redirect('adminmain/'.$this->duzelt2($request->documentType))->withErrors('Başvuru Onaylandı');
                break;

            case 'reddet':
                //firebase firestore
                $updateDocRef = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId);
                $updateDocRef->update([
                    ['path' => 'state','value' => '3'],
                ]);
                return redirect('adminmain/'.$this->duzelt2($request->documentType))->withErrors('Başvuru Reddedildi');
                break;

            case 'indir':
                $resource = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId)->snapshot()->data();
                $petitionLink = $resource['petitionPath'];
                $link = app('firebase.storage')->getBucket()->object($petitionLink);
                if ($link->exists()) {
                    $link1 = $link->signedUrl(new \DateTime('tomorrow'));
                } else {
                    $link1 = "aaa";
                }
                return redirect($link1);
                break;

            case 'indir2':
                $resource = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId)->snapshot()->data();
                $petitionLink = $resource['subScorePath'];
                $link = app('firebase.storage')->getBucket()->object($petitionLink);
                if ($link->exists()) {
                    $link1 = $link->signedUrl(new \DateTime('tomorrow'));
                } else {
                    $link1 = "aaa";
                }
                return redirect($link1);
                break;

            case 'indir3':
                $resource = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId)->snapshot()->data();
                $petitionLink = $resource['lessonPath'];
                $link = app('firebase.storage')->getBucket()->object($petitionLink);
                if ($link->exists()) {
                    $link1 = $link->signedUrl(new \DateTime('tomorrow'));
                } else {
                    $link1 = "aaa";
                }
                return redirect($link1);
                break;

            case 'indir4':
                $resource = app('firebase.firestore')->database()->collection('Resources')->document($request->documentId)->snapshot()->data();
                $petitionLink = $resource['transcriptPath'];
                $link = app('firebase.storage')->getBucket()->object($petitionLink);
                if ($link->exists()) {
                    $link1 = $link->signedUrl(new \DateTime('tomorrow'));
                } else {
                    $link1 = "aaa";
                }
                return redirect($link1);
                break;

        }
    }
}
