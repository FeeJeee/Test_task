<?php

    function tagsCheck ($tags) {
        $open_tags = array();

        foreach ($tags as $tag) {
            if (strpos( $tag, '/' ) == false){
                $open_tags[] = $tag;
            } else {
                $close_tag = str_replace('/','', $tag) ;
                $open_tag = array_pop($open_tags);
                if ($open_tag != $close_tag) {
                    return 'false';
                }
            }
        }

        if (empty($open_tags)) {
            return 'true';
        } else {
            return 'false';
        }
    }
