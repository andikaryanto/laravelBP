<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogicController extends Controller
{
    //
    public function index(){
        for($i = 1; $i <= 30; $i++){
            if($i % 4 == 0 && $i % 14 == 0){
                echo 'Unictive Media';
                echo '<br>';
            }  elseif ($i % 4 == 0){
                echo 'Unictive';
                echo '<br>';

            } else {
                echo $i;
                echo '<br>';
            }
        }
    }
}
