<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        return view('products');
    }

    public function load_data(Request $request) {
        if($request->ajax()) {
            if(($request->id) > 0) {
                $data = Product::where('id', '<', $request->id)->orderBy('id', 'DESC')->limit(3)->get();
            } else {
                $data = Product::orderBy('id', 'DESC')->limit(3)->get();
            }
            $output = '';
            $last_id = '';
            if(!$data->isEmpty()) {
                foreach($data as $row) {
                    $output .= '<div class="card">
                    <img src="'.$row->image.'" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">'.$row->title.'</h5>
                    </div>
                </div>';
                $last_id = $row->id;
         
                }
                $output .= '<div id="load_more">
                <button type="button" class="btn btn-dark btn-block" data-id="'.$last_id.'" id="load_more_button">Load More</button>
                </div>';
            } else {
                $output .= '
                <div id="load_more">
                     <button type="button" class="btn btn-danger">No Data Found</button>
                </div>';
            }
            echo $output;
        }
    }   
}
