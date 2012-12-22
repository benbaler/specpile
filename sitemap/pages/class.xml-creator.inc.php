<?php
class XMLCreator {
	function RYsvKg3BLnSvTb($r2uxsHQ7o, $urls_completed, $Jzvvi5906fScvwvc6H) {
		include KjGb5UkXhbELCFSf . 'class.templates.inc.php';
		$this->parser = new rGJWR_guN ( "pages/" );
		$gnFe1_ACf3THo5fSVT = basename ( $r2uxsHQ7o ['xs_smname'] );
		$this->uurl_p = dirname ( $r2uxsHQ7o ['xs_smurl'] ) . '/';
		$this->furl_p = dirname ( $r2uxsHQ7o ['xs_smname'] ) . '/';
		if ($r2uxsHQ7o ['xs_chlog'])
			$o6tTsvNFXN = $this->t3jvxqdXKF32_lYX ( $gnFe1_ACf3THo5fSVT );
		$WOhaMyP5Ou1gzA6c = $eX2N9ADyfLy6Jg9 = array ();
		$this->fop = $r2uxsHQ7o ['xs_compress'] ? array ('fopen' => 'gzopen', 'fwrite' => 'gzwrite', 'fclose' => 'gzclose' ) : array ('fopen' => 'fopen', 'fwrite' => 'fwrite', 'fclose' => 'fclose' );
		$this->fapp = $r2uxsHQ7o ['xs_compress'] ? '.gz' : '';
		$VQAXwSjJPIxpPDQ5i5S = $this->b6AdG6bCyaYg ( $r2uxsHQ7o, $urls_completed, $WOhaMyP5Ou1gzA6c, $r2uxsHQ7o ['xs_chlog'] );
		if (count ( $VQAXwSjJPIxpPDQ5i5S ) > 1) {
			$xf = $this->I5G2fQwAwsO2 ( $VQAXwSjJPIxpPDQ5i5S );
			array_unshift ( $VQAXwSjJPIxpPDQ5i5S, $this->uurl_p . EpCvw2zEnDD ( $gnFe1_ACf3THo5fSVT, $xf, $this->furl_p, $r2uxsHQ7o ['xs_compress'] ) );
		}
		if ($r2uxsHQ7o ['xs_chlog']) {
			$KLhrN1FulWAW = array_diff ( $WOhaMyP5Ou1gzA6c, $o6tTsvNFXN );
			$YyBIyE8gG1eQSuo = array_diff ( $o6tTsvNFXN, $WOhaMyP5Ou1gzA6c );
			$KLhrN1FulWAW = array_slice ( $KLhrN1FulWAW, 0, 1000 );
			$YyBIyE8gG1eQSuo = array_slice ( $YyBIyE8gG1eQSuo, 0, 1000 );
		}
		$sc_VvX5jelp2 = array_merge ( $Jzvvi5906fScvwvc6H, array ('files' => $VQAXwSjJPIxpPDQ5i5S, 'newurls' => $KLhrN1FulWAW, 'losturls' => $YyBIyE8gG1eQSuo ) );
		$mWZ5i5d3fAL = date ( 'Y-m-d H-i-s' ) . '.log';
		EpCvw2zEnDD ( $mWZ5i5d3fAL, serialize ( $sc_VvX5jelp2 ) );
		$this->M0eXwBBaSXRKO6V ( $gnFe1_ACf3THo5fSVT );
		return $sc_VvX5jelp2;
	}
	
	function OjKgKXqLBpye8PNTf($pf) {
		global $aeUWWdnqzr5WR;
		if (! $pf)
			return;
		$this->fop ['fwrite'] ( $pf, $aeUWWdnqzr5WR [3] );
		$this->fop ['fclose'] ( $pf );
	}
	function rPdX9DzTIyRp6e($pf) {
		global $aeUWWdnqzr5WR;
		$this->fop ['fwrite'] ( $pf, $aeUWWdnqzr5WR [1] );
	}
	function I5G2fQwAwsO2($eX2N9ADyfLy6Jg9) {
		$jHdlUOSOV = "";
		$Dw9SGQigEe = implode ( '', file ( KjGb5UkXhbELCFSf . 'sitemap_index_tpl.xml' ) );
		preg_match ( '#^(.*)%SITEMAPS_LIST_FROM%(.*)%SITEMAPS_LIST_TO%(.*)$#is', $Dw9SGQigEe, $a0mMmHqPDZ );
		for($i = 0; $i < count ( $eX2N9ADyfLy6Jg9 ); $i ++)
			$jHdlUOSOV .= $this->parser->sSxD4RNwg ( $a0mMmHqPDZ [2], array ('URL' => $eX2N9ADyfLy6Jg9 [$i], 'LASTMOD' => date ( 'Y-m-d\TH:i:s+00:00' ) ) );
		return $a0mMmHqPDZ [1] . $jHdlUOSOV . $a0mMmHqPDZ [3];
	}
	function b6AdG6bCyaYg($r2uxsHQ7o, $urls_completed, &$WOhaMyP5Ou1gzA6c, $auVkxxOODzL2) {
		global $aeUWWdnqzr5WR, $RxJr9gI4CwRmPszp, $dF0x3UOdG0EmByvW;
		$Dw9SGQigEe = implode ( '', file ( KjGb5UkXhbELCFSf . 'sitemap_xml_tpl.xml' ) );
		preg_match ( '#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $Dw9SGQigEe, $aeUWWdnqzr5WR );
		
		$aeUWWdnqzr5WR [1] = str_replace ( 'xml-sitemaps', 'xml-sitemaps(' . N6He2nKWL8cY . ')', $aeUWWdnqzr5WR [1] );
		$yeAH4YM6vHfvHevRd = implode ( '', file ( KjGb5UkXhbELCFSf . 'sitemap_ror_tpl.xml' ) );
		preg_match ( '#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $yeAH4YM6vHfvHevRd, $RxJr9gI4CwRmPszp );
		$lRhViUrflh4 = implode ( '', file ( KjGb5UkXhbELCFSf . 'sitemap_base_tpl.xml' ) );
		preg_match ( '#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $lRhViUrflh4, $dF0x3UOdG0EmByvW );
		$ctime = date ( 'Y-m-d H:i:s' );
		$W8VYtvwpvvwLrazVf = 0;
		$gnFe1_ACf3THo5fSVT = basename ( $r2uxsHQ7o ['xs_smname'] );
		$this->mO2zEMptgTr3_9 ( $gnFe1_ACf3THo5fSVT );
		$Fpei00GZKLxgY3rk = get_html_translation_table ( HTML_ENTITIES, ENT_QUOTES );
		foreach ( $Fpei00GZKLxgY3rk as $fSB9ZrUIK4aICK6XAM => $kAiwEsZc1NNHhe9fCyn )
			$Fpei00GZKLxgY3rk [$fSB9ZrUIK4aICK6XAM] = '&#' . ord ( $fSB9ZrUIK4aICK6XAM ) . ';';
		unset ( $Fpei00GZKLxgY3rk ['&'] );
		for($i = 0; $i < 31; $i ++)
			$Fpei00GZKLxgY3rk [chr ( $i )] = '&#' . $i . ';';
		$Fpei00GZKLxgY3rk [chr ( 0 )] = $Fpei00GZKLxgY3rk [chr ( 10 )] = $Fpei00GZKLxgY3rk [chr ( 13 )] = '';
		$eX2N9ADyfLy6Jg9 = array ();
		$pf = 0;
		if ($r2uxsHQ7o ['xs_maketxt'])
			$Am1CLOE5I = $this->fop ['fopen'] ( K3D58WhS_Kbefnm . $this->fapp, 'w' );
		if ($r2uxsHQ7o ['xs_makeror']) {
			$eA1uPQAzcVCQ8 = fopen ( QYWCGBQX7GggVu4, 'w' );
			$rc = str_replace ( '%INIT_URL%', $r2uxsHQ7o ['xs_initurl'], $RxJr9gI4CwRmPszp [1] );
			fwrite ( $eA1uPQAzcVCQ8, $rc );
		}
		if (0 && $r2uxsHQ7o ['xs_makebase']) {
			$O35084VCZZWtq831QK = $this->fop ['fopen'] ( PkfyLzw4OGa . $this->fapp, 'w' );
			$rc = str_replace ( '%INIT_URL%', $r2uxsHQ7o ['xs_initurl'], $dF0x3UOdG0EmByvW [1] );
			$this->fop ['fwrite'] ( $O35084VCZZWtq831QK, $rc );
		}
		$DetHfLuiy2rm = $r2uxsHQ7o ['xs_sm_size'] ? $r2uxsHQ7o ['xs_sm_size'] : 50000;
		for($i = 0; $i < count ( $urls_completed ); $i ++) {
			if (($i % $DetHfLuiy2rm) == 0) {
				$YU8s83esIfxy544ZH = (count ( $urls_completed ) > $DetHfLuiy2rm ? Z4L1ygR2lvr3j2UGWEK ( count ( $eX2N9ADyfLy6Jg9 ) + 1, $gnFe1_ACf3THo5fSVT ) : $gnFe1_ACf3THo5fSVT) . $this->fapp;
				$eX2N9ADyfLy6Jg9 [] = $this->uurl_p . $YU8s83esIfxy544ZH;
				$this->OjKgKXqLBpye8PNTf ( $pf );
				$pf = $this->fop ['fopen'] ( $this->furl_p . $YU8s83esIfxy544ZH, 'w' );
				$this->rPdX9DzTIyRp6e ( $pf );
			}
			$cu = &$urls_completed [$i];
			$l = $cu ['link'];
			
			$l = strtr ( $l, $Fpei00GZKLxgY3rk );
			
			$l = preg_replace ( "/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,4};)/", "&amp;", $l );
			$t = str_replace ( "&", "&amp;", $cu ['t'] );
			$d = $cu ['d'] ? $cu ['d'] : $cu ['t'];
			$d = str_replace ( "&", "&amp;", $d );
			
			if (function_exists ( 'utf8_encode' )) {
				if (! function_exists ( 'mb_detect_encoding' ) || (mb_detect_encoding ( $d ) != 'UTF-8')) {
					$t = utf8_encode ( $t );
					$d = utf8_encode ( $d );
				}
				$l = utf8_encode ( $l );
			}
			$cu ['link'] = $l;
			if ($auVkxxOODzL2)
				$WOhaMyP5Ou1gzA6c [] = $l;
			$uCIu22Zx7O4C0vkg_ = '';
			if ($cu ['clm'])
				$uCIu22Zx7O4C0vkg_ = $cu ['clm'];
			else
				switch ($r2uxsHQ7o ['xs_lastmod']) {
					case 1 :
						$uCIu22Zx7O4C0vkg_ = $cu ['lm'] ? $cu ['lm'] : $ctime;
						break;
					case 2 :
						$uCIu22Zx7O4C0vkg_ = $ctime;
						break;
					case 3 :
						$uCIu22Zx7O4C0vkg_ = $r2uxsHQ7o ['xs_lastmodtime'];
						break;
				}
			if ($cu ['p'])
				$p = $cu ['p'];
			else {
				$p = $r2uxsHQ7o ['xs_priority'];
				if ($r2uxsHQ7o ['xs_autopriority'])
					$p = @number_format ( $p * pow ( $r2uxsHQ7o ['xs_descpriority'] ? $r2uxsHQ7o ['xs_descpriority'] : 0.8, $cu ['o'] ), 2 );
			}
			if ($uCIu22Zx7O4C0vkg_) {
				$uCIu22Zx7O4C0vkg_ = strtotime ( $uCIu22Zx7O4C0vkg_ );
				$uCIu22Zx7O4C0vkg_ = date ( 'Y-m-d\TH:i:s+00:00', $uCIu22Zx7O4C0vkg_ );
			}
			$f = $cu ['f'] ? $cu ['f'] : $r2uxsHQ7o ['xs_freq'];
			$tKVE8xlfmzSWy = array ('URL' => $l, 'TITLE' => $t, 'DESC' => $d, 'PERIOD' => $f, 'LASTMOD' => $uCIu22Zx7O4C0vkg_, 'PRIORITY' => $p );
			$this->fop ['fwrite'] ( $pf, $this->parser->sSxD4RNwg ( $aeUWWdnqzr5WR [2], $tKVE8xlfmzSWy ) );
			if ($r2uxsHQ7o ['xs_makeror'])
				fwrite ( $eA1uPQAzcVCQ8, $this->parser->sSxD4RNwg ( $RxJr9gI4CwRmPszp [2], $tKVE8xlfmzSWy ) );
			if ($r2uxsHQ7o ['xs_makebase'])
				$this->fop ['fwrite'] ( $O35084VCZZWtq831QK, $this->parser->sSxD4RNwg ( $dF0x3UOdG0EmByvW [2], $tKVE8xlfmzSWy ) );
			if ($r2uxsHQ7o ['xs_maketxt'])
				$this->fop ['fwrite'] ( $Am1CLOE5I, $cu ['link'] . "\n" );
		}
		$this->OjKgKXqLBpye8PNTf ( $pf );
		if ($r2uxsHQ7o ['xs_maketxt'])
			$this->fop ['fclose'] ( $Am1CLOE5I );
		if ($r2uxsHQ7o ['xs_makeror']) {
			fwrite ( $eA1uPQAzcVCQ8, $RxJr9gI4CwRmPszp [3] );
			fclose ( $eA1uPQAzcVCQ8 );
		}
		if ($r2uxsHQ7o ['xs_makebase']) {
			$this->fop ['fwrite'] ( $O35084VCZZWtq831QK, $dF0x3UOdG0EmByvW [3] );
			$this->fop ['fclose'] ( $O35084VCZZWtq831QK );
		}
		return $eX2N9ADyfLy6Jg9;
	}
	function mO2zEMptgTr3_9($gnFe1_ACf3THo5fSVT) {
		for($i = 0; file_exists ( $sf = tuhOqyefnq6RVW . Z4L1ygR2lvr3j2UGWEK ( $i, $gnFe1_ACf3THo5fSVT ) . $this->fapp ); $i ++) {
			unlink ( $sf );
		}
	}
	function M0eXwBBaSXRKO6V($gnFe1_ACf3THo5fSVT) {
		for($i = 0; file_exists ( $this->furl_p . ($sf = Z4L1ygR2lvr3j2UGWEK ( $i, $gnFe1_ACf3THo5fSVT ) . $this->fapp) ); $i ++) {
			copy ( $this->furl_p . $sf, tuhOqyefnq6RVW . $sf );
		}
	}
	function t3jvxqdXKF32_lYX($gnFe1_ACf3THo5fSVT) {
		$cn = '';
		for($i = 0; file_exists ( $sf = tuhOqyefnq6RVW . Z4L1ygR2lvr3j2UGWEK ( $i, $gnFe1_ACf3THo5fSVT ) . $this->fapp ); $i ++) {
			
			$cn .= $this->fapp ? implode ( '', gzfile ( $sf ) ) : s3wnrrYJ6M1Xfb6_g ( $sf );
		}
		preg_match_all ( '#<loc>(.*?)</loc>#', $cn, $um );
		return $um [1];
	}
}
$JnjWLFycu = new XMLCreator ( );
?>