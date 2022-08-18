<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function play()
    {
        $count = DB::table('cards')->count();
        $randomNumber = mt_rand(1, $count);
        $otherNumber = [];

        $n = 1;
        while($n < 4) {
            $rdn = mt_rand(1, $count);
            if($rdn === $randomNumber || in_array($rdn, $otherNumber)) {
                continue;
            }
            array_push($otherNumber, $rdn);
            $n++;
        }

        $correct = DB::table('cards')
            ->where('id', '=', $randomNumber)
            ->get();

        $wrong = DB::table('cards')
            ->orWhere('id', '=', $otherNumber[0])
            ->orWhere('id', '=', $otherNumber[1])
            ->orWhere('id', '=', $otherNumber[2])
            ->get();

        $response = array(
            "correct" => $correct,
            "wrong" => $wrong
        );

        return json_encode($response);
    }
}
