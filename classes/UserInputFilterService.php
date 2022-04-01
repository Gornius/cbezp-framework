<?php

class UserInputFilterService {
    const NAME_FILTER = 0;
    const URL_FILTER = 1;
    const EMAIL_FILTER = 2;
    
    public static function filter_user_input(string $string, $filter) {
        $filtered_string = $string;
        switch($filter) {
            case self::NAME_FILTER:
                $filtered_string = htmlspecialchars($string);
                break;
            case self::URL_FILTER:
                $filtered_string = filter_var($string, FILTER_SANITIZE_URL);
                break;
            case self::EMAIL_FILTER:
                $filtered_string = filter_var($string, FILTER_SANITIZE_EMAIL);
                break;
            default:
                $filtered_string = $filtered_string;
                break;
        }
        return $filtered_string;
    }
}