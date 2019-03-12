<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=2.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Login</title>
    <?php include("../../template/$OJ_TEMPLATE/js.php"); ?>
    <style>
        body {
            padding: 0;
            margin: 0;
            background: #F7FAFC;
        }

        a {
            text-decoration: none;
        }

        .index-box {
            width: 100%;
            height: auto;
            margin: 0 auto;
            margin-top: 100px;
        }

        .index-header {
            width: 100%;
            height: 100px;
        }

        .title {
            font-size: 50px;
            text-align: center;
            color: #E6E6FA;
            font-weight: bold;
            margin: 30px auto;
        }

        .index-body {
            width: 400px;
            text-align: center;
            margin-left: 35%;
        }

        .nav-sliders > a {
            font-size: 20px;
            display: inline-block;
            width: 60px;
            font-family: "微软雅黑";
            color: #999;
            cursor: pointer;
            float: left;
        }

        .nav-sliders > a.active {
            color: #0f88eb;
        }

        .nav-sliders > span {
            position: absolute;
            height: 2px;
            background: #0f88eb;
            display: block;
            left: 5px;
            width: 50px;
            bottom: -8px;
        }

        .stage {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: url(./image/star.jpg);
        }

        .login-box {
            width: 300px;
        }

        .wrap {
            border: 1px solid #d5d5d5;
            border-radius: 5px;
            background: #ffffff;
            margin-top: 30px;
            height: 50px;
        }

        .wrap > div {
            position: relative;
            overflow: hidden;
        }

        .wrap > div > input {
            width: 95%;
            border: none;
            padding: 17px 2.5%;
            border-radius: 5px;
        }

        .wrap > div > label.error {
            position: absolute;
            color: #c33;
            top: 0;
            line-height: 50px;
            transform: translate(25px, 0);
            transition: all 0.5s ease-out;
            -webkit-transform: translate(25px, 0);
            -moz-transform: translate(25px, 0);
            opacity: 0;
            visibility: hidden;
            cursor: text;
        }

        .wrap > div > label.move {
            transform: translate(0, 0);
            transition: all 0.5s ease-out;
            -webkit-transform: translate(0, 0);
            -moz-transform: translate(0, 0);
            opacity: 1;
            visibility: visible;
        }

        /*.password {*/
        /*border-top: solid 1px #d5d5d5;*/
        /*}*/

        .code {
            right: 115px;
        }

        .name {
            right: 5px;
        }

        .loginName {
            right: 5px;
        }

        .loginPass {
            right: 5px;
        }

        .pass {
            right: 5px;
        }

        .passagain {
            right: 5px;
        }

        .button {
            width: 100px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-family: "Times New Roman";
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        #btn_register {
            margin-top: 40px;
            margin-left: 60px;
            background: #0f88eb;
        }

        #btn_login {
            background: #13b85c;
            margin-top: 40px;
            margin-left: 250px;
        }

        #btn_login_register {
            background: #13b85c;
            margin-top: 30px;
        }

        .remember {
            text-align: left;
            margin-left: 58.5%;
            margin-top: -12%;
            font-family: "Times New Roman";
            color: rgba(255, 255, 255, 0);
        }

        .remember > a {
            float: left;
            text-decoration: none;
        }

        a.a1 {
            color: #E6E6FA;
            font-weight: bold
        }

        a.a1:hover {
            color: #fdff2f;
        }

        .other > span {
            font-size: 14px;
            float: left;
            margin-top: 2px;
            cursor: pointer;
        }

        .other > div {
            float: left;
            transition: all 1s ease-in;
            -webkit-transition: all 0.3s ease-in;
            opacity: 0;
            transform: translateX(-20px);
            -webkit-transform: translateX(-18px);
            -moz-transform: translateX(-18px);
            visibility: hidden;
        }

        .other > div > a {
            margin-left: 20px;
            color: #666666;
            font-size: 15px;
        }

        .other > .hidden {
            transition: all 1s ease-in;
            display: block;
            -webkit-transition: all 0.3s ease-in;
            opacity: 1;
            transform: translateX(0);
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
            visibility: visible;
        }

        .download > .close {
            display: none;
        }

        .download .pic {
            display: none;
            position: absolute;
            background: #fff;
            bottom: 78px;
            width: 310px;
            left: -10px;
            z-index: 5;
            padding: 40px 0;
            border-radius: 8px;
            box-shadow: 0 0 8px 0 rgba(0, 0, 0, .15);
        }

        .registered-box {
            width: 300px;
            display: none;
        }

        .text > a {
            color: #0f88eb;
        }

        .verification-code {
            position: absolute;
            right: 22px;
            top: 14px;
            font-family: "微软雅黑";
            font-size: 18px;
            cursor: pointer;
        }

        #register:hover {
            opacity: 0.7;
        }

        input {
            outline: none;
        }
    </style>
</head>
<body>
<div class="index-box" style="z-index:9999;position:relative">
    <div class="index-header" style="width: 100%">
        <h1 class="title" style="padding-left: 10px;">Welcome To HRBU Online Judge System</h1>
    </div>
    <div class="index-body">
        <div class="change">

            <!--登录开始-->
            <form id="login" action="login.php" method="post" role="form" onSubmit="return jsMd5();">
                <div class="wrap">
                    <div class="phone" style="height:50px">
                        <input style="font-size: 16px;height: 50px;line-height: 30px;margin:0;padding: 0" type="text"
                               id="username" name='user_id' value=""
                               placeholder="<?php echo $MSG_USER_ID ?>">
                        <label class="error loginName"><?php echo $MSG_USER_ID ?></label>
                    </div>
                </div>
                <div class="wrap">
                    <div class="password" style="height:50px">
                        <input style="font-size: 16px;height: 50px;line-height: 30px;margin:0;padding: 0"
                               type="password" id="password" name='password'
                               placeholder="<?php echo $MSG_PASSWORD ?>">

                        <label class="error loginPass"><?php echo $MSG_PASSWORD ?></label>
                    </div>

                </div>
                <?php if ($OJ_VCODE) { ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo $MSG_VCODE ?></label>
                        <div class="col-sm-3"><input name="vcode" class="form-control" type="text"></div>
                        <div class="col-sm-4"><img id="vcode-img" alt="click to change"
                                                   onclick="this.src='vcode.php?'+Math.random()" height="30px">*
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group" id="login" style="background: transparent">
                    <?php if (isset($OJ_REGISTER) && !($OJ_REGISTER)) {
                        echo "<button id='btn_login' name='submit' type='submit'
                            class='btn btn-info btn-block button'>" . $MSG_LOGIN . "</button>";
                    } else { ?>
                        <?php
                        echo "<button id='btn_login_register' name='submit' type='submit'
                            class='btn btn-info btn-block button'>" . $MSG_LOGIN . "</button>";
                    } ?>
                    <?php if (isset($OJ_REGISTER) && !($OJ_REGISTER)) {

                    } else { ?>
                        <?php
                        echo "<button id='btn_register' name='register' onClick='window.open('../../registerpage.php')'
                            class='btn btn-info btn-block button'>" . $MSG_REGISTER . "</button>";
                    } ?>
                </div>
            </form>
        </div>
        <!--登录结束-->
    </div>
    <div class="remember" id="forget">
        <a class="btn btn-warning btn-block a1"
           href="lostpassword.php"><?php echo $MSG_LOST_PASSWORD ?></a>
    </div>
</div>

<canvas id="canvas" class="stage" style="z-index:1000"></canvas>
<script src="../../include/md5-min.js"></script>
<script>
    "use strict";
    (function (h, d) {
        var g = typeof d === "string" ? document.querySelector(d) : d, f = g.getBoundingClientRect(), c = f.width,
            l = f.height, n = g.getContext("2d"), j = {x: c / 2, y: l / 2, radius: 180}, k = 40, e = 60, a = [], b;
        g.width = c;
        g.height = l;
        h.raf = h.requestAnimationFrame || webkitRequestAnimationFrame || function (p) {
            return setTimeout(p, 1000 / 60);
        };
        h.caf = h.cancelAnimationFrame || webkitCancelAnimationFrame || function (p) {
            clearTimeout(p);
        };
        Function.prototype.method = function (q, p) {
            return this.prototype[q] = p, this;
        };

        function i(p, r, q) {
            this.x = this.ox = p;
            this.y = this.oy = r;
            this.radius = Math.random() * 1 + 2;
            this.timer = q | 0;
        }

        i.method("draw", function (p, v, r) {
            var s = this.closest, q, u, t = this.getAlpha(r);
            if (t > 0) {
                p.fillStyle = p.strokeStyle = "rgba(156,217,249," + t + ")";
                p.beginPath();
                p.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
                p.closePath();
                p.fill();
                if (s) {
                    q = s.length;
                    while (q--) {
                        u = v[s[q]];
                        p.beginPath();
                        p.moveTo(this.x, this.y);
                        p.lineTo(u.x, u.y);
                        p.stroke();
                    }
                }
            }
            if (this._isMove) {
                this.move();
                return;
            }
            if (this.timer++ === this._moveFrames) {
                this.setMove();
            }
        }).method("setMove", function () {
            this._isMove = true;
            this._frames = Math.random() * 100 + 120;
            this._frame = 0;
            this._tx = this.ox + Math.random() * 100 - 50;
            this._ty = this.oy + Math.random() * 100 - 50;
        }).method("move", function () {
            this.x = this.ease(this._frame++, this.x, this._tx - this.x, this._frames);
            this.y = this.ease(this._frame, this.y, this._ty - this.y, this._frames);
            if (Math.abs(this.x - this._tx) < 0.5 && Math.abs(this.y - this._ty) < 0.5) {
                this._isMove = false;
                this.timer = 0;
            }
        }).method("getAlpha", function (s) {
            var q = this.x - s.x, p = this.y - s.y, u = Math.sqrt(q * q + p * p), t = s.radius;
            return u > t ? 0 : (1 - u / t) * 0.6;
        }).method("ease", function (q, p, s, r) {
            if ((q /= r / 2) < 1) {
                return s / 2 * q * q + p;
            }
            return -s / 2 * ((--q) * (q - 2) - 1) + p;
        }).method("_moveFrames", e);

        function m() {
            var q = Math.max(60, c * 1.5 / k), t = l * 1.5 / q + 0.5 | 0, v, r = 0, s, u, p;
            v = c / q + 0.5 | 0;
            for (; r < t; r++) {
                for (s = 0; s < v; s++) {
                    u = new i(s * q + (Math.random() * q * 2 - q), r * q + (Math.random() * q * 2 - q), Math.random() * e);
                    p = r * v + s;
                    a[p] = u;
                    if (r & 1 && s && 1) {
                        u.closest = [p - 1, p - v, p - v - 1];
                        s < v - 1 && u.closest.push(p + 1);
                        r < t - 1 && u.closest.push(p + v);
                    }
                }
            }
            o();
        }

        function o() {
            n.clearRect(0, 0, c, l);
            a.forEach(function (r, q, p) {
                r.draw(n, p, j);
            });
            b = raf(o);
        }

        g.addEventListener("mousemove", function (p) {
            j.x = p.clientX - f.left;
            j.y = p.clientY - f.top;
        }, false);
        h.addEventListener("resize", function () {
            caf(b);
            a = [];
            f = g.getBoundingClientRect();
            g.width = c = f.width;
            g.height = l = f.height;
            m();
        }, false);
        m();
    })(this, document.querySelector(".stage"));

    function jsMd5() {
        if ($("input[name=password]").val() == "") return false;
        $("input[name=password]").val(hex_md5($("input[name=password]").val()));
        return true;
    }
</script>
<?php if ($OJ_VCODE) { ?>
    <script>
        $(document).ready(function () {
            $("#vcode-img").attr("src", "vcode.php?" + Math.random());
        })
    </script>
<?php } ?>
</body>
</html>

