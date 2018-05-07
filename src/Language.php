<?php

namespace Pinfort\LaravelLangSelector\Language;

use Request;
use Config;
use Session;

/**
* 言語の管理を行います
*/
class Language
{
    public static function select($lang){
        return Session::put('language', $lang);
    }

    public static function get()
    {
        return Session::get('language', null);
    }

    public static function getLangShouldSet($lang = null)
    {
        // 同じ言語の別表記を用いられたときこのアプリケーション内で採用している方に合わせます
        // en-US -> en, ja-JP -> ja など
        $same_lang_list = Config::get('language.language_same');
        if (array_key_exists($lang, $same_lang_list)) {
            $lang = $same_lang_list[$lang];
        }

        $available_languages = Config::get('language.available_languages');

        // check GET lang paramator.
        if (!is_null($lang) and in_array($lang, $available_languages)) {
            return $lang;
        }

        // if language already selected, return it
        if (!is_null(self::get()) and in_array(self::get(), $available_languages)) {
            return self::get();
        }

        // check accept-language header
        $lang_arr = self::getHeader();
        if (!is_null($lang_arr)) {
            foreach ($lang_arr as $lang) {
                if (in_array($lang, $available_languages)) {
                    return $lang;
                }
            }
        }

        // return default
        return Config::get('app.locale');
    }

    public static function getHeader()
    {
        $languages = Request::header('Accept-Language', null);

        if (is_null($languages)) {
            return null;
        }

        // convert to language list
        $language_list = explode(',', $languages);
        $parsed_language_list = [];
        foreach ($language_list as $language) {
            $language_info = explode(';', $language);
            $language_name = $language_info[0];
            $parsed_info = self::parseInfo($language_info);
            if (array_key_exists('q', $parsed_info)) {
                $language_priority = $parsed_info['q'];
            } else {
                $language_priority = 1;
            }
            if (array_key_exists($language_priority, $parsed_language_list)) {
                $parsed_language_list[self::getAvailablePriority($parsed_language_list, $language_priority)] = $language_name;
            } else {
                $parsed_language_list[$language_priority] = $language_name;
            }
        }
        krsort($parsed_language_list);
        return $parsed_language_list;
    }

    public static function getAvailablePriority($arr, $priority)
    {
        while (array_key_exists($priority, $arr)) {
            $priority = $priority - 0.01;
        }

        return $priority;
    }

    public static function parseInfo($language_info)
    {
        $return = [];
        foreach ($language_info as $info) {
            /*
             * $infomation ex. ['q' '0.8']
            **/
            $infomation = explode('=', $info);
            if (count($infomation) === 2) {
                $return[$infomation[0]] = $infomation[1];
            } else {
                continue;
            }
        }
        return $return;
    }

    public static function smartSelect($lang = null)
    {
        $lang = self::getLangShouldSet($lang);
        self::select($lang);
        return $lang;
    }
}
