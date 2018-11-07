<?php

namespace App\Http\Controllers;

use App\Colors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class miscController extends Controller
{


    public function index() {
        return view('welcome');
    }


    public function foobar() {

        $md5 = md5(time());

        $color1 = substr($md5, 0, 6);
        $color2 = substr($md5, -6, 6);

        $arr = str_split($md5);

        $total = 0;

        foreach ($arr as $digit) {

            if (preg_match('/\d/', $digit)) {
                $total += $digit;
            }

        }

        $currentColors = Colors::where('color1', $color1)
                    ->get();

        if (!count($currentColors )) {

            $color2 = $this->callAPI($color1);

            //$colors = new Colors;
                //$colors->color1 = $color1;
                //$colors->color2 = $color2;
            //$colors->save();

        } else  {

            $color2 = $currentColors[0]->color2;
        }

        $totalBlack = Colors::where('color2', '000000')
            ->count();

        $totalWhite = Colors::where('color2', 'ffffff')
            ->count();

        return view('foobar', compact('md5', 'color1', 'color2', 'total', 'totalWhite', 'totalBlack'));

    }


    public function fees() {
        $arr = array();
        $idx = 0;

        for ($x = .1; $x < 11; $x+=.1) {

            $gross = $x;
            $arr[$idx]['gross'] = number_format(round($gross, 2), 2);

            $ebayFee = $x * .1;
            $arr[$idx]['ebayFee'] = number_format(round($ebayFee, 2), 2);

            $paypalFee = ($x * .029) + .3;
            $arr[$idx]['paypalFee'] =  number_format(round($paypalFee,2), 2);

            $postage = .5;
            $arr[$idx]['postage'] =  number_format($postage, 2);

            $net = (($gross - $ebayFee) - $paypalFee) - $postage;
            $arr[$idx]['net'] = round($net, 2);

            $cost = (1 - ($net / $gross)) * 100;
            $arr[$idx]['cost'] = number_format($cost, 1);

            $idx++;
        }

        return view('fees', compact('arr'));
    }


    private function callAPI($color) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://www.thecolorapi.com/id?hex=" . $color,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $json = json_decode($response);

        $contrastColor = strtolower(substr($json->contrast->value, 1, 6));

        return $contrastColor;
    }



    public function editor() {

        return view('test-edit-page');

    }



    public function process_edit(Request $request) {

        DB::table('common_log')
            ->insert(['notes' => $request->notes,
                'entry' => $request->entry
            ]);

        $response = array(
            'status' => 'success'
        );

        return response()->json($response);

    }


}
