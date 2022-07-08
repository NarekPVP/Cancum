<?php


namespace app\helpers;


use http\Exception\InvalidArgumentException;

class Str extends Helper{

    public static function find($char, $str){
        return preg_match("/{$char}/i", $str);
    }

    public static function ru2lat($str){
            $tr = array(
                "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
                "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i",
                "Й"=>"ih", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n",
                "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
                "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch",
                "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
                "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b",
                "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
                "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k",
                "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
                "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f",
                "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
                "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu",
                "я"=>"ya", " "=>"-", "."=>"", ","=>"", "/"=>"-",
                ":"=>"", ";"=>"","—"=>"", "–"=>"-"
            );

            return strtr($str,$tr);
        }

        public static function isRussian($text) {
            return preg_match('/[А-Яа-яЁё]/u', $text);
        }

        public static function slug($text, $replace_subject = "-"){
            if($text === "" || gettype($text) == "numeric"){
                throw new \InvalidArgumentException("Argument must have string type");
            }
            $text = strtolower($text);
            $text = str_replace(' ', $replace_subject, $text);
            if(self::isRussian($text)){
                $text = self::ru2lat($text);
            }

            return $text;
        }

        public static function startsWith($text, $start_word, $delimiter = " "){
            $text = explode($delimiter, $text);

            function check($txt, $sword){
                if($txt == $sword){
                    return true;
                }else{
                    return false;
                }
            }

            if(count($text) > 1){
                if(check($text[0], $start_word)){
                    return true;
                }
            }else{
                $text = implode($delimiter, $text);
                if(check($text, $start_word)){
                    return true;
                }
            }

            return false;
        }

        public static function endsWith($text, $word, $delimiter = " "){
            $text = explode($delimiter, $text);

            function check($txt, $eword){
                if($txt == $eword){
                    return true;
                }else{
                    return false;
                }
            }

            if(count($text) > 1){
                if(check($text[count($text) - 1], $word)){
                    return true;
                }
            }else{
                $text = implode($delimiter, $text);
                if(check($text, $word)){
                    return true;
                }
            }

            return false;
        }

}