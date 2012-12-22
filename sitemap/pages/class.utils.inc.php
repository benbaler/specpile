<?php
function Zl5g2LLgy3($SCWLfn0FOY) {
	global $grab_parameters;
	if ($grab_parameters ['xs_dumptype'] == 'serialize')
		return serialize ( $SCWLfn0FOY );
	else
		return var_export ( $SCWLfn0FOY, 1 );
}
function twb3vL6xHv65($SCWLfn0FOY) {
	global $grab_parameters;
	if ($grab_parameters ['xs_dumptype'] == 'serialize')
		$bgOU73TJ7jwvdKa5Vq = unserialize ( $SCWLfn0FOY );
	else
		eval ( $s = '$bgOU73TJ7jwvdKa5Vq = ' . $SCWLfn0FOY . ';' );
	return $bgOU73TJ7jwvdKa5Vq;
}
function Z4L1ygR2lvr3j2UGWEK($i, $gnFe1_ACf3THo5fSVT, $ZW04gbhF9A8P = false) {
	if ($ZW04gbhF9A8P && $i < 2)
		return $gnFe1_ACf3THo5fSVT;
	return $i ? preg_replace ( '#(.*)\.#', '$01' . $i . '.', $gnFe1_ACf3THo5fSVT ) : $gnFe1_ACf3THo5fSVT;
}
function EpCvw2zEnDD($Hl4O6cWdjqldW6, $xnDpYg7WwA0, $exrHBWP15 = tuhOqyefnq6RVW, $m0HngeVPuiULaXDb = false) {
	if ($m0HngeVPuiULaXDb && function_exists ( 'gzencode' )) {
		$cVhR96lmkjBRF = gzencode ( $xnDpYg7WwA0, 1 );
		unset ( $xnDpYg7WwA0 );
		$xnDpYg7WwA0 = $cVhR96lmkjBRF;
		$Hl4O6cWdjqldW6 .= '.gz';
	}
	$pf = fopen ( $exrHBWP15 . $Hl4O6cWdjqldW6, "w" );
	fwrite ( $pf, $xnDpYg7WwA0 );
	fclose ( $pf );
	unset ( $xnDpYg7WwA0 );
	return $Hl4O6cWdjqldW6;
}
function s3wnrrYJ6M1Xfb6_g($Hl4O6cWdjqldW6) {
	return implode ( '', file ( $Hl4O6cWdjqldW6 ) );
}
function pX3Aht4bffp5cql() {
	$AbiyTr9Cb6H08SemlUw = array ();
	$pd = opendir ( tuhOqyefnq6RVW );
	while ( $fn = readdir ( $pd ) )
		if (preg_match ( '#^\d+.*?\.log$#', $fn ))
			$AbiyTr9Cb6H08SemlUw [] = $fn;
	closedir ( $pd );
	sort ( $AbiyTr9Cb6H08SemlUw );
	return $AbiyTr9Cb6H08SemlUw;
}
function h9EmToufL4h9OSGalBd($tm) {
	$tm = intval ( $tm );
	$s = $tm % 60;
	if ($s < 10)
		$s = "0$s";
	$m = intval ( $tm / 60 );
	return "$m:$s";
}
function THw8psPBSVTS($dr) {
	$dr = preg_replace ( '#\?.*#', '', $dr );
	if ($dr [strlen ( $dr ) - 1] != '/' && $dr) {
		$dr = str_replace ( '\\', '/', dirname ( $dr ) );
		if ($dr [strlen ( $dr ) - 1] != '/')
			$dr .= '/';
	}
	return preg_replace ( '#([^/\:]/)/+#', '\\1', $dr );
}
?>