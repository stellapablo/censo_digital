<?php

namespace App\Http\Controllers;

use App\Biometria;
use File;
use Illuminate\Http\Request;

class DropzoneController extends Controller{

    public function upload(Request $request){
        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    public function fetch(Request $request){

        $images = Biometria::where('empleado_id','=',$request->id)->get();

        $output = '<div class="row">';
        foreach($images as $image)
        {
            $output .= '
            <div class="col-md-2" style="margin: 1em;">
                <img src="'.asset('images/' . $image->imagen).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
            </div>';
        }
        $output .= '</div>';
        echo $output;
    }

    public function delete(Request $request){

        if($request->get('name')) {
            File::delete(public_path('images/' . $request->get('name')));
        }
    }
}
