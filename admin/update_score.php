<?php require_once("admin-header.php");?>
<?php
if ( !( isset( $_SESSION[ $OJ_NAME . '_' . 'administrator' ] ) ) ) {
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit( 1 );
}
if ( isset( $_POST[ 'do' ] ) ) {
	require_once( "../include/check_post_key.php" );
	$user_id = $_POST[ 'user_id' ];
	$rightstr = $_POST[ 'rightstr' ];
	if ( isset( $_POST[ 'contest' ] ) )$rightstr = "c$rightstr";
	$sql = "insert into `privilege` values(?,?,'N')";
	$rows = pdo_query( $sql, $user_id, $rightstr );
	echo "$user_id $rightstr added!";
}
?>
<?php
$sql = "SELECT sum(difficulty) as score1,user_id from (SELECT distinct `difficulty`,`user_id`, problem.problem_id from `problem` right join `solution` on problem.problem_id=solution.problem_id and `result`=4 and contest_id is null) a group by user_id;";
$result = pdo_query( $sql );
$num = 0;
echo("刷题AC得分:<br>");
foreach ( $result as $row ) {
//	echo( $row[ 'user_id' ].":".$row[ 'score1' ]."<br>" );
	$num++;
}
/*
class TM {
	var $solved = 0;
	var $time = 0;
	var $p_wa_num;
	var $p_ac_sec;
	var $p_pass_rate;
	var $user_id;
	var $nick;
	var $total;

	function TM() {
		$this->solved = 0;
		$this->time = 0;
		$this->p_wa_num = array( 0 );
		$this->p_ac_sec = array( 0 );
		$this->p_pass_rate = array( 0 );
		$this->total = 0;
	}

	function Add( $pid, $sec, $res ) {
		//              echo "Add $pid $sec $res<br>";
		if ( isset( $this->p_ac_sec[ $pid ] ) && $this->p_ac_sec[ $pid ] > 0 )
			return;
		if ( $res * 100 < 99 ) {
			if ( isset( $this->p_pass_rate[ $pid ] ) ) {
				if ( $res > $this->p_pass_rate[ $pid ] ) {
					$this->total -= $this->p_pass_rate[ $pid ] * 100;
					$this->p_pass_rate[ $pid ] = $res;
					$this->total += $this->p_pass_rate[ $pid ] * 100;
				}
			} else {
				$this->p_pass_rate[ $pid ] = $res;
				$this->total += $res * 100;
			}
			if ( isset( $this->p_wa_num[ $pid ] ) ) {
				$this->p_wa_num[ $pid ]++;
			} else {
				$this->p_wa_num[ $pid ] = 1;
			}

		} else {
			$this->p_ac_sec[ $pid ] = $sec;
			$this->solved++;
			if ( !isset( $this->p_wa_num[ $pid ] ) )$this->p_wa_num[ $pid ] = 0;
			if ( isset( $this->p_pass_rate[ $pid ] ) )$this->total -= $this->p_pass_rate[ $pid ] * 100;
			$this->total += 100;
			$this->time += $sec + $this->p_wa_num[ $pid ] * 1200;
			//                      echo "Time:".$this->time."<br>";
			//                      echo "Solved:".$this->solved."<br>";
		}
	}
}

function s_cmp( $A, $B ) {
	//      echo "Cmp....<br>";
	if ( $A->total != $B->total ) return $A->total < $B->total;
	else {
		if ( $A->solved != $B->solved )
			return $A->solved < $B->solved;
		else
			return $A->time > $B->time;
	}
}

$sql = "SELECT contest_id from contest";
$result1 = pdo_query( $sql );
echo( "所有比赛编号及积分阶段汇总<br>" );
foreach ( $result1 as $row1 ) {
	echo( $row1[ 'contest_id' ] . "<br>" );
	$sql = "SELECT
        users.user_id,users.nick,solution.result,solution.num,solution.in_date,solution.pass_rate
                FROM
                        (select * from solution where solution.contest_id=? and num>=0 and problem_id>0) solution
                inner join users
                on users.user_id=solution.user_id and users.defunct='N'
        ORDER BY users.user_id,in_date";
	$result2 = pdo_query( $sql, $row1[ 'contest_id' ] );
	if ( $result2 )$rows_cnt = count( $result2 );
	else $rows_cnt = 0;
	$user_cnt = 0;
	$user_name = '';
	$U = array();
	for ( $i = 0; $i < $rows_cnt; $i++ ) {

		$row = $result2[ $i ];


		$n_user = $row[ 'user_id' ];
		if ( strcmp( $user_name, $n_user ) ) {
			$user_cnt++;
			$U[ $user_cnt ] = new TM();

			$U[ $user_cnt ]->user_id = $row[ 'user_id' ];
			$U[ $user_cnt ]->nick = $row[ 'nick' ];

			$user_name = $n_user;
		}
		if ( $row[ 'result' ] != 4 && $row[ 'pass_rate' ] >= 0.99 )$row[ 'pass_rate' ] = 0;
		if ( time() < $end_time && $lock < strtotime( $row[ 'in_date' ] ) )
			$U[ $user_cnt ]->Add( $row[ 'num' ], strtotime( $row[ 'in_date' ] ) - $start_time, 0 );
		else
			$U[ $user_cnt ]->Add( $row[ 'num' ], strtotime( $row[ 'in_date' ] ) - $start_time, $row[ 'pass_rate' ] );

	}
	usort( $U, "s_cmp" );

	for ( $i = 0; $i < $rows_cnt; $i++ ) {
		for ( $i = 0; $i < $num; $i++ ) {
			if ( $U[ $i ]->user_id == $result[ $i ][ 'user_id' ] ) {
				$result[ $i ][ 'score1' ] = $result[ $i ][ 'score1' ] + $rows_cnt - 1 - $i;
			}
		}
	}
	foreach ( $result as $row2 ) {
		echo( $row2[ 'user_id' ] . ":" );
		echo( $row2[ 'score1' ] . "<br>" );
	}
}*/
echo( "最后输入数据库<br>" );
foreach ( $result as $row ) {
	$sql = "select `otherscore` from users WHERE `user_id`=?";
	$temp = pdo_query( $sql, $row[ 'user_id' ] );
	foreach ( $temp as $row3 ) {
		echo("外部比赛活动的积分:".$row[ 'user_id' ].":".$row3[ 'otherscore' ] . "<br>" );
		$sql = "UPDATE `users` SET `score`=? WHERE `user_id`=?";
		$row3[ 'otherscore' ]= $row3[ 'otherscore' ] + $row[ 'score1' ];
		$result3 = pdo_query( $sql, $row3[ 'otherscore' ], $row[ 'user_id' ] );
		echo( "最后汇总:".$row[ 'user_id' ] . ":" );
		echo( $row3[ 'otherscore' ]. "<br>" );
	}

}
?>
