<?php foreach (option('assets') as $key => $value) {

    if($type) {

        if($key == 'base') {
            $dir = $value;
        }
    
        if($key == $type) {
            foreach ($value as $file) {
                echo $type($dir.'/'.$type.'/'.$file);
            }
        }

    } else {
        return false;
    }
 
} ?>