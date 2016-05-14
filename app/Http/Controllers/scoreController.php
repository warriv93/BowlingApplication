<?php

namespace App\Http\Controllers;


use Request;
use Response;
use App\bowling;
use App\scores;
use DB;

class scoreController extends Controller
{
    //
    public function initiate() {
        //return interface
        return view('bowling');
    }
    /**
    * handle data posted by ajax request
    */
    public function resetStats(){
        DB::table('scores')->truncate();
    }

    public function postStats(){
        if ( Request::ajax() ) {
            //add input to score array
            $input = Request::all();
            $newscore = $input['value'];
            $bonus=0;
            if (scores::find(1)) {
                // reset counter
                // DB::table('scores')
                //     ->where('id', 1)
                //     ->update(['counter' => 1,'totalScore' => 0,'storedScore' => 0]);

                $oldScore = scores::find(1)['storedScore'];
                DB::table('scores')->increment('counter', 1);
                $totalScore = scores::find(1)['totalScore']+$newscore;
                $counter = scores::find(1)['counter'];
                //update totalscore with new score
                DB::table('scores')->increment('totalScore', $newscore);
                $printNewScore = $newscore;


                $tempScore = $oldScore+$newscore;


                // if $counter is even
                if ($counter % 2 == 0 && $tempScore>=10) {
                    $printNewScore = "/";
                    $newscore=0;
                    $bonus=10;
                //if $counter is uneven
                }else if($counter % 2 != 0 && $tempScore>=10){
                    $printNewScore = "x";
                    DB::table('scores')->increment('counter', 1);
                    $newscore=0;
                    $bonus=10;
                } else if($newscore==0){
                    $printNewScore="-";
                    $newscore=0;
                }

                if($tempScore>=10){
                    $newscore=0;
                }
                //update oldscore with newscore
                DB::table('scores')
                    ->where('id', 1)
                    ->update(['storedScore' => $newscore]);
                //update totalScore with bonuses
                DB::table('scores')->increment('totalScore', $bonus);


                //if no database rows, insert new one
            }else {
                $scoreModel = new scores();
                $scoreModel->storedScore = $newscore;
                $scoreModel->totalScore = $newscore;
                $scoreModel->counter = 0;
                $scoreModel->save();
                return $this->postStats();
            }
            //save stats to array and return as json obj
            $arr = array('newscore' => $printNewScore, 'oldscore' => $oldScore, 'totalscore' => $totalScore, 'counter' => $counter);
            //  "newscore: ".$printNewScore."Oldscore:  ".$oldScore. " totalscore: ".$totalScore. " counter: ".$counter
            return $arr;
        }
    }

    public function clearTable() {
        echo test;
        //clear content of table
        //TODO: if table exedes 10 ?
        //DB::statement('TRUNCATE TABLE scores');
    }
}
