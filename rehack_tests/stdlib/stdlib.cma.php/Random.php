<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Random.php
 */

namespace Rehack;

final class Random {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Array_ = Array_::get();
    $Digest = Digest::get();
    $Int32 = Int32::get();
    $Int64 = Int64::get();
    $Nativeint = Nativeint::get();
    $Pervasives = Pervasives::get();
    Random::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Random;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $runtime = $joo_global_object->jsoo_runtime;
    $unsigned_right_shift_32 = $runtime->unsigned_right_shift_32;
    $left_shift_32 = $runtime->left_shift_32;
    $caml_arity_test = $runtime->caml_arity_test;
    $ArrayLiteral = $runtime->ArrayLiteral;
    $caml_check_bound = $runtime->caml_check_bound;
    $caml_greaterthan = $runtime->caml_greaterthan;
    $caml_int64_of_int32 = $runtime->caml_int64_of_int32;
    $caml_int64_or = $runtime->caml_int64_or;
    $caml_int64_shift_left = $runtime->caml_int64_shift_left;
    $caml_int64_sub = $runtime->caml_int64_sub;
    $caml_lessequal = $runtime->caml_lessequal;
    $caml_mod = $runtime->caml_mod;
    $caml_new_string = $runtime->caml_new_string;
    $caml_string_get = $runtime->caml_string_get;
    $caml_sys_random_seed = $runtime->caml_sys_random_seed;
    $caml_call1 = function($f, $a0) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 1
        ? $f($a0)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0)));
    };
    $caml_call2 = function($f, $a0, $a1) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 2
        ? $f($a0, $a1)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0, $a1)));
    };
    $caml_call5 = function($f, $a0, $a1, $a2, $a3, $a4) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 5
        ? $f($a0, $a1, $a2, $a3, $a4)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0, $a1, $a2, $a3, $a4)));
    };
    $global_data = $runtime->caml_get_global_data();
    $cst_Random_int64 = $caml_new_string("Random.int64");
    $cst_Random_int32 = $caml_new_string("Random.int32");
    $cst_Random_int = $caml_new_string("Random.int");
    $cst_x = $caml_new_string("x");
    $Int32 = $global_data->Int32;
    $Int64 = $global_data->Int64;
    $Pervasives = $global_data->Pervasives;
    $Digest = $global_data->Digest;
    $Array = $global_data->Array;
    $Nativeint = $global_data->Nativeint;
    $pX = R(255, 1, 0, 0);
    $pY = R(255, 0, 0, 0);
    $pZ = R(
      0,
      987910699,
      495797812,
      364182224,
      414272206,
      318284740,
      990407751,
      383018966,
      270373319,
      840823159,
      24560019,
      536292337,
      512266505,
      189156120,
      730249596,
      143776328,
      51606627,
      140166561,
      366354223,
      1003410265,
      700563762,
      981890670,
      913149062,
      526082594,
      1021425055,
      784300257,
      667753350,
      630144451,
      949649812,
      48546892,
      415514493,
      258888527,
      511570777,
      89983870,
      283659902,
      308386020,
      242688715,
      482270760,
      865188196,
      1027664170,
      207196989,
      193777847,
      619708188,
      671350186,
      149669678,
      257044018,
      87658204,
      558145612,
      183450813,
      28133145,
      901332182,
      710253903,
      510646120,
      652377910,
      409934019,
      801085050
    );
    $new_state = function($param) use ($runtime) {
      return V(0, $runtime->caml_make_vect(55, 0), 0);
    };
    $assign = function($st1, $st2) use ($Array,$caml_call5) {
      $caml_call5($Array[10], $st2[1], 0, $st1[1], 0, 55);
      $st1[2] = $st2[2];
      return 0;
    };
    $full_init = function($s, $seed) use ($Digest,$Pervasives,$caml_call1,$caml_call2,$caml_check_bound,$caml_mod,$caml_string_get,$cst_x,$left_shift_32) {
      $combine = function($accu, $x) use ($Digest,$Pervasives,$caml_call1,$caml_call2) {
        $qc = $caml_call1($Pervasives[21], $x);
        $qd = $caml_call2($Pervasives[16], $accu, $qc);
        return $caml_call1($Digest[3], $qd);
      };
      $extract = function($d) use ($caml_string_get,$left_shift_32) {
        $p_ = $left_shift_32($caml_string_get($d, 3), 24);
        $qa = $left_shift_32($caml_string_get($d, 2), 16);
        $qb = $left_shift_32($caml_string_get($d, 1), 8);
        return (($caml_string_get($d, 0) + $qb | 0) + $qa | 0) + $p_ | 0;
      };
      $seed__0 = 0 === $seed->length - 1 ? V(0, 0) : ($seed);
      $l = $seed__0->length - 1;
      $i__0 = 0;
      for (;;) {
        $caml_check_bound($s[1], $i__0)[$i__0 + 1] = $i__0;
        $p9 = $i__0 + 1 | 0;
        if (54 !== $i__0) {$i__0 = $p9;continue;}
        $accu = V(0, $cst_x);
        $p4 = 54 + $caml_call2($Pervasives[5], 55, $l) | 0;
        $p3 = 0;
        if (! ($p4 < 0)) {
          $i = $p3;
          for (;;) {
            $j = $i % 55 | 0;
            $k = $caml_mod($i, $l);
            $p5 = $caml_check_bound($seed__0, $k)[$k + 1];
            $accu[1] = $combine($accu[1], $p5);
            $p6 = $extract($accu[1]);
            $p7 = ($caml_check_bound($s[1], $j)[$j + 1] ^ $p6) & 1073741823;
            $caml_check_bound($s[1], $j)[$j + 1] = $p7;
            $p8 = $i + 1 | 0;
            if ($p4 !== $i) {$i = $p8;continue;}
            break;
          }
        }
        $s[2] = 0;
        return 0;
      }
    };
    $make = function($seed) use ($full_init,$new_state) {
      $result = $new_state(0);
      $full_init($result, $seed);
      return $result;
    };
    $make_self_init = function($param) use ($caml_sys_random_seed,$make) {
      return $make($caml_sys_random_seed(0));
    };
    $copy = function($s) use ($assign,$new_state) {
      $result = $new_state(0);
      $assign($result, $s);
      return $result;
    };
    $bits = function($s) use ($caml_check_bound,$unsigned_right_shift_32) {
      $s[2] = ($s[2] + 1 | 0) % 55 | 0;
      $p0 = $s[2];
      $curval = $caml_check_bound($s[1], $p0)[$p0 + 1];
      $p1 = ($s[2] + 24 | 0) % 55 | 0;
      $newval = $caml_check_bound($s[1], $p1)[$p1 + 1] +
        ($curval ^ ($unsigned_right_shift_32($curval, 25) | 0) & 31) | 0;
      $newval30 = $newval & 1073741823;
      $p2 = $s[2];
      $caml_check_bound($s[1], $p2)[$p2 + 1] = $newval30;
      return $newval30;
    };
    $intaux = function($s, $n) use ($bits,$caml_mod) {
      for (;;) {
        $r = $bits($s);
        $v = $caml_mod($r, $n);
        if (((1073741823 - $n | 0) + 1 | 0) < ($r - $v | 0)) {continue;}
        return $v;
      }
    };
    $int__0 = function($s, $bound) use ($Pervasives,$caml_call1,$cst_Random_int,$intaux) {
      if (! (1073741823 < $bound)) {
        if (0 < $bound) {return $intaux($s, $bound);}
      }
      return $caml_call1($Pervasives[1], $cst_Random_int);
    };
    $int32aux = function($s, $n) use ($Int32,$bits,$caml_greaterthan,$caml_mod,$left_shift_32) {
      for (;;) {
        $b1 = $bits($s);
        $b2 = $left_shift_32($bits($s) & 1, 30);
        $r = $b1 | $b2;
        $v = $caml_mod($r, $n);
        if ($caml_greaterthan($r - $v | 0, ($Int32[7] - $n | 0) + 1 | 0)) {continue;}
        return $v;
      }
    };
    $int32 = function($s, $bound) use ($Pervasives,$caml_call1,$caml_lessequal,$cst_Random_int32,$int32aux) {
      return $caml_lessequal($bound, 0)
        ? $caml_call1($Pervasives[1], $cst_Random_int32)
        : ($int32aux($s, $bound));
    };
    $int64aux = function($s, $n) use ($Int64,$bits,$caml_greaterthan,$caml_int64_of_int32,$caml_int64_or,$caml_int64_shift_left,$caml_int64_sub,$pX,$runtime) {
      for (;;) {
        $b1 = $caml_int64_of_int32($bits($s));
        $b2 = $caml_int64_shift_left($caml_int64_of_int32($bits($s)), 30);
        $b3 = $caml_int64_shift_left($caml_int64_of_int32($bits($s) & 7), 60);
        $r = $caml_int64_or($b1, $caml_int64_or($b2, $b3));
        $v = $runtime->caml_int64_mod($r, $n);
        if (
          $caml_greaterthan(
            $caml_int64_sub($r, $v),
            $runtime->caml_int64_add($caml_int64_sub($Int64[7], $n), $pX)
          )
        ) {continue;}
        return $v;
      }
    };
    $int64 = function($s, $bound) use ($Pervasives,$caml_call1,$caml_lessequal,$cst_Random_int64,$int64aux,$pY) {
      return $caml_lessequal($bound, $pY)
        ? $caml_call1($Pervasives[1], $cst_Random_int64)
        : ($int64aux($s, $bound));
    };
    $nativeint = 32 === $Nativeint[7]
      ? function($s, $bound) use ($int32) {return $int32($s, $bound);}
      : (function($s, $bound) use ($caml_int64_of_int32,$int64,$runtime) {
       return $runtime->caml_int64_to_int32(
         $int64($s, $caml_int64_of_int32($bound))
       );
     });
    $rawfloat = function($s) use ($bits) {
      $r1 = $bits($s);
      $r2 = $bits($s);
      return ($r1 / 1073741824 + $r2) / 1073741824;
    };
    $float__0 = function($s, $bound) use ($rawfloat) {
      return $rawfloat($s) * $bound;
    };
    $bool = function($s) use ($bits) {return 0 === ($bits($s) & 1) ? 1 : (0);};
    $default__0 = V(0, $pZ->slice(), 0);
    $bits__0 = function($param) use ($bits,$default__0) {
      return $bits($default__0);
    };
    $int__1 = function($bound) use ($default__0,$int__0) {
      return $int__0($default__0, $bound);
    };
    $int32__0 = function($bound) use ($default__0,$int32) {
      return $int32($default__0, $bound);
    };
    $nativeint__0 = function($bound) use ($default__0,$nativeint) {
      return $nativeint($default__0, $bound);
    };
    $int64__0 = function($bound) use ($default__0,$int64) {
      return $int64($default__0, $bound);
    };
    $float__1 = function($scale) use ($default__0,$float__0) {
      return $float__0($default__0, $scale);
    };
    $bool__0 = function($param) use ($bool,$default__0) {
      return $bool($default__0);
    };
    $full_init__0 = function($seed) use ($default__0,$full_init) {
      return $full_init($default__0, $seed);
    };
    $init = function($seed) use ($default__0,$full_init) {
      return $full_init($default__0, V(0, $seed));
    };
    $self_init = function($param) use ($caml_sys_random_seed,$full_init__0) {
      return $full_init__0($caml_sys_random_seed(0));
    };
    $get_state = function($param) use ($copy,$default__0) {
      return $copy($default__0);
    };
    $set_state = function($s) use ($assign,$default__0) {
      return $assign($default__0, $s);
    };
    $Random = V(
      0,
      $init,
      $full_init__0,
      $self_init,
      $bits__0,
      $int__1,
      $int32__0,
      $nativeint__0,
      $int64__0,
      $float__1,
      $bool__0,
      V(
        0,
        $make,
        $make_self_init,
        $copy,
        $bits,
        $int__0,
        $int32,
        $nativeint,
        $int64,
        $float__0,
        $bool
      ),
      $get_state,
      $set_state
    );
    
    $runtime->caml_register_global(16, $Random, "Random");

  }
}