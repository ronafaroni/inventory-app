<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use DNS1D;
use DNS2D;
use App\Models\StokToko;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector; // Atau USB/Serial jika menggunakan kabel
use Mike42\Escpos\PrintConnectors\BluetoothPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Exception;

class PrintController extends Controller
{
    // YourController.php


    public function getReceiptData(Request $request)
    {
        $kodeToko = $request->get('kode_toko');
        $receiptData = Toko::where('kode_toko', $kodeToko)->first();

        // Pastikan data tidak null
        if (!$receiptData) {
            return response()->json(['error' => 'Data not found'], 404);
        }


        // Membuat teks struk
        $receiptText = str_pad(strtoupper($receiptData->nama_toko), 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("Kode: " . $receiptData->kode_toko, 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_repeat("-", 31) . "\n"; // Menambahkan garis horizontal
        $receiptText .= str_pad("Pemilik Toko: " . $receiptData->pemilik_toko, 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("No Telepon: " . $receiptData->no_telp, 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("Alamat: " . $receiptData->alamat, 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("Kode Sales: " . $receiptData->kode_sales, 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("Nama Sales: " . $receiptData->sales->nama_sales, 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("Tgl. Gabung: " . $receiptData->created_at->format('d-m-Y'), 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_repeat("-", 31) . "\n"; // Menambahkan garis horizontal

        // Menambahkan teks terima kasih di tengah
        $receiptText .= str_pad("Terima Kasih atas", 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("kerjasama dan dukungan anda!", 31, " ", STR_PAD_BOTH) . "\n";
        $receiptText .= str_pad("Tgl. Cetak: " . date('d-m-Y H:i:s'), 31, " ", STR_PAD_BOTH) . "\n\n\n\n";

        $barcodeBase64 = DNS1D::getBarcodePNG($receiptData->id_toko, 'C39');

        return response()->json([
            'receiptText' => $receiptText,
            'barcode' => 'data:image/png;base64,' . $barcodeBase64,
        ]);
    }


    // INI ADALAH OPSI PERTAMA JIKA INGIN MENDERECT PRINT
    // public function getReceiptData(Request $request)
    // {
    //     $kodeToko = $request->get('kode_toko');
    //     $receiptData = Toko::where('kode_toko', $kodeToko)->first();

    //     // Pastikan data tidak null
    //     if (!$receiptData) {
    //         return response()->json(['error' => 'Data not found'], 404);
    //     }

    //     // Render view menjadi teks
    //     $receiptText = view('app.toko.app-cetak-toko', compact('receiptData'))->render();

    //     return response()->json(['receiptText' => $receiptText]);
    // }

}
