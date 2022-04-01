<?php

class UserInputFilterService {
    const NAME_FILTER = 0;
    const URL_FILTER = 1;
    const EMAIL_FILTER = 2;
    
    public function filter_user_input(string $string, $filter) {
        $filtered_string = $string;
        switch($filter) {
            case self::NAME_FILTER:
                $filtered_string = "";
        }

        return $filtered_string;
    }
}