<?php require_once("admin-header.php");
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))&&!(isset($_SESSION[$OJ_NAME.'_'.'problem_editor']))){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
}
?>

<div class="container">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/component.css" />
    </head>

    <form action='problem_export_xml.php' method=post>
        <h2 align="center">Export Problem</h2>

        <hr class="style-two"/><br/>

        <div class="container">

            <section class="content bgcolor-8">
            <span class="input input--isao">
					<input class="input__field input__field--isao" type="text" id="input-38" />
					<label class="input__label input__label--isao" for="input-38" data-content="from pid:">
						<span class="input__label-content input__label-content--isao">from pid:</span>
					</label>
				</span>
                <span class="input input--isao">
					<input class="input__field input__field--isao" type="text" id="input-39" />
					<label class="input__label input__label--isao" for="input-39" data-content="to pid:">
						<span class="input__label-content input__label-content--isao">to pid:</span>
					</label>
				</span>
                <span class="input input--isao">
					<input class="input__field input__field--isao" type="text" id="input-40" />
					<label class="input__label input__label--isao" for="input-40" data-content="or in">
						<span class="input__label-content input__label-content--isao">or in</span>
					</label>
				</span>
            </section>
        </div>

        <br/>
        <input type='hidden' name='do' value='do'>
        <input type=submit name=submit value='Export'  style="background:#3185b9;color:whitesmoke ">
        <input type=submit value='Download' style="background:#3185b9;color:whitesmoke ">
        <?php require_once("../include/set_post_key.php");?>
    </form>
    * from-to will working if empty IN <br>
    * if using IN,from-to will not working.<br>
    * IN can go with "," seperated problem_ids like [1000,1020]
</div>


<script src="../bootstrap/js/classie.js"></script>
<script>
    (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    })();
</script>

<style>
    hr.style-two{/*渐变*/

        width:80%;
        margin:0 auto;
        border: 0;
        height: 4px;
        background: #333;
        background-image: linear-gradient(to right, red, #333, rgb(9, 206, 91));

    }
</style>

