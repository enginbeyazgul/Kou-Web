<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class OgrenciKayitEtController extends Controller
{
    //firebase firestore,storage,authentication
    protected $auth, $database, $storage;
    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount([
                "type"=> "service_account",
                "project_id"=> "yazilimlab-49317",
                "private_key_id"=> "d8dd430c107e005ef52943a9ab8e8fe86ba70539",
                "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDDTVdzwY4A91Db\naTmdN8JUZ8qiB5jeUQ8ukqgD8euiVht0+FlQU9iMP7oF9teK+lGv7jV6P+Q2PvlQ\niJOY969h9Ew9jdVaH3Lsdz4PCTFpn9AOEPyDwIs09gJJhcel8vbpjCQMLQYQeJi+\nksoARKC0svId2jK5f3lcww2VIdfLdyrF/5gexhAI9w6d35Vq4br9pq/wN3JxvePb\ncgs2iXVbTdkAO8uMnX3BPsH4xKMBrvHEGGe7hw5KG7RGccOoQTRqozI+vRpK01uG\nB0YnPQHDtPmPHc9wSi58cPzUKrhSOFPUw7m5ZR3t57gify6MXxnnfhjGkLkCBO9D\n1R0SUyUFAgMBAAECggEACZtblqhZ+56uxcg4iw0D3GKJo2xDvwXWPRh+Nsl26ZKa\nQaf4vryNHaMB28q/Ygj7rS+GxmdvqqJw4Z8CQadHY4ZgnLOGH+uFm++mqBcv7M3t\nbk+0GCgHwPhr9uFjh3x63FSmLkolrvg7rT4rvRUjIZhe1AyYa6sDVYaLu78BLjMt\njb/DPubhCj92gxzDaoyoMz15dt9T1bxncd9NIXCrQy7PYqUwZyHE7nGbgewCyq3K\nSehxAym/LJ/560JFEq9qkiYukXGeREFkxMmQpQho77UGvUGIIk9ajLULHbGRn8Wu\nrSWcOSkm7UzAydz3ok4GgUV1jgM3MDi7CQMyfuk6mQKBgQD6h4k2KR8OdwXMxIpH\nFc/ne0K6D3BaRi28D/06N3uyMKqsFMH9t+jK44mVkm1RyEF0EvGXkUWjb9qOlzjQ\nfSI1/YOLhsyBTdln0iZaiwEk/h/6TSTDj1L6tTjomcgFsRyd+NpHkT1E78trlqsJ\n9qs+qY8z8dU0dusZGPldBHODLQKBgQDHkRV7dQl1xwc2pWWLDnzVAaboQF1sD/0X\nrBv5vBEkHmwZSgIbyWBMznUxM6fh2w+/00en4C8+yjOarWaf1J+3zh+dOA3X/Z5o\n0aajaxMHJd7QQ48zZet7ATOG5eXWyyvqC51rqdLAjs1gr/rbFqcbNBbPv+zgFsVS\nw2NDh5ywOQKBgERyHSGn8G0yRWphU+oB4pA6k8tjhm2TeNFFiQiLuga/1xE2hp17\nzmUH70HnBGjwjjlZJ5oiPWVenNaSKBqF5X/cqEDJbjvxefEscAAStBhYOYJX6zBm\niuQl+MtLoGM1tTzPjUs6OgQIg4n8WvRY6QYwqwglDPvNdYOg2Bf6rFhtAoGBAMWo\nTwyeGKaMX/qhynb1/HHEVxnFVkJHe7dMgdDRknChqRNLF9eJllW8TppSvT6Xh3vI\nuTnucxzPjFjw0aoQH7ke8HT5Jcz9pz3OGCvXS1tTCOJhZ53Snm6P/AbqAMDDLlV6\n94nBA7owNf5DjkQcpZnt94IAZ45zPzD/0Hr8ABcRAoGAV+MoMyfX/zQL6Gjh3e9a\nk58CQRgyYD1JozSL8arUhH3RcZik1ETwge6sXP0aRPjCTpUtBLKRmtTH1/0hDqOg\nqMuMcbq8RGugrhyt2CqsyF+36lD5uAmoDQtM0DFHB+sl+oTD2ER6AJcsyve5rvoO\nRCM5JJu+lvt1NH7eKku7rew=\n-----END PRIVATE KEY-----\n",
                "client_email"=> "firebase-adminsdk-f89do@yazilimlab-49317.iam.gserviceaccount.com",
                "client_id"=> "114086295736770826836",
                "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
                "token_uri"=> "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-f89do%40yazilimlab-49317.iam.gserviceaccount.com"
            ])
            ->withDatabaseUri('https://yazilimlab-49317.firebaseapp.com');

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();
        $this->storage = $factory->createStorage();
    }
    public function ogrenciKayitEt(Request $request){

        //firebase storage img
        $image = $request->file('resim'); //image file from frontend
        $student   = app('firebase.firestore')->database()->collection('Users')->document($request->okulno.'_'.$request->ad);
        $firebase_storage_path = 'picture/';
        $name     = $student->id();
        $localfolder = public_path('firebase-temp-uploads') .'/';
        $extension = 'jpg';
        $file      = $name. '.' . $extension;
        if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder.$file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            unlink($localfolder . $file);
        }



        //firebase authentication
        $email = $request->mail;
        $pass = $request->sifre;
        try {
            $newUser = $this->auth->createUserWithEmailAndPassword($email, $pass);

            //firebase firestore
            $stuRef = app('firebase.firestore')->database()->collection('Users')->Document($newUser->uid);
            $stuRef->set([
                'imageURL' => 'url',
                'isStudent' => '1',
                'strAddress' => $request->adres,
                'strBirthday' => $request->dogumtarihi,
                'strDepartment' => $request->bolum,
                'strFaculty' => $request->fakulte,
                'strIdentity' => $request->tc,
                'strInfoClass' => $request->sınıf,
                'strNumber' => $request->okulno,
                'strLastName' => $request->soyad,
                'strName' => $request->ad,
                'strMail' => $request->mail,
                'strPassword' => $request->sifre,
                'strPhone' => $request->telno,
                'strUniversity' => 'Kocaeli Üniversitesi'
            ]);

            //dd($newUser);
        } catch (\Throwable $e) {
            switch ($e->getMessage()) {
                case 'The email address is already in use by another account.':
                    //dd("Geçerli bir mail adresi girin");
                    return redirect()->back()->withErrors(['msg' => 'Bu Mail Adresi Kullanılmakta.']);
                    break;
                case 'A password must be a string with at least 6 characters.':
                    //dd("Şifreniz 6 karakter olmalı");
                    return redirect()->back()->withErrors(['msg' => 'Şifreniz 6 Haneli Olmalı.']);
                    break;
                default:
                    //dd($e->getMessage());
                    return redirect()->back()->withErrors(['msg' => 'Bilinmeyen Hata.']);
                    break;
            }
        }

        //$data['title'] = "Kou-Web | Öğrenci Kayıt edildi";
        return redirect('ogrenci')->withErrors(['msg' => 'Öğrenci Kayıt Edildi']);
    }
}
