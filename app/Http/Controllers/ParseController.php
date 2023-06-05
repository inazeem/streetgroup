<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fileupload;
use App\Models\Person;
use File;
use Illuminate\Support\Str;

class ParseController extends Controller
{
    //

     public function parse($fid){

        $fileobj = Fileupload::find($fid)->pluck('name');

        $filename = $fileobj[0];

        $getfile = storage_path('/app/public/files/'.$filename);

        $content = explode(',',File::get($getfile));

        foreach($content as $i => $line) {

            if($i != 0){

                $homeowner  = explode(" ",$line);

                $needles = array('and','&');

                if(Str::contains($line,$needles)){

                    if($homeowner[1] == 'and' || $homeowner [1] == '&'){

                        $person1 = new Person;
                        $person1->title = $homeowner[0];
                        $person1->first_name = '';
                        $person1->initial = '';
                        $person1->last_name = $homeowner[3];
                        $person1->save();


                        $person2 = new Person;
                        $person2->title = $homeowner[2];
                        $person2->first_name = '';
                        $person2->initial = '';
                        $person2->last_name = $homeowner[3];
                        $person2->save();


                    }elseif( count($homeowner) == 7){

                        $person1 = new Person;
                        $person1->title = $homeowner[0];
                        $person1->first_name = $homeowner[1];
                        $person1->initial = '';
                        $person1->last_name = $homeowner[2];
                        $person1->save();


                        $person2 = new Person;
                        $person2->title = $homeowner[4];
                        $person2->first_name = $homeowner[5];
                        $person2->initial = '';
                        $person2->last_name = $homeowner[6];
                        $person2->save();

                    }elseif(Str::contains($line,'.')){

                        $initial_data = explode('.',$homeowner[1]); 

                        $person = new Person;
                        $person->title = $homeowner[0];
                        $person->first_name = '';
                        $person->initial = $initial_data[0];
                        $person->last_name = $homeowner[2];
                        $person->save();

                    }

                }else{

                    $person = new Person();
                    $person->title = $homeowner[0];
                    $person->first_name = $homeowner[1];
                    $person->initial = '';
                    $person->last_name = $homeowner[2];

                    $person->save();
                }
                
            }
        }

        $fileobj->is_parsed = 1;
        $fileobj->save();

    }
}
