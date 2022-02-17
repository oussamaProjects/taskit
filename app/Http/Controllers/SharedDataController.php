<?php

namespace App\Http\Controllers;

use App\Subsidiary;
use Illuminate\Http\Request;

class SharedDataController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDepartements(Subsidiary $subsidiary )
    { 
        $depts = $subsidiary->departments()->get(); 
        return response()->json([
            'data' => array(
                'departments' => $depts,
            )
        ]);
    }

}
