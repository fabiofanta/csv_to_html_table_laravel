<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file = public_path('images/csvtest.txt');
        $filez = fopen($file,"r");
        $array = [];
        $x = 0;
        while(!feof($filez))
          {
          $array[$x] = fgetcsv($filez);
          $x++;
          }
        fclose($filez);
        return response()->json(['success' => $array]);
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
        $file = $request->file('file');
        $fileName = 'csvtest'. '.' . $file->extension();
        $file->move(public_path("images"),$fileName);
        // $filer = public_path('images/csvtest.txt');
        // $filez = fopen($file,"r");
        // $array = [];
        // $x = 0;
        // while(!feof($filez))
        //   {
        //   $array[$x] = fgetcsv($filez);
        //   $x++;
        //   }
        // fclose($filez);

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
}
