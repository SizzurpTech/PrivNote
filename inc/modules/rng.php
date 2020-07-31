<?php
class Random {
    private static $seed = 0;

	public static function seed($s = 0) {
		self::$seed = abs(intval($s));
		self::num();
    }
    
	public static function num($min = 0, $max = PHP_INT_MAX) {
        self::$seed = floatval("0.".(((self::$seed * 7621) + 1)));
		return intval(floor((self::$seed * ($max - $min)) + $min));
    }
    
    public static function char() {
        $c = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return $c[self::num(0, strlen($c))];
    }
    
    public static function string($len) {
        $r = "";
        for($i = 0; $i < $len; $i++)
            $r .= self::char();
        return $r;
    }
}