<?php

    function searchCategory($categories, $id) {
        if ($categories[0]['id'] > $id) {
            return "not found";
        }

        for ($i = 0; $i < count($categories); $i++) {

            echo $categories[$i]['id'];
            echo"\t";
            echo $id;
            echo "\n";

            if ($categories[$i]['id'] == $id) {
                return ($categories[$i]['title']);
            } else if (isset($categories[$i+1]) && $categories[$i+1]['id'] <= $id) {
                continue;
            } else if (isset($categories[$i]['children'])) {
                $result = (searchCategory($categories[$i]['children'], $id));
                if ($result != 'not found') {
                    return $result;
                }
            }
        }

        return "not found";
    }
