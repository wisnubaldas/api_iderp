
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SAL211B1 extends CI_Model {
public $q;
public function __construct()
{
    parent::__construct();
}

public function days_penjualan($date,$sj = null,$kd = null)
{
    $this->q = "SELECT
    SAL211B1.JHDH_C AS SJ,
    SAL211B1.SYSXZSJ_D AS TGL,
    SAL211B1.JHSL_N AS JUAL,
    SAL211B1.DDDJ_N AS HARGA,
    SAL211B1.LPDH_C AS KODE_BARANG, *
    FROM SAL211B1";
    // set kalo nyari sj aja
    if($date == 'ALL' && $sj && $kd == null)
    {
        $this->q .= " WHERE SAL211B1.JHDH_C = '{$sj}'";
        return $this->db->query($this->q);
    }

    if($date == 'ALL' && $sj == 'ALL' && $kd)
    {
        $this->q .= " WHERE LPDH_C = '{$kd}'";
        return $this->db->query($this->q);
    }

    // kalo date di set aja
    $explode = explode('-',$date);
    if(count($explode) == 3)
    {
        $this->q .= " WHERE YEAR(SYSXZSJ_D)={$explode[0]} AND MONTH(SYSXZSJ_D)={$explode[1]} AND DAY(SYSXZSJ_D) = {$explode[2]}";
        if($sj)
        {
            $this->q .= " AND SAL211B1.JHDH_C = '{$sj}'";
        }

        return $this->db->query($this->q);
    }else{
        return null;
    }
   
}

}

/* End of file SAL211B1.php */

 // $query = $this->db->query('SELECT TOP 2 A.BARANG, 
        //                                     A.TGL, 
        //                                     SUM(A.JUAL - A.RETUR) AS NET, 
        //                                     SUM(A.THARGA - A.TRETUR - ((A.JUAL - A.RETUR) * A.MODAL)) AS PROFIT 
        //                                     FROM(SELECT SAL211B1.JHDH_C AS SJ, 
        //                                         SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3) AS BARANG, 
        //                                         LEFT(CONVERT(VARCHAR, SAL211B1.SYSXZSJ_D, 23), 7) AS TGL, 
        //                                         SAL211B1.JHSL_N AS JUAL, 
        //                                         DDDJ_N AS HARGA, 
        //                                         MODAL = CASE RIGHT(REPLACE(SAL211B1.LPDH_C, \' \', \'\'), 1) WHEN \'P\' THEN ISNULL(
        //                                                                             (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) WHEN \'1\' THEN ISNULL(
        //                                                                                 (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) WHEN \'2\' THEN ISNULL(
        //                                                                                     (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) WHEN \'3\' THEN ISNULL(
        //                                                                                         (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) WHEN \'4\' THEN ISNULL(
        //                                                                                             (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) WHEN \'5\' THEN ISNULL(
        //                                                                                                 (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) WHEN \'6\' THEN ISNULL(
        //                                                                                                     (SELECT PRP101S2.CB01_N FROM PRP101S2 WHERE PRP101S2.BJLB_C=SUBSTRING(SAL211B1.LPDH_C, 4, 6)+\'.\'+SUBSTRING(SAL211B1.LPDH_C, 11, 3)), 0) ELSE 0 END, ZHJE_N AS THARGA, ISNULL(
        //                                                                                                         (SELECT SAL221B1.STSL_N FROM SAL221B1 WHERE SAL221B1.JHDH_C = SAL211B1.JHDH_C AND SAL221B1.LPDH_C = SAL211B1.LPDH_C), 0) AS RETUR, ISNULL(
        //                                                                                                             (SELECT SAL221B1.BBJE_N FROM SAL221B1 WHERE SAL221B1.JHDH_C = SAL211B1.JHDH_C AND SAL221B1.LPDH_C = SAL211B1.LPDH_C), 0) AS TRETUR FROM SAL211B1 
        //                                                                                                                 INNER JOIN SAL101S1 ON SAL211B1.KHDH_C = SAL101S1.KHDH_C WHERE SAL101S1.KHLB_C <> \'PICASSO DEPO\' 
        //                                                                                                                                     AND SAL211B1.KDDM_C NOT IN(\'Y\', \'S\')) AS A GROUP BY A.TGL, A.BARANG');

		
		// SELECT * FROM SAL221B1
		
		// SELECT top 10
		// 			*
		// 		FROM
		// 			PRP101S2
					
		// SELECT top 10 
		// 		KHDH_C,
		// 		KHLB_C
        //         FROM SAL101S1