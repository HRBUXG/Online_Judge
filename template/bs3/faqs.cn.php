<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <hr>
        <center>
            <font size="+3"><?php echo $OJ_NAME ?> Online Judge FAQ</font>
        </center>
        <hr>
        <p><font color=green>Q</font>:这个在线裁判系统使用什么样的编译器和编译选项?<br>
            <font color=red>A</font>:系统运行于<a href="http://www.debian.org/">Debian</a>/<a href="http://www.ubuntu.com">Ubuntu</a>
            Linux. 使用<a href="http://gcc.gnu.org/">GNU GCC/G++</a> 作为C/C++编译器,
            <a href="http://www.freepascal.org">Free Pascal</a> 作为pascal 编译器 ，用
            <a href="http://openjdk.java.net/">openjdk-7</a> 编译 Java. 对应的编译选项如下:<br>
        </p>
        <table border="1" align="center">
            <tr>
                <td>C:</td>
                <td><font color=blue>gcc Main.c -o Main -fno-asm -Wall -lm --static -std=c99 -DONLINE_JUDGE</font>
                    <pre>#pragma GCC optimize ("O2")</pre>
                    可以手工开启O2优化
                </td>
            </tr>
            <tr>
                <td>C++:</td>
                <td><font color=blue>g++ -fno-asm -Wall -lm --static -std=c++11 -DONLINE_JUDGE -o Main Main.cc</font>
                </td>
            </tr>
            <tr>
                <td>Pascal:</td>
                <td><font color=blue>fpc Main.pas -oMain -O1 -Co -Cr -Ct -Ci </font></td>
            </tr>
            <tr>
                <td>Java:</td>
                <td><font color="blue">javac -J-Xms32m -J-Xmx256m Main.java</font>
                    <br>
                    <font size="-1" color="red">*Java has 2 more seconds and 512M more memory when running and
                        judging.</font>
                </td>
            </tr>
        </table>
        <p> 编译器版本为（系统可能升级编译器版本，这里仅供参考）:<br>
            <font color=blue>gcc version 4.8.4 (Ubuntu 4.8.4-2ubuntu1~14.04.3)</font><br>
            <font color=blue>glibc 2.19</font><br>
            <font color=blue>Free Pascal Compiler version 2.6.2<br>
                openjdk 1.7.0_151<br>
            </font></p>
        <hr>
        <p><font color=green>Q</font>:程序怎样取得输入、进行输出?<br>
            <font color=red>A</font>:你的程序应该从标准输入 stdin('Standard Input')获取输入，并将结果输出到标准输出 stdout('Standard
            Output').例如,在C语言可以使用 'scanf' ，在C++可以使用'cin' 进行输入；在C使用 'printf' ，在C++使用'cout'进行输出.</p>
        <p>用户程序不允许直接读写文件, 如果这样做可能会判为运行时错误 "<font color=green>Runtime Error</font>"。<br>
        <p>注意:本OJ系统采用ACM评测标准，<span style="color:red;font-weight:bold">题目如果包含多组测试数据 需使用多组测试的方式</span></p>
        下面是输出a+b的参考样例</p>
        <p> C++:
        </p>
        <pre><font color="blue">
#include &lt;iostream&gt;
using namespace std;
int main(){
    int a,b;
    while(cin >> a >> b)
        cout << a+b << endl;
    return 0;
}
</font></pre>
        <p>C:</p>
        <pre><font color="blue">
#include &lt;stdio.h&gt;
int main(){
    int a,b;
    while(scanf("%d %d",&amp;a, &amp;b) != EOF)
        printf("%d\n",a+b);
    return 0;
}
</font></pre>
        <p> PASCAL:</p>
        <pre><font color="blue">
program p1001(Input,Output); 
var 
  a,b:Integer; 
begin 
   while not eof(Input) do 
     begin 
       Readln(a,b); 
       Writeln(a+b); 
     end; 
end.
</font></pre>
        <br>

        <p>Java:</p>
        <pre><font color="blue">
import java.util.*;
public class Main{
	public static void main(String args[]){
		Scanner cin = new Scanner(System.in);
		int a, b;
		while (cin.hasNext()){
			a = cin.nextInt(); b = cin.nextInt();
			System.out.println(a + b);
		}
	}
}</font></pre>

        <hr>
        <p>
            <font color=green>Q</font>:为什么我的程序在自己的电脑上正常编译，而系统告诉我编译错误!<br>
            <font color=red>A</font>:GCC的编译标准与VC6有些不同，更加符合c/c++标准:<br>
        <ul>
            <li><font color=blue>main</font> 函数必须返回<font color=blue>int</font>, <font color=blue>void main</font>
                的函数声明会报编译错误。<br>
            <li><font color=green>i</font> 在循环外失去定义 "<font color=blue>for</font>(<font color=blue>int</font> <font
                        color=green>i</font>=0...){...}"<br>
            <li><font color=green>itoa</font> 不是ansi标准函数.<br>
            <li><font color=green>__int64</font> 不是ANSI标准定义，只能在VC使用, 但是可以使用<font color=blue>long long</font>声明64位整数。<br>如果用了__int64,试试提交前加一句#define
                __int64 long long, scanf和printf 请使用%lld作为格式
        </ul>
        </p>
        <hr>
        <p>
            <font color=green>Q</font>:当你提交的程序被Online Judge评判完毕后，你可以在“Status”页看到评判结果。系统返回信息都是什么意思?<br>
            <font color=red>A</font>:常见的Online Judge将评判结果分为如下几类：:<br></p>
        <p><font color=blue>Pending</font> : 我们正在运行你的程序进行测试，请稍候。 </p>
        <p><font color=blue>Pending Rejudge</font>: 因为数据更新或其他原因，系统将重新判你的答案.</p>
        <p><font color=blue>Compiling</font> : 正在编译.<br>
        </p>
        <p><font color="blue">Running &amp; Judging</font>: 正在运行和判断.<br>
        </p>
        <p><font color=blue>Accepted</font> : 程序的输出完全满足题意，通过了全部的测试数据的测试。<br>
            <br>
            <font color=blue>Presentation Error</font>
            :你的程序输出的答案是正确的，但输出格式不对，比如多写或者少写了一些空格、换行。请注意，大部分程序的输出，都要求最终输出一个换行。不过，计算机程序是很难准确判断PE错误的，所以，很多PE错误都会被评判成WA。<br>
            <br>
            <font color=blue>Compile Error</font> : 你的程序没有通过编译。你可以点击文>字上的链接，查看详细的出错信息，对照此信息，可以找出出错原因。有可能你提交时选择
            的代码语言正确。<br>
            <br>

            <font color=blue>Wrong Answer</font> :
            你的程序顺利地运行完毕并正常退出，但是输出的结果却是错误的。注意：有的题包含多组测试数据，你的程序只要有一组数据是错误的，结果就是WA。<br>
            <br>
            <font color=blue>Time Limit Exceeded</font> :
            运行超出时间限制，检查下是否有死循环，或者应该有更快的计算方法。注意：TLE并不能说明你的程序的运行结果是对还是错，只能说明你的程序用了太多的时间。<br>
            <br>
            <font color=blue>Memory Limit Exceeded</font> :
            超出内存限制，数据可能需要压缩，检查内存是否有泄露。你的程序运行时使用的内存，超过了该题规定的最大限制，或者你的程序申请内存失败，你的程序将被Online
            Judge强行终止。注意：MLE并不能说明你的程序的运行结果是对还是错，只能说明你的程序用了或者申请了太多的内存。<br>
            <br>
            <font color=blue>Output Limit Exceeded</font>: 输出超过限制。<br>
            <br>
            <font color=blue>Runtime Error</font> :
            你的程序在运行时出现了错误，并且这个错误导致程序无法进行下一步处理。导致运行时错误的原因有很多种，具体根据实际代码、数据和实际运行环境进行分析。下面是几个常见的原因：<br>
        <p>
            1) 内存访问错误：程序试图读取或者写入内存区域没有访问权限，比如从0地址内存读取或写入数据，数组越界等。<br>
            2) 除零错误：运行时除数为0，会导致这个错误。<br>
            3) 浮点数错误：因为要操作的浮点数太大或者太小导致系统无法表示该浮点数，都会导致这个错误。不同的浮点数类型都有其表示范围大小。<br>
            4) 栈溢出：在调用函数时，函数地址、函数参数、局部变量等信息存储于栈内存，当函数调用层过深时，会出现这个错误，比如递归调用太深。<br>
            5) 如果你写的是Java程序，请务必保证提交的代码中主类名为Main，并且主类中有public static void main(String args[])
            的函数，这个是OJ评测Java程序的入口，否则会出现Runtime Error。
        </p>
        </p>
        <hr>
        <font color=green>Q</font>:如何参加在线比赛?<br>
        <font color=red>A</font>:<a href=registerpage.php>注册</a> 一个帐号，然后就可以练习，点击比赛列表Contests可以看到正在进行的比赛并参加。<br>
        <br>
        <hr>
        <center>
            <font color=green size="+2">其他问题请访问<a href="bbs.php"><?php echo $OJ_NAME ?>论坛系统</a></font>
        </center>
        <hr>
        <center>
            <table width=100% border=0>
                <tr>
                    <td align=right width=65%>
                        <a href="index.php"><font color=red><?php echo $OJ_NAME ?></font></a>
                        <a href="https://github.com/zhblue/hustoj"><font color=red>17.12.01</font></a></td>
                </tr>
            </table>
        </center>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>

</body>
</html>


