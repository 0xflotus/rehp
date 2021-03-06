<?hh
// Copyright 2004-present Facebook. All Rights Reserved.

/**
 * Map.php
 */

namespace Rehack;

final class Map {
  <<__Memoize>>
  public static function get() {
    $global_object = \Rehack\GlobalObject::get();
    $runtime = \Rehack\Runtime::get();
    /*
     * Soon, these will replace the `global_data->ModuleName`
     * pattern in the load() function.
     */
    $Pervasives = Pervasives::get();
    $Not_found = Not_found::get();
    $Assert_failure = Assert_failure::get();
    Map::load($global_object);
    $memoized = $runtime->caml_get_global_data()->Map;
    return $memoized;
  }

  /**
   * Performs module load operation. May have side effects.
   */
  private static function load($joo_global_object) {
    

    $runtime = $joo_global_object->jsoo_runtime;
    $caml_arity_test = $runtime->caml_arity_test;
    $ArrayLiteral = $runtime->ArrayLiteral;
    $caml_new_string = $runtime->caml_new_string;
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
    $caml_call3 = function($f, $a0, $a1, $a2) use ($ArrayLiteral,$caml_arity_test,$runtime) {
      return $caml_arity_test($f) == 3
        ? $f($a0, $a1, $a2)
        : ($runtime->caml_call_gen($f, $ArrayLiteral($a0, $a1, $a2)));
    };
    $global_data = $runtime->caml_get_global_data();
    $cst_Map_remove_min_elt = $caml_new_string("Map.remove_min_elt");
    $cst_Map_bal = $caml_new_string("Map.bal");
    $cst_Map_bal__0 = $caml_new_string("Map.bal");
    $cst_Map_bal__1 = $caml_new_string("Map.bal");
    $cst_Map_bal__2 = $caml_new_string("Map.bal");
    $Not_found = $global_data->Not_found;
    $Pervasives = $global_data->Pervasives;
    $Assert_failure = $global_data->Assert_failure;
    $ge = R(0, 0, 0, 0);
    $gf = R(0, $caml_new_string("map.ml"), 393, 10);
    $gg = R(0, 0, 0);
    $Make = function($Ord) use ($Assert_failure,$Not_found,$Pervasives,$caml_call1,$caml_call2,$caml_call3,$cst_Map_bal,$cst_Map_bal__0,$cst_Map_bal__1,$cst_Map_bal__2,$cst_Map_remove_min_elt,$ge,$gf,$gg,$runtime) {
      $add = new Ref();
      $add_max_binding = new Ref();
      $add_min_binding = new Ref();
      $bindings_aux = new Ref();
      $cardinal = new Ref();
      $exists = new Ref();
      $filter = new Ref();
      $fold = new Ref();
      $for_all = new Ref();
      $iter = new Ref();
      $join = new Ref();
      $map = new Ref();
      $mapi = new Ref();
      $merge = new Ref();
      $partition = new Ref();
      $remove = new Ref();
      $remove_min_binding = new Ref();
      $split = new Ref();
      $union = new Ref();
      $update = new Ref();
      $height = function($param) {
        if ($param) {$h = $param[5];return $h;}
        return 0;
      };
      $create = function($l, $x, $d, $r) use ($height) {
        $hl = $height($l);
        $hr = $height($r);
        $gR = $hr <= $hl ? $hl + 1 | 0 : ($hr + 1 | 0);
        return V(0, $l, $x, $d, $r, $gR);
      };
      $singleton = function($x, $d) {return V(0, 0, $x, $d, 0, 1);};
      $bal = function($l, $x, $d, $r) use ($Pervasives,$caml_call1,$create,$cst_Map_bal,$cst_Map_bal__0,$cst_Map_bal__1,$cst_Map_bal__2,$height) {
        if ($l) {
          $h = $l[5];
          $hl = $h;
        }
        else {$hl = 0;}
        if ($r) {
          $h__0 = $r[5];
          $hr = $h__0;
        }
        else {$hr = 0;}
        if (($hr + 2 | 0) < $hl) {
          if ($l) {
            $lr = $l[4];
            $ld = $l[3];
            $lv = $l[2];
            $ll = $l[1];
            $gM = $height($lr);
            if ($gM <= $height($ll)) {
              return $create($ll, $lv, $ld, $create($lr, $x, $d, $r));
            }
            if ($lr) {
              $lrr = $lr[4];
              $lrd = $lr[3];
              $lrv = $lr[2];
              $lrl = $lr[1];
              $gN = $create($lrr, $x, $d, $r);
              return $create($create($ll, $lv, $ld, $lrl), $lrv, $lrd, $gN);
            }
            return $caml_call1($Pervasives[1], $cst_Map_bal);
          }
          return $caml_call1($Pervasives[1], $cst_Map_bal__0);
        }
        if (($hl + 2 | 0) < $hr) {
          if ($r) {
            $rr = $r[4];
            $rd = $r[3];
            $rv = $r[2];
            $rl = $r[1];
            $gO = $height($rl);
            if ($gO <= $height($rr)) {
              return $create($create($l, $x, $d, $rl), $rv, $rd, $rr);
            }
            if ($rl) {
              $rlr = $rl[4];
              $rld = $rl[3];
              $rlv = $rl[2];
              $rll = $rl[1];
              $gP = $create($rlr, $rv, $rd, $rr);
              return $create($create($l, $x, $d, $rll), $rlv, $rld, $gP);
            }
            return $caml_call1($Pervasives[1], $cst_Map_bal__1);
          }
          return $caml_call1($Pervasives[1], $cst_Map_bal__2);
        }
        $gQ = $hr <= $hl ? $hl + 1 | 0 : ($hr + 1 | 0);
        return V(0, $l, $x, $d, $r, $gQ);
      };
      $empty = 0;
      $is_empty = function($param) {return $param ? 0 : (1);};
      $_ = $add->contents =
        function($x, $data, $m) use ($Ord,$add,$bal,$caml_call2) {
          if ($m) {
            $h = $m[5];
            $r = $m[4];
            $d = $m[3];
            $v = $m[2];
            $l = $m[1];
            $c = $caml_call2($Ord[1], $x, $v);
            if (0 === $c) {
              return $d === $data ? $m : (V(0, $l, $x, $data, $r, $h));
            }
            if (0 <= $c) {
              $rr = $add->contents($x, $data, $r);
              return $r === $rr ? $m : ($bal($l, $v, $d, $rr));
            }
            $ll = $add->contents($x, $data, $l);
            return $l === $ll ? $m : ($bal($ll, $v, $d, $r));
          }
          return V(0, 0, $x, $data, 0, 1);
        };
      $find = function($x, $param) use ($Not_found,$Ord,$caml_call2,$runtime) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            $c = $caml_call2($Ord[1], $x, $v);
            if (0 === $c) {return $d;}
            $param__1 = 0 <= $c ? $r : ($l);
            $param__0 = $param__1;
            continue;
          }
          throw $runtime->caml_wrap_thrown_exception($Not_found);
        }
      };
      $find_first_aux = function($v0, $d0, $f, $param) use ($caml_call1) {
        $v0__0 = $v0;
        $d0__0 = $d0;
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {
              $v0__0 = $v;
              $d0__0 = $d;
              $param__0 = $l;
              continue;
            }
            $param__0 = $r;
            continue;
          }
          return V(0, $v0__0, $d0__0);
        }
      };
      $find_first = function($f, $param) use ($Not_found,$caml_call1,$find_first_aux,$runtime) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {return $find_first_aux($v, $d, $f, $l);}
            $param__0 = $r;
            continue;
          }
          throw $runtime->caml_wrap_thrown_exception($Not_found);
        }
      };
      $find_first_opt_aux = function($v0, $d0, $f, $param) use ($caml_call1) {
        $v0__0 = $v0;
        $d0__0 = $d0;
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {
              $v0__0 = $v;
              $d0__0 = $d;
              $param__0 = $l;
              continue;
            }
            $param__0 = $r;
            continue;
          }
          return V(0, V(0, $v0__0, $d0__0));
        }
      };
      $find_first_opt = function($f, $param) use ($caml_call1,$find_first_opt_aux) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {
              return $find_first_opt_aux($v, $d, $f, $l);
            }
            $param__0 = $r;
            continue;
          }
          return 0;
        }
      };
      $find_last_aux = function($v0, $d0, $f, $param) use ($caml_call1) {
        $v0__0 = $v0;
        $d0__0 = $d0;
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {
              $v0__0 = $v;
              $d0__0 = $d;
              $param__0 = $r;
              continue;
            }
            $param__0 = $l;
            continue;
          }
          return V(0, $v0__0, $d0__0);
        }
      };
      $find_last = function($f, $param) use ($Not_found,$caml_call1,$find_last_aux,$runtime) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {return $find_last_aux($v, $d, $f, $r);}
            $param__0 = $l;
            continue;
          }
          throw $runtime->caml_wrap_thrown_exception($Not_found);
        }
      };
      $find_last_opt_aux = function($v0, $d0, $f, $param) use ($caml_call1) {
        $v0__0 = $v0;
        $d0__0 = $d0;
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {
              $v0__0 = $v;
              $d0__0 = $d;
              $param__0 = $r;
              continue;
            }
            $param__0 = $l;
            continue;
          }
          return V(0, V(0, $v0__0, $d0__0));
        }
      };
      $find_last_opt = function($f, $param) use ($caml_call1,$find_last_opt_aux) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            if ($caml_call1($f, $v)) {
              return $find_last_opt_aux($v, $d, $f, $r);
            }
            $param__0 = $l;
            continue;
          }
          return 0;
        }
      };
      $find_opt = function($x, $param) use ($Ord,$caml_call2) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $d = $param__0[3];
            $v = $param__0[2];
            $l = $param__0[1];
            $c = $caml_call2($Ord[1], $x, $v);
            if (0 === $c) {return V(0, $d);}
            $param__1 = 0 <= $c ? $r : ($l);
            $param__0 = $param__1;
            continue;
          }
          return 0;
        }
      };
      $mem = function($x, $param) use ($Ord,$caml_call2) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $r = $param__0[4];
            $v = $param__0[2];
            $l = $param__0[1];
            $c = $caml_call2($Ord[1], $x, $v);
            $gL = 0 === $c ? 1 : (0);
            if ($gL) {return $gL;}
            $param__1 = 0 <= $c ? $r : ($l);
            $param__0 = $param__1;
            continue;
          }
          return 0;
        }
      };
      $min_binding = function($param) use ($Not_found,$runtime) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $gK = $param__0[1];
            if ($gK) {$param__0 = $gK;continue;}
            $d = $param__0[3];
            $v = $param__0[2];
            return V(0, $v, $d);
          }
          throw $runtime->caml_wrap_thrown_exception($Not_found);
        }
      };
      $min_binding_opt = function($param) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $gJ = $param__0[1];
            if ($gJ) {$param__0 = $gJ;continue;}
            $d = $param__0[3];
            $v = $param__0[2];
            return V(0, V(0, $v, $d));
          }
          return 0;
        }
      };
      $max_binding = function($param) use ($Not_found,$runtime) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $gG = $param__0[4];
            $gH = $param__0[3];
            $gI = $param__0[2];
            if ($gG) {$param__0 = $gG;continue;}
            return V(0, $gI, $gH);
          }
          throw $runtime->caml_wrap_thrown_exception($Not_found);
        }
      };
      $max_binding_opt = function($param) {
        $param__0 = $param;
        for (;;) {
          if ($param__0) {
            $gD = $param__0[4];
            $gE = $param__0[3];
            $gF = $param__0[2];
            if ($gD) {$param__0 = $gD;continue;}
            return V(0, V(0, $gF, $gE));
          }
          return 0;
        }
      };
      $_ = $remove_min_binding->contents =
        function($param) use ($Pervasives,$bal,$caml_call1,$cst_Map_remove_min_elt,$remove_min_binding) {
          if ($param) {
            $gC = $param[1];
            if ($gC) {
              $r = $param[4];
              $d = $param[3];
              $v = $param[2];
              return $bal($remove_min_binding->contents($gC), $v, $d, $r);
            }
            $r__0 = $param[4];
            return $r__0;
          }
          return $caml_call1($Pervasives[1], $cst_Map_remove_min_elt);
        };
      $gj = function($t, $match) use ($bal,$min_binding,$remove_min_binding) {
        if ($t) {
          if ($match) {
            $match__0 = $min_binding($match);
            $d = $match__0[2];
            $x = $match__0[1];
            return $bal($t, $x, $d, $remove_min_binding->contents($match));
          }
          return $t;
        }
        return $match;
      };
      $_ = $remove->contents =
        function($x, $m) use ($Ord,$bal,$caml_call2,$gj,$remove) {
          if ($m) {
            $r = $m[4];
            $d = $m[3];
            $v = $m[2];
            $l = $m[1];
            $c = $caml_call2($Ord[1], $x, $v);
            if (0 === $c) {return $gj($l, $r);}
            if (0 <= $c) {
              $rr = $remove->contents($x, $r);
              return $r === $rr ? $m : ($bal($l, $v, $d, $rr));
            }
            $ll = $remove->contents($x, $l);
            return $l === $ll ? $m : ($bal($ll, $v, $d, $r));
          }
          return 0;
        };
      $_ = $update->contents =
        function($x, $f, $m) use ($Ord,$bal,$caml_call1,$caml_call2,$gj,$update) {
          if ($m) {
            $h = $m[5];
            $r = $m[4];
            $d = $m[3];
            $v = $m[2];
            $l = $m[1];
            $c = $caml_call2($Ord[1], $x, $v);
            if (0 === $c) {
              $match = $caml_call1($f, V(0, $d));
              if ($match) {
                $data = $match[1];
                return $d === $data ? $m : (V(0, $l, $x, $data, $r, $h));
              }
              return $gj($l, $r);
            }
            if (0 <= $c) {
              $rr = $update->contents($x, $f, $r);
              return $r === $rr ? $m : ($bal($l, $v, $d, $rr));
            }
            $ll = $update->contents($x, $f, $l);
            return $l === $ll ? $m : ($bal($ll, $v, $d, $r));
          }
          $match__0 = $caml_call1($f, 0);
          if ($match__0) {
            $data__0 = $match__0[1];
            return V(0, 0, $x, $data__0, 0, 1);
          }
          return 0;
        };
      $_ = $iter->contents =
        function($f, $param) use ($caml_call2,$iter) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $param__1 = $param__0[4];
              $d = $param__0[3];
              $v = $param__0[2];
              $l = $param__0[1];
              $iter->contents($f, $l);
              $caml_call2($f, $v, $d);
              $param__0 = $param__1;
              continue;
            }
            return 0;
          }
        };
      $_ = $map->contents =
        function($f, $param) use ($caml_call1,$map) {
          if ($param) {
            $h = $param[5];
            $r = $param[4];
            $d = $param[3];
            $v = $param[2];
            $l = $param[1];
            $l__0 = $map->contents($f, $l);
            $d__0 = $caml_call1($f, $d);
            $r__0 = $map->contents($f, $r);
            return V(0, $l__0, $v, $d__0, $r__0, $h);
          }
          return 0;
        };
      $_ = $mapi->contents =
        function($f, $param) use ($caml_call2,$mapi) {
          if ($param) {
            $h = $param[5];
            $r = $param[4];
            $d = $param[3];
            $v = $param[2];
            $l = $param[1];
            $l__0 = $mapi->contents($f, $l);
            $d__0 = $caml_call2($f, $v, $d);
            $r__0 = $mapi->contents($f, $r);
            return V(0, $l__0, $v, $d__0, $r__0, $h);
          }
          return 0;
        };
      $_ = $fold->contents =
        function($f, $m, $accu) use ($caml_call3,$fold) {
          $m__0 = $m;
          $accu__0 = $accu;
          for (;;) {
            if ($m__0) {
              $m__1 = $m__0[4];
              $d = $m__0[3];
              $v = $m__0[2];
              $l = $m__0[1];
              $accu__1 = $caml_call3(
                $f,
                $v,
                $d,
                $fold->contents($f, $l, $accu__0)
              );
              $m__0 = $m__1;
              $accu__0 = $accu__1;
              continue;
            }
            return $accu__0;
          }
        };
      $_ = $for_all->contents =
        function($p, $param) use ($caml_call2,$for_all) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $r = $param__0[4];
              $d = $param__0[3];
              $v = $param__0[2];
              $l = $param__0[1];
              $gz = $caml_call2($p, $v, $d);
              if ($gz) {
                $gA = $for_all->contents($p, $l);
                if ($gA) {$param__0 = $r;continue;}
                $gB = $gA;
              }
              else {$gB = $gz;}
              return $gB;
            }
            return 1;
          }
        };
      $_ = $exists->contents =
        function($p, $param) use ($caml_call2,$exists) {
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $r = $param__0[4];
              $d = $param__0[3];
              $v = $param__0[2];
              $l = $param__0[1];
              $gw = $caml_call2($p, $v, $d);
              if ($gw) {
                $gx = $gw;
              }
              else {
                $gy = $exists->contents($p, $l);
                if (! $gy) {$param__0 = $r;continue;}
                $gx = $gy;
              }
              return $gx;
            }
            return 0;
          }
        };
      $_ = $add_min_binding->contents =
        function($k, $x, $param) use ($add_min_binding,$bal,$singleton) {
          if ($param) {
            $r = $param[4];
            $d = $param[3];
            $v = $param[2];
            $l = $param[1];
            return $bal($add_min_binding->contents($k, $x, $l), $v, $d, $r);
          }
          return $singleton($k, $x);
        };
      $_ = $add_max_binding->contents =
        function($k, $x, $param) use ($add_max_binding,$bal,$singleton) {
          if ($param) {
            $r = $param[4];
            $d = $param[3];
            $v = $param[2];
            $l = $param[1];
            return $bal($l, $v, $d, $add_max_binding->contents($k, $x, $r));
          }
          return $singleton($k, $x);
        };
      $_ = $join->contents =
        function($l, $v, $d, $r) use ($add_max_binding,$add_min_binding,$bal,$create,$join) {
          if ($l) {
            if ($r) {
              $rh = $r[5];
              $rr = $r[4];
              $rd = $r[3];
              $rv = $r[2];
              $rl = $r[1];
              $lh = $l[5];
              $lr = $l[4];
              $ld = $l[3];
              $lv = $l[2];
              $ll = $l[1];
              return ($rh + 2 | 0) < $lh
                ? $bal($ll, $lv, $ld, $join->contents($lr, $v, $d, $r))
                : (($lh + 2 | 0) < $rh
                 ? $bal($join->contents($l, $v, $d, $rl), $rv, $rd, $rr)
                 : ($create($l, $v, $d, $r)));
            }
            return $add_max_binding->contents($v, $d, $l);
          }
          return $add_min_binding->contents($v, $d, $r);
        };
      $concat = function($t, $match) use ($join,$min_binding,$remove_min_binding) {
        if ($t) {
          if ($match) {
            $match__0 = $min_binding($match);
            $d = $match__0[2];
            $x = $match__0[1];
            return $join->contents(
              $t,
              $x,
              $d,
              $remove_min_binding->contents($match)
            );
          }
          return $t;
        }
        return $match;
      };
      $concat_or_join = function($t1, $v, $d, $t2) use ($concat,$join) {
        if ($d) {$d__0 = $d[1];return $join->contents($t1, $v, $d__0, $t2);}
        return $concat($t1, $t2);
      };
      $_ = $split->contents =
        function($x, $param) use ($Ord,$caml_call2,$ge,$join,$split) {
          if ($param) {
            $r = $param[4];
            $d = $param[3];
            $v = $param[2];
            $l = $param[1];
            $c = $caml_call2($Ord[1], $x, $v);
            if (0 === $c) {return V(0, $l, V(0, $d), $r);}
            if (0 <= $c) {
              $match = $split->contents($x, $r);
              $rr = $match[3];
              $pres = $match[2];
              $lr = $match[1];
              return V(0, $join->contents($l, $v, $d, $lr), $pres, $rr);
            }
            $match__0 = $split->contents($x, $l);
            $rl = $match__0[3];
            $pres__0 = $match__0[2];
            $ll = $match__0[1];
            return V(0, $ll, $pres__0, $join->contents($rl, $v, $d, $r));
          }
          return $ge;
        };
      $_ = $merge->contents =
        function($f, $s1, $s2) use ($Assert_failure,$caml_call3,$concat_or_join,$gf,$height,$merge,$runtime,$split) {
          if ($s1) {
            $h1 = $s1[5];
            $r1 = $s1[4];
            $d1 = $s1[3];
            $v1 = $s1[2];
            $l1 = $s1[1];
            if ($height($s2) <= $h1) {
              $match = $split->contents($v1, $s2);
              $r2 = $match[3];
              $d2 = $match[2];
              $l2 = $match[1];
              $gs = $merge->contents($f, $r1, $r2);
              $gt = $caml_call3($f, $v1, V(0, $d1), $d2);
              return $concat_or_join(
                $merge->contents($f, $l1, $l2),
                $v1,
                $gt,
                $gs
              );
            }
          }
          else {if (! $s2) {return 0;}}
          if ($s2) {
            $r2__0 = $s2[4];
            $d2__0 = $s2[3];
            $v2 = $s2[2];
            $l2__0 = $s2[1];
            $match__0 = $split->contents($v2, $s1);
            $r1__0 = $match__0[3];
            $d1__0 = $match__0[2];
            $l1__0 = $match__0[1];
            $gu = $merge->contents($f, $r1__0, $r2__0);
            $gv = $caml_call3($f, $v2, $d1__0, V(0, $d2__0));
            return $concat_or_join(
              $merge->contents($f, $l1__0, $l2__0),
              $v2,
              $gv,
              $gu
            );
          }
          throw $runtime->caml_wrap_thrown_exception(
                  V(0, $Assert_failure, $gf)
                );
        };
      $_ = $union->contents =
        function($f, $s1, $s2) use ($caml_call3,$concat_or_join,$join,$split,$union) {
          if ($s1) {
            if ($s2) {
              $h2 = $s2[5];
              $r2 = $s2[4];
              $d2 = $s2[3];
              $v2 = $s2[2];
              $l2 = $s2[1];
              $h1 = $s1[5];
              $r1 = $s1[4];
              $d1 = $s1[3];
              $v1 = $s1[2];
              $l1 = $s1[1];
              if ($h2 <= $h1) {
                $match = $split->contents($v1, $s2);
                $r2__0 = $match[3];
                $d2__0 = $match[2];
                $l2__0 = $match[1];
                $l = $union->contents($f, $l1, $l2__0);
                $r = $union->contents($f, $r1, $r2__0);
                if ($d2__0) {
                  $d2__1 = $d2__0[1];
                  return $concat_or_join(
                    $l,
                    $v1,
                    $caml_call3($f, $v1, $d1, $d2__1),
                    $r
                  );
                }
                return $join->contents($l, $v1, $d1, $r);
              }
              $match__0 = $split->contents($v2, $s1);
              $r1__0 = $match__0[3];
              $d1__0 = $match__0[2];
              $l1__0 = $match__0[1];
              $l__0 = $union->contents($f, $l1__0, $l2);
              $r__0 = $union->contents($f, $r1__0, $r2);
              if ($d1__0) {
                $d1__1 = $d1__0[1];
                return $concat_or_join(
                  $l__0,
                  $v2,
                  $caml_call3($f, $v2, $d1__1, $d2),
                  $r__0
                );
              }
              return $join->contents($l__0, $v2, $d2, $r__0);
            }
            $s = $s1;
          }
          else {$s = $s2;}
          return $s;
        };
      $_ = $filter->contents =
        function($p, $m) use ($caml_call2,$concat,$filter,$join) {
          if ($m) {
            $r = $m[4];
            $d = $m[3];
            $v = $m[2];
            $l = $m[1];
            $l__0 = $filter->contents($p, $l);
            $pvd = $caml_call2($p, $v, $d);
            $r__0 = $filter->contents($p, $r);
            if ($pvd) {
              if ($l === $l__0) {if ($r === $r__0) {return $m;}}
              return $join->contents($l__0, $v, $d, $r__0);
            }
            return $concat($l__0, $r__0);
          }
          return 0;
        };
      $_ = $partition->contents =
        function($p, $param) use ($caml_call2,$concat,$gg,$join,$partition) {
          if ($param) {
            $r = $param[4];
            $d = $param[3];
            $v = $param[2];
            $l = $param[1];
            $match = $partition->contents($p, $l);
            $lf = $match[2];
            $lt = $match[1];
            $pvd = $caml_call2($p, $v, $d);
            $match__0 = $partition->contents($p, $r);
            $rf = $match__0[2];
            $rt = $match__0[1];
            if ($pvd) {
              $gq = $concat($lf, $rf);
              return V(0, $join->contents($lt, $v, $d, $rt), $gq);
            }
            $gr = $join->contents($lf, $v, $d, $rf);
            return V(0, $concat($lt, $rt), $gr);
          }
          return $gg;
        };
      $cons_enum = function($m, $e) {
        $m__0 = $m;
        $e__0 = $e;
        for (;;) {
          if ($m__0) {
            $r = $m__0[4];
            $d = $m__0[3];
            $v = $m__0[2];
            $m__1 = $m__0[1];
            $e__1 = V(0, $v, $d, $r, $e__0);
            $m__0 = $m__1;
            $e__0 = $e__1;
            continue;
          }
          return $e__0;
        }
      };
      $compare = function($cmp, $m1, $m2) use ($Ord,$caml_call2,$cons_enum) {
        $compare_aux = function($e1, $e2) use ($Ord,$caml_call2,$cmp,$cons_enum) {
          $e1__0 = $e1;
          $e2__0 = $e2;
          for (;;) {
            if ($e1__0) {
              if ($e2__0) {
                $e2__1 = $e2__0[4];
                $r2 = $e2__0[3];
                $d2 = $e2__0[2];
                $v2 = $e2__0[1];
                $e1__1 = $e1__0[4];
                $r1 = $e1__0[3];
                $d1 = $e1__0[2];
                $v1 = $e1__0[1];
                $c = $caml_call2($Ord[1], $v1, $v2);
                if (0 === $c) {
                  $c__0 = $caml_call2($cmp, $d1, $d2);
                  if (0 === $c__0) {
                    $e2__2 = $cons_enum($r2, $e2__1);
                    $e1__2 = $cons_enum($r1, $e1__1);
                    $e1__0 = $e1__2;
                    $e2__0 = $e2__2;
                    continue;
                  }
                  return $c__0;
                }
                return $c;
              }
              return 1;
            }
            return $e2__0 ? -1 : (0);
          }
        };
        $gp = $cons_enum($m2, 0);
        return $compare_aux($cons_enum($m1, 0), $gp);
      };
      $equal = function($cmp, $m1, $m2) use ($Ord,$caml_call2,$cons_enum) {
        $equal_aux = function($e1, $e2) use ($Ord,$caml_call2,$cmp,$cons_enum) {
          $e1__0 = $e1;
          $e2__0 = $e2;
          for (;;) {
            if ($e1__0) {
              if ($e2__0) {
                $e2__1 = $e2__0[4];
                $r2 = $e2__0[3];
                $d2 = $e2__0[2];
                $v2 = $e2__0[1];
                $e1__1 = $e1__0[4];
                $r1 = $e1__0[3];
                $d1 = $e1__0[2];
                $v1 = $e1__0[1];
                $gm = 0 === $caml_call2($Ord[1], $v1, $v2) ? 1 : (0);
                if ($gm) {
                  $gn = $caml_call2($cmp, $d1, $d2);
                  if ($gn) {
                    $e2__2 = $cons_enum($r2, $e2__1);
                    $e1__2 = $cons_enum($r1, $e1__1);
                    $e1__0 = $e1__2;
                    $e2__0 = $e2__2;
                    continue;
                  }
                  $go = $gn;
                }
                else {$go = $gm;}
                return $go;
              }
              return 0;
            }
            return $e2__0 ? 0 : (1);
          }
        };
        $gl = $cons_enum($m2, 0);
        return $equal_aux($cons_enum($m1, 0), $gl);
      };
      $_ = $cardinal->contents =
        function($param) use ($cardinal) {
          if ($param) {
            $r = $param[4];
            $l = $param[1];
            $gk = $cardinal->contents($r);
            return ($cardinal->contents($l) + 1 | 0) + $gk | 0;
          }
          return 0;
        };
      $_ = $bindings_aux->contents =
        function($accu, $param) use ($bindings_aux) {
          $accu__0 = $accu;
          $param__0 = $param;
          for (;;) {
            if ($param__0) {
              $r = $param__0[4];
              $d = $param__0[3];
              $v = $param__0[2];
              $param__1 = $param__0[1];
              $accu__1 = V(
                0,
                V(0, $v, $d),
                $bindings_aux->contents($accu__0, $r)
              );
              $accu__0 = $accu__1;
              $param__0 = $param__1;
              continue;
            }
            return $accu__0;
          }
        };
      $bindings = function($s) use ($bindings_aux) {
        return $bindings_aux->contents(0, $s);
      };
      return V(
        0,
        $height,
        $create,
        $singleton,
        $bal,
        $empty,
        $is_empty,
        $add->contents,
        $find,
        $find_first_aux,
        $find_first,
        $find_first_opt_aux,
        $find_first_opt,
        $find_last_aux,
        $find_last,
        $find_last_opt_aux,
        $find_last_opt,
        $find_opt,
        $mem,
        $min_binding,
        $min_binding_opt,
        $max_binding,
        $max_binding_opt,
        $remove_min_binding->contents,
        $remove->contents,
        $update->contents,
        $iter->contents,
        $map->contents,
        $mapi->contents,
        $fold->contents,
        $for_all->contents,
        $exists->contents,
        $add_min_binding->contents,
        $add_max_binding->contents,
        $join->contents,
        $concat,
        $concat_or_join,
        $split->contents,
        $merge->contents,
        $union->contents,
        $filter->contents,
        $partition->contents,
        $cons_enum,
        $compare,
        $equal,
        $cardinal->contents,
        $bindings_aux->contents,
        $bindings,
        $min_binding,
        $min_binding_opt
      );
    };
    $Map = V(
      0,
      function($gh) use ($Make) {
        $gi = $Make($gh);
        return V(
          0,
          $gi[5],
          $gi[6],
          $gi[18],
          $gi[7],
          $gi[25],
          $gi[3],
          $gi[24],
          $gi[38],
          $gi[39],
          $gi[43],
          $gi[44],
          $gi[26],
          $gi[29],
          $gi[30],
          $gi[31],
          $gi[40],
          $gi[41],
          $gi[45],
          $gi[47],
          $gi[19],
          $gi[20],
          $gi[21],
          $gi[22],
          $gi[48],
          $gi[49],
          $gi[37],
          $gi[8],
          $gi[17],
          $gi[10],
          $gi[12],
          $gi[14],
          $gi[16],
          $gi[27],
          $gi[28]
        );
      }
    );
    
    $runtime->caml_register_global(11, $Map, "Map");

  }
}