// Js_of_ocaml library
// http://www.ocsigen.org/js_of_ocaml/
// Copyright (C) 2010 Jérôme Vouillon
// Laboratoire PPS - CNRS Université Paris Diderot
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as published by
// the Free Software Foundation, with linking exception;
// either version 2.1 of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.

///////////// Jslib: code specific to Js_of_ocaml

//Provides: caml_js_from_bool const (const)
function caml_js_from_bool(x) { return !!x; }
//Provides: caml_js_to_bool const (const)
function caml_js_to_bool(x) { return +x; }
//Provides: caml_js_from_float const (const)
function caml_js_from_float(x) { return x; }
//Provides: caml_js_to_float const (const)
function caml_js_to_float(x) { return x; }
//Provides: caml_js_from_string mutable (const)
//Requires: MlBytes
function caml_js_from_string(s) { return s.toString(); }
//Provides: caml_js_from_array mutable (shallow)
//Requires: raw_array_sub
function caml_js_from_array(a) { return raw_array_sub(a,1,a.length-1); }
//Provides: caml_js_to_array mutable (shallow)
//Requires: raw_array_cons
function caml_js_to_array(a) { return raw_array_cons(a,0); }

//Provides: caml_js_var mutable (const)
//Requires: js_print_stderr
//Requires: MlBytes, eval
function caml_js_var(x) {
  var x = x.toString();
  //Checks that x has the form ident[.ident]*
  if(!x.match(/^[a-zA-Z_$][a-zA-Z_$0-9]*(\.[a-zA-Z_$][a-zA-Z_$0-9]*)*$/)){
    js_print_stderr("caml_js_var: \"" + x + "\" is not a valid JavaScript variable. continuing ..");
    //joo_global_object.console.error("Js.Unsafe.eval_string")
  }
  return eval(x);
}
//Provides: caml_js_call (const, mutable, shallow)
//Requires: caml_js_from_array
function caml_js_call(f, o, args) { return f.apply(o, caml_js_from_array(args)); }
//Provides: caml_js_fun_call (const, shallow)
//Requires: caml_js_from_array
function caml_js_fun_call(f, a) {
  switch (a.length) {
  case 1: return f();
  case 2: return f (a[1]);
  case 3: return f (a[1],a[2]);
  case 4: return f (a[1],a[2],a[3]);
  case 5: return f (a[1],a[2],a[3],a[4]);
  case 6: return f (a[1],a[2],a[3],a[4],a[5]);
  case 7: return f (a[1],a[2],a[3],a[4],a[5],a[6]);
  case 8: return f (a[1],a[2],a[3],a[4],a[5],a[6],a[7]);
  }
  return f.apply(null, caml_js_from_array(a));
}

// TODO: Are the mutable annotations correct?
// TODO: Replace this with inline calls in generate.ml.
//Provides: caml_js_fun_call1 (const, mutable)
function caml_js_fun_call1(f, a) {
  return f(a);
}

// TODO: Are the mutable annotations correct?
// TODO: Replace this with inline calls in generate.ml.
//Provides: caml_js_fun_call2 (const, mutable, mutable)
function caml_js_fun_call2(f, a, b) {
  return f(a, b);
}

//Provides: caml_js_meth_call (mutable, const, shallow)
//Requires: MlBytes
//Requires: caml_js_from_array
function caml_js_meth_call(o, f, args) {
  return o[f.toString()].apply(o, caml_js_from_array(args));
}

//Provides: caml_js_new (const, shallow)
//Requires: caml_js_from_array
function caml_js_new(c, a) {
  switch (a.length) {
  case 1: return new c;
  case 2: return new c (a[1]);
  case 3: return new c (a[1],a[2]);
  case 4: return new c (a[1],a[2],a[3]);
  case 5: return new c (a[1],a[2],a[3],a[4]);
  case 6: return new c (a[1],a[2],a[3],a[4],a[5]);
  case 7: return new c (a[1],a[2],a[3],a[4],a[5],a[6]);
  case 8: return new c (a[1],a[2],a[3],a[4],a[5],a[6],a[7]);
  }
  function F() { return c.apply(this, caml_js_from_array(a)); }
  F.prototype = c.prototype;
  return new F;
}
//Provides: caml_ojs_new_arr (const, shallow)
//Requires: caml_js_from_array
function caml_ojs_new_arr(c, a) {
  switch (a.length) {
  case 0: return new c;
  case 1: return new c (a[0]);
  case 2: return new c (a[0],a[1]);
  case 3: return new c (a[0],a[1],a[2]);
  case 4: return new c (a[0],a[1],a[2],a[3]);
  case 5: return new c (a[0],a[1],a[2],a[3],a[4]);
  case 6: return new c (a[0],a[1],a[2],a[3],a[4],a[5]);
  case 7: return new c (a[0],a[1],a[2],a[3],a[4],a[5],a[6]);
  }
  function F() { return c.apply(this, a); }
  F.prototype = c.prototype;
  return new F;
}
//Provides: caml_js_wrap_callback const (const)
//Requires: caml_call_gen
function caml_js_wrap_callback(f) {
  return function () {
    if(arguments.length > 0){
      return caml_call_gen(f, arguments);
    } else {
      return caml_call_gen(f, [undefined]);
    }
  }
}

//Provides: caml_js_wrap_callback_arguments
//Requires: caml_js_wrap_callback
function caml_js_wrap_callback_arguments(f) {
  return function() {
    return caml_js_wrap_callback(f)(arguments);
  }
}

//Provides: caml_js_wrap_callback const (const)
//Requires: caml_call_gen, ArrayLiteral, Func, caml_call_gen
//ForBackend: php
var caml_js_wrap_callback = raw_backend([
  "  $caml_js_wrap_callback = $Func(",
  "    function($f) use ($Array,$ArrayLiteral,$Func,$caml_call_gen) {",
  "      print(\"WARNING: caml_js_wrap_callback is not yet tested\");",
  "      return $Func(",
  "        function() use ($Array,$ArrayLiteral,$caml_call_gen,$f) {",
  "          $arguments=\func_get_args();",
  "          if (PHP\count($arguments) > 0) {",
  "            return $caml_call_gen($f, $Array->new($arguments));",
  "          } else {",
  "            return $caml_call_gen($f, $ArrayLiteral(NULL));",
  "          }",
  "        }",
  "      );",
  "    }",
  "  );"
]);

//Provides: caml_js_wrap_callback_arguments
//Requires: caml_js_wrap_callback, Func, caml_js_wrap_callback
//ForBackend: php
var caml_js_wrap_callback_arguments = raw_backend([
  "  $caml_js_wrap_callback_arguments = $Func(",
  "    function($f) use ($Func, $caml_js_wrap_callback) {",
  "      print(\"WARNING: caml_js_wrap_callback_arguments is not yet tested\");",
  "      return $Func(",
  "        function() use ($caml_js_wrap_callback, $f) {",
  "          $arguments=\func_get_args();",
  "          return $caml_js_wrap_callback($f)($arguments);",
  "        }",
  "      );",
  "    }",
  "  );"
]);

//Provides: caml_js_wrap_callback_strict const
//Requires: caml_call_gen
function caml_js_wrap_callback_strict(arity, f) {
  return function () {
    var n = arguments.length;
    if(n == arity) return caml_call_gen(f, arguments);
    var args = new Array(arity);
    for (var i = 0; i < n && i < arity; i++) args[i] = arguments[i];
    return caml_call_gen(f, args);
  };
}
//Provides: caml_js_wrap_callback_strict const
//Requires: Func, ArrayLiteral, caml_call_gen
//ForBackend: php
var caml_js_wrap_callback_strict = raw_backend([
  "    $caml_js_wrap_callback_strict = $Func(",
  "      function($arity, $f) use (",
  "        $Func,",
  "        $Math,",
  "        $ArrayLiteral,",
  "        $caml_call_gen",
  "      ) {",
  "        print(\"WARNING: caml_js_wrap_callback_strict is not yet tested\");",
  "        return $Func(",
  "          function() use (",
  "            $Math,",
  "            $ArrayLiteral,",
  "            $arity,",
  "            $caml_call_gen,",
  "            $f",
  "          ) {",
  "            $func_args = \func_get_args();",
  "            $n = PHP\count($func_args);",
  "            if ($n !== $arity) {",
  "              $func_args = PHP\array_slice($func_args, 0, $Math->min($n, $arity));",
  "            }",
  "            return $caml_call_gen($f, $ArrayLiteral($func_args));",
  "          }",
  "        );",
  "      }",
  "    );",
]);
//Provides: caml_js_wrap_meth_callback const (const)
//Requires: caml_call_gen,raw_array_cons
function caml_js_wrap_meth_callback(f) {
  return function () {
    return caml_call_gen(f,raw_array_cons(arguments,this));
  }
}
//Provides: caml_js_wrap_meth_callback const (const)
//Requires: ArrayLiteral, Func, caml_call_gen, raw_array_cons
//ForBackend: php
var caml_js_wrap_meth_callback = raw_backend([
  "    $caml_js_wrap_meth_callback = $Func(",
  "      function($f) use (",
  "        $ArrayLiteral,",
  "        $Func,",
  "        $caml_call_gen,",
  "        $raw_array_cons,",
  "        $joo_global_object",
  "      ) {",
  "        print(\"WARNING: caml_js_wrap_meth_callback is not yet tested\");",
  "        return $Func(",
  "          function() use (",
  "            $caml_call_gen,",
  "            $f,",
  "            $joo_global_object,",
  "            $raw_array_cons,",
  "            $ArrayLiteral",
  "          ) {",
  "            return $caml_call_gen(",
  "              $f,",
  "              $raw_array_cons(",
  "                $ArrayLiteral(\func_get_args()),",
  "                $joo_global_object->context",
  "              )",
  "            );",
  "          }",
  "        );",
  "      }",
  "    );",
]);

//Provides: caml_js_wrap_meth_callback_arguments const (const)
//Requires: caml_call_gen,raw_array_cons
function caml_js_wrap_meth_callback_arguments(f) {
  return function () {
    return caml_call_gen(f,[this,arguments]);
  }
}
//Provides: caml_js_wrap_meth_callback_arguments const (const)
//Requires: ArrayLiteral, Func, caml_call_gen
//ForBackend: php
var caml_js_wrap_meth_callback_arguments = raw_backend([
  "    $caml_js_wrap_meth_callback_arguments = $Func(",
  "      function($f) use (",
  "        $ArrayLiteral,",
  "        $Func,",
  "        $caml_call_gen,",
  "        $joo_global_object",
  "      ) {",
  "        print(\"WARNING: caml_js_wrap_meth_callback_arguments is not yet tested\");",
  "        return $Func(",
  "          function() use ($ArrayLiteral, $caml_call_gen, $f, $joo_global_object) {",
  "            return $caml_call_gen(",
  "              $f,",
  "              $ArrayLiteral(",
  "                varray[",
  "                  $joo_global_object->context,",
  "                  $ArrayLiteral(\func_get_args())",
  "                ]",
  "              )",
  "            );",
  "          }",
  "        );",
  "      }",
  "    );",
]);
//Provides: caml_js_wrap_meth_callback_strict const
//Requires: caml_call_gen, raw_array_cons
function caml_js_wrap_meth_callback_strict(arity, f) {
  return function () {
    var n = arguments.length;
    if(n == arity) return caml_call_gen(f, raw_array_cons(arguments,this));
    var args = new Array(arity + 1);
    args[0] = this;
    for (var i = 1; i < n && i <= arity; i++) args[i] = arguments[i];
    return caml_call_gen(f, args);
  };
}
//Provides: caml_js_wrap_meth_callback_strict const
//Requires: ArrayLiteral,Func,caml_call_gen,raw_array_cons
//ForBackend: php
var caml_js_wrap_meth_callback_strict = raw_backend([
  "    $caml_js_wrap_meth_callback_strict = $Func(",
  "      function($arity, $f) use (",
  "        $ArrayLiteral,",
  "        $Func,",
  "        $caml_call_gen,",
  "        $joo_global_object",
  "      ) {",
  "        print(\"WARNING: caml_js_wrap_meth_callback_strict is not yet tested\");",
  "        return $Func(",
  "          function() use (",
  "            $ArrayLiteral,",
  "            $arity,",
  "            $caml_call_gen,",
  "            $f,",
  "            $joo_global_object",
  "          ) {",
  "            $func_args = \func_get_args();",
  "            $n = PHP\count($func_args);",
  "            $args = varray[$joo_global_object->context];",
  "            if ($n === $arity) {",
  "              $args = PHP\array_merge($args, $func_args);",
  "            } else {",
  "              for ($i = 1; $i < $n && $i <= $arity; $i++) {",
  "                $args[$i] = $func_args[$i];",
  "              }",
  "            }",
  "            return $caml_call_gen($f, $ArrayLiteral($args));",
  "          }",
  "        );",
  "      }",
  "    );",
]);
//Provides: caml_js_wrap_meth_callback_unsafe const (const)
//Requires: caml_call_gen,raw_array_cons
function caml_js_wrap_meth_callback_unsafe(f) {
  return function () { f.apply(null, raw_array_cons(arguments,this)); }
}
//Provides: caml_js_wrap_meth_callback_unsafe const (const)
//Requires: ArrayLiteral, Func, raw_array_cons
//ForBackend: php
var caml_js_wrap_meth_callback_unsafe = raw_backend([
  "    $caml_js_wrap_meth_callback_unsafe = $Func(",
  "      function($f) use (",
  "        $ArrayLiteral,",
  "        $Func,",
  "        $joo_global_object,",
  "        $raw_array_cons",
  "      ) {",
  "        print(\"WARNING: caml_js_wrap_meth_callback_unsafe is not yet tested\");",
  "        return $Func(",
  "          function() use (",
  "            $ArrayLiteral,",
  "            $f,",
  "            $joo_global_object,",
  "            $raw_array_cons",
  "          ) {",
  "            $f->apply(",
  "              varray[],",
  "              $raw_array_cons(",
  "                $ArrayLiteral(\func_get_args()),",
  "                $joo_global_object->context",
  "              )",
  "            );",
  "          }",
  "        );",
  "      }",
  "    );",
]);
//Provides: caml_js_equals mutable (const, const)
function caml_js_equals (x, y) { return +(x == y); }
//Provides: caml_js_to_byte_string const
//Requires: caml_new_string
function caml_js_to_byte_string (s) {return caml_new_string (s);}

//Provides: caml_js_eval_string (const)
//Requires: MlBytes, eval
function caml_js_eval_string (s) {return eval(s.toString());}

//Provides: caml_js_expr (const)
//Requires: js_print_stderr
//Requires: MlBytes, eval
function caml_js_expr(s) {
  js_print_stderr("caml_js_expr: fallback to runtime evaluation");
  return eval(s.toString());}

//Provides: caml_js_raw_expr (const)
//Requires: js_print_stderr
//Requires: MlBytes, eval
function caml_js_raw_expr(s) {
  js_print_stderr(
    "caml_js_raw_expr: This should never happen - all raw code must be directly supplied to caml_js_raw_expr."
  );
  return eval(s.toString());}

//Provides: caml_pure_js_expr const (const)
//Requires: js_print_stderr
//Requires: MlBytes, eval
function caml_pure_js_expr (s){
  js_print_stderr("caml_pure_js_expr: fallback to runtime evaluation");
  return eval(s.toString());}

//Provides: caml_js_object (object_literal)
//Requires: MlBytes
function caml_js_object (a) {
  var o = {};
  for (var i = 1; i < a.length; i++) {
    var p = a[i];
    o[p[1].toString()] = p[2];
  }
  return o;
}


//Provides: caml_js_export_var
function caml_js_export_var (){
  if(typeof module !== 'undefined' && module && module.exports)
    return module.exports
  else
    return joo_global_object;
}

//Provides: eval
//ForBackend: js
var eval = raw_backend([
  "  // Uses eval"
]);

//Provides: eval
//ForBackend: php
var eval = raw_backend([
  "  $eval = function($str){throw new \ErrorException(\"Eval not supported\");};"
]);
