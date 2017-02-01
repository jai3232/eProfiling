<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use app\models\Personal;
use app\models\PersonalBidang;
//use app\models\PersonalPerjawatan;
use app\models\PenilaianProfil;
use app\models\PenilaianMarkah;

use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use dosamigos\chartjs\ChartJs;

/* @var $this yii\web\View */
/* @var $model app\models\BidangInstitut */

$this->params['breadcrumbs'][] = ['label' => 'Laman Laporan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Kembali', 'url' => Url::previous('senarai_bidang_agensi')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-institut-view">
<?php 
$t1 = date("d-m-Y", strtotime($bulan_tahun));
$t1 = date("Y-m-d", strtotime($t1));
$t2 = date("d-m-Y", strtotime($bulan_tahun2));
$t2 = date("Y-m-d", strtotime($t2));
//echo "bulan tahun 1 : ".$t1." bulan tahun 2 : ".$t2;

?>
    <h2>Abiliti Map : Dari <?=$bulan_tahun;?> Hingga <?=$bulan_tahun2; ?></h2>
    <h3> Agensi : <?=$agensi->nama_agensi;?></h3>
    <h3> Bidang : <?=$bidang->nama_bidang;?></h3>

</div> 
<ul class="nav nav-tabs">
  <li class="active"><a href="#view_abiliti" data-toggle="tab">Abiliti Map</a></li>
  <li><a href="#view_summary_personal" data-toggle="tab">Abiliti Map - Summary Personal</a></li>
  <li><a href="#view_summary_ability" data-toggle="tab">Abiliti Map - Summary Abiliti</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="view_abiliti">  
    <?php 
    //print "id_bidang = ".$model->id_bidang." id_agensi_institut : ".$model->id_agensi_institut."<br>";
/*
    $query = PersonalBidang::find()
    	//->select('personal_bidang.*')
    	->leftjoin('personal_perjawatan','personal_bidang.id_personal_perjawatan = personal_perjawatan.id_personal_perjawatan')
    	//->leftjoin('personal','personal_bidang.id_personal = personal.id_personal')
    	->where('personal_bidang.id_bidang='.$model->id_bidang)
    	//->andWhere('personal_bidang.id_bidang='.$model->id_bidang)
    	->andWhere('personal_bidang.is_aktif=1')
    	->andWhere('personal_perjawatan.is_aktif=1')
    	->andWhere('personal_perjawatan.id_agensi_institut='.$model->id_agensi_institut)
    ->all();
 */
    $cari_query = new \yii\db\Query();//tanya jai kenapa shalisa x kuar...samada guna querybuilder atau model
    $cari_query->select('personal_bidang.*,personal_perjawatan.*')
    ->from('personal_bidang')
    ->leftjoin('personal_perjawatan','personal_bidang.id_personal_perjawatan = personal_perjawatan.id_personal_perjawatan')
    //->leftjoin('personal','personal_bidang.id_personal = personal.id_personal')
    ->where('personal_bidang.id_bidang='.$bidang->id_bidang)
    ->andWhere('personal_bidang.is_aktif=1')
    ->andWhere('personal_perjawatan.is_aktif=1')//kalau buang ini shalisa ada
    ->andWhere('personal_perjawatan.id_agensi='.$agensi->id_agensi)//kalau agensi camner?
    ->all();
    $command = $cari_query->createCommand();
    $query = $command->queryAll();
    $bil_personal = count($query);
    
    //Penggantian DLM PM - ambil satu PP sj
    $cari_pp=PenilaianProfil::find()
    ->leftjoin('personal_bidang','personal_bidang.id_personal_bidang = penilaian_profil.id_personal_bidang')
    ->leftjoin('bidang','bidang.id_bidang = personal_bidang.id_bidang')
    ->where(['bidang.id_bidang' => $bidang->id_bidang])
    ->andWhere(['between', 'penilaian_profil.tarikh_penilaian', $t1, $t2 ])//range tarikh
    ->andWhere('personal_bidang.is_aktif=1')
    //->orderBy(['id_penilaian_profil' => SORT_DESC])//maksudnya disini ambil profil penilaian yg latest
    ->one();
    $bil_cari_pp=count($cari_pp);
    /*
    if($bil_pp<1){
    	echo "Tiada Rekod Penilaian";
    	exit;
    }
    */
    

    	
    
    	//cari personal mengikut skor
    	$bil_respondan = 0;
    	$skor45=0;
    	$skor4045=0;
    	$skor3040=0;
    	$skor3=0;
    	$li_p45="";
    	$li_p4045="";
    	$li_p3040="";
    	$li_p3="";
    	
    	//cari abiliti mengikut skor pula
    	$a_skor45=0;
    	$a_skor4045=0;
    	$a_skor3040=0;
    	$a_skor3=0;
    	$li_a45="";
    	$li_a4045="";
    	$li_a3040="";
    	$li_a3="";
    
    	
    if($bil_personal!=0&&$bil_cari_pp>0){//elak error jika tiada rekod personal dalam bidang institut
    
    	$abiliti=PenilaianMarkah::find()
    	->leftjoin('bidang_abiliti','bidang_abiliti.id_bidang_abiliti=penilaian_markah.id_bidang_abiliti')
    	//->leftjoin('bidang_duti','bidang_duti.id_bidang_duti=bidang_abiliti.id_bidang_duti')
    	//->leftjoin('bidang_tier','bidang_tier.id_bidang_tier=bidang_duti.id_bidang_tier')
    	//->leftjoin('bidang','bidang.id_bidang=bidang_tier.id_bidang')
    	->where(['penilaian_markah.id_penilaian_profil' => $cari_pp->id_penilaian_profil])
    	->orderBy(['bidang_abiliti.id_bidang_abiliti' => SORT_DESC])
    	->all();
    	$bil_abiliti = count($abiliti);//utk dptkan bil row----lepas ni bil abiliti ambil dari bil pm yg ada peniliaan......guna distinc() dlm select pm
    	//print "Bil Abiliti = ".$bil_abiliti."<br>";
    	
    $ability_map[0][0]="No";
    $ability_map[0][1]="Importance";
    $ability_map[0][2]="Ability";//bil colom = 0,1,2 + bil nama
    
    //$ability_map[0][3+$bil_personal]="Mean";
    //$ability_map[0][4+$bil_personal]="SD";
    
    $j=0;
    //echo "<br>Test 3 row<br>";//Utk masa depan pertimbangkan jika ada penambahan acl
    /*
    foreach ($abiliti as $acl){
    	$j++;
    	$duti = BidangDuti::find()->where(['id_bidang_duti' => $acl['id_bidang_duti']])->one();//sekarang ni yg paling latest...lepas ni filter tahun
    	$nombor_duti = $duti->nombor_duti;
    	$ability_map[$j][0]=$nombor_duti."-".$acl['nombor_abiliti'];//no = duti-no-abiliti
    	$ability_map[$j][1]=$acl['importance'];
    	$ability_map[$j][2]=$acl['nama_abiliti'];
    	//echo $ability_map[$j][0].$ability_map[$j][1].$ability_map[$j][2]." abiliti_map j = [$j]<br>";
    }
	*/
    foreach ($abiliti as $acl){
    	$j++;
    	$ab=BidangAbiliti::find()->where(['id_bidang_abiliti' => $acl['id_bidang_abiliti']])->one();
    	$duti = BidangDuti::find()->where(['id_bidang_duti' => $ab->id_bidang_duti])->one();//sekarang ni yg paling latest...lepas ni filter tahun
    	$nombor_duti = $duti->nombor_duti;
    	$ability_map[$j][0]=$nombor_duti."-".$ab->nombor_abiliti;//no = duti-no-abiliti
    	$ability_map[$j][1]=$ab->importance;
    	$ability_map[$j][2]=$ab->nama_abiliti;
    	//echo "Abiliti : $nombor_abiliti Nama : $nama_abiliti<br>";
    }
    $ability_map[$j+1][0]="";
    $ability_map[$j+1][1]="";
    $ability_map[$j+1][2]="Jumlah Markah";//row jumlah markah personal
    $ability_map[$j+2][0]="";
    $ability_map[$j+2][1]="";
    $ability_map[$j+2][2]="Purata Markah";//row purata markah personal
    //echo "<br>End 3 row<br>";
    $col = 3;//mula row 0 col 3
    //////////////////////////
    //cari penilaian personal
    foreach ($query as $pb){
    	$row = 0;//nama pd row 0
    	$person = Personal::find()->where(['id_personal' => $pb['id_personal']])->one();
    	
    	//kira umur
    	$no_ic = $person->no_kp;
    	if(strlen($no_ic)<12){
    		$umur = 'E';
    	}else{
    		$tmp_hari = substr($no_ic,4,2);
    		$tmp_bulan = substr($no_ic,2,2);
    		$tmp_tahun = substr($no_ic,0,2);
    		$tmp_tarikh_lahir = $tmp_tahun."-".$tmp_bulan."-".$tmp_hari;;
    		$umur = date_create($tmp_tarikh_lahir)->diff(date_create('today'))->y;
    	}
    	
    	$pp = PenilaianProfil::find()
    	->where(['id_personal_bidang' => $pb['id_personal_bidang']])
    	->andWhere(['between', 'penilaian_profil.tarikh_penilaian', $t1, $t2 ])
    	->orderBy(['tarikh_penilaian' => SORT_DESC])//ambil penilaian terkini jika ada
    	->one();//akan pilih tarikh disini
    	
    	if(isset($pp->tahun_pengalaman)){//Kes ada pengalaman NULL
    		$pengalaman = $pp->tahun_pengalaman;
    	}else{
    		$pengalaman = 0;
    	}
    	 
    	 
    	//$namanic = $person->nama."<br>(KP : ".$person->no_kp.", U : ".$umur.")";
    	$nama = mb_strimwidth($person->nama, 0, 30, '...');//substr($person->nama,0,25);
    	$namanic = $nama."<br>(KP : ".$person->no_kp.", U : ".$umur.", P : ".$pengalaman.")";
    	 $ability_map[0][$col]=$namanic;	//mula [0][3]
    	//$nama->nama akan jadi array [0][2+...]
    	//echo "ID Personal Bidang : ".$pb['id_personal_bidang']." ID Personal : ".$pb['id_personal']." Nama :  ".$ability_map[0][$col]." Bidang : ".$model->id_bidang." <br>";
    	//$idpp = $pp->id_penilaian_profil;
    	
    	$bil_pp=count($pp);
    	//echo "bil pp".$bil_pp."<br>";
    	//$idpp = $pp->id_penilaian_profil;
    	//utk akan datang.....cek....mungkin bil acl > pen markah...so yg xde penilaian anggap 1
    	$pm = PenilaianMarkah::find()
    		->where(['id_penilaian_profil' => $pp['id_penilaian_profil']])
    		->orderBy(['id_bidang_abiliti' => SORT_DESC])//komen in utk atas abiliti terbaru
    		->all();
    	$bil_pm=count($pm);//$bil_ability dan $bil_pm mesti sama 
    	//echo "bil pm".$bil_pm."<br>";
    	//////////////////////////penemuan utk bincang esok...ACL mungkin berubah2...cadang save ke table
    	//nak cek rekod penilaian lama ada ke tak yg x sama  bil abiliti
    	//if INI BOLEH MANSUH JIKA DPT BERI MARKAH 1 UTK ACL BARU YG TIADA PENILAIAN
    	/*
		if($bil_pm!=0&&$bil_abiliti!=$bil_pm){
			echo "<br><h4>Bilangan Ability Penilaian dan Bilangan Ability Database Tak Sama</h4>";
			echo "<br>bil_pm = $bil_pm bil abiliti = $bil_abiliti<br>";
			exit;
		}//end if($bil_pm!=0&&$bil_abiliti!=$bil_pm)
		*/	
		$jum_markah=0;
		//BAGI PERSONAL YG TIDAK MEMBUAT PENILAIAN LANGSUNG
    	if($bil_pm==0||$bil_pp==0){
    		//echo "Tidak membuat penilaian bil_abiliti : $bil_abiliti<br>";
    		for($k=1;$k<=$bil_abiliti;$k++){
    			$ability_map[$k][$col]=1;//X buat penilaian...markah 1
    			$jum_markah+=$ability_map[$k][$col];
    		}
    		
    	}else{
    			foreach($pm as $pen_markah){
    				$row++;//row mula 1...0+1 pd mula loop
    				$ability_map[$row][$col]=$pen_markah['markah_supervisor'];//col mula dr 3 dn row mula 1...lepas ni tukar markah supervisor			
    				$jum_markah+=$ability_map[$row][$col];

    				 
    			}

    	}
    	//echo "jum markah : $jum_markah<br>";
    	//*
    	if($jum_markah==0||$bil_abiliti==0){
    		$ability_map[$bil_abiliti+1][$col]='E';//jumlah markah ability per pengajar
    		$ability_map[$bil_abiliti+2][$col]='E';
    	}else{
    		$ability_map[$bil_abiliti+1][$col]=$jum_markah;//jumlah markah ability per pengajar
    		$ability_map[$bil_abiliti+2][$col]=number_format($jum_markah/$bil_abiliti, 1, '.', '');//jumlah purata markah ability per pengajar..$bil_pm
    	}
    	//*/
    	$col++;
    }
//
//*
    //test ability map
    $bil_row = $bil_abiliti;//bilrow tak termasuk jum markah dan purata
    $bil_col = $col - 1;//kerana ada 0,....ni utk looping jika looping mula dr 0
    //echo "<br>row = $bil_row col = $col bil_pm = $bil_pm<br>";     
    ?>
    <style>

    .verticaltext {

    transform:rotate(270deg) translate(-100%, 0);
    white-space:nowrap;
    width: 10px;
	align-items: center;

	}
	.tdcenter {
	  text-align: center;
	  vertical-align: middle;
	  
	}
    </style>


	        <?php 
	        $this->registerJs(
        		'$("document").ready(function(){ 
	        		$(".adamarkah").each(function(){
						dalam = $(this).text();
						console.log(dalam);
	        			if(dalam==1){
							$(this).css("background-color", "Aqua");
						}
	        			if(dalam==2){
							$(this).css("background-color", "LawnGreen");
						}
	        			if(dalam==3){
							$(this).css("background-color", "Yellow");
						}
	        			if(dalam==4){
							$(this).css("background-color", "Fuchsia");
						}
	        			if(dalam==5){
							$(this).css("background-color", "Red");
						}
	        			
			        });
				});'
        	);
	        //yg jd writing-mode:tb-rl;
	        ?>

<div class="container">
<table class="table table-striped table-bordered table-hover table-condensed">
	    <thead>
	      <tr>
	        
	        <?php
	        //class table : class="table table-bordered table-hover"
	        	for($i=0;$i<=$bil_col;$i++){
	        		if($i>2){
	        			echo "<th width='2pixels' height='300pixels'><p class='verticaltext'><br>".$ability_map[0][$i]."</p></th>";//nama vertical
	        		}
	        		if($i==0){
	        			echo "<th width='30pixels' class='tdcenter'>".$ability_map[0][$i]."</th>";
	        		}
	        		if($i==1){
	        			echo "<th width='5pixels' class='tdcenter'><p class='verticaltext'><br>".$ability_map[0][$i]."</p></th>";//importance
	        		}
	        		if($i==2){
	        			echo "<th width='100pixels' class='tdcenter'>".$ability_map[0][$i]."</th>";
	        		}
	        	}
	        	echo "<th width='30pixels' class='tdcenter'>Mean</th>";
	        	echo "<th width='30pixels' class='tdcenter'>SD</th>";
	        	//echo "<th width='2pixels'><p class='tdcenter>SD</p></th>";

	        	//Utk masukkan dlm grid view
	        	$ability_map[0][$bil_col+1]="Mean";
	        	$ability_map[0][$bil_col+2]="SD";
	        ?>
	      </tr>
	    </thead>
	    <tbody>
	      <?php 
	      	for($r=1;$r<=$bil_row;$r++){
	      		echo "<tr>";
	      		$pengatas = 0;
	      		for($c=0;$c<=$bil_col;$c++){
	      			if($c==2){
	      				echo "<td>".$ability_map[$r][$c]."</td>";
	      			}
	      			if($c==0 || $c==1){
	      				echo "<td  class='tdcenter'>".$ability_map[$r][$c]."</td>";
	      			}
	      			if($c>2){
	      				//Ni KES BIL ACL > PEN MARKAH...KES TELAH BERTAMBAH ABILITI AC
	      				if(!isset($ability_map[$r][$c])){
	      					$ability_map[$r][$c]=1;
	      				}
	      				echo "<td  class='tdcenter adamarkah'>".$ability_map[$r][$c]."</td>";
	      				$pengatas+=$ability_map[$r][$c];
	      			}
	      			
	      		}
	      		//kira mean dan sd disini
	      		$N=$bil_personal;
	      		$mean = number_format($pengatas/$N, 1, '.', '');//round( $pengatas/$N, 1, PHP_ROUND_HALF_UP);
	      		
	      		//utk summary mean abiliti
	      		if($mean>=4.5){
	      			$a_skor45++;
	      			$li_a45.='<li class="list-group-item">'.$ability_map[$r][0].' '.$ability_map[$r][2].'</li>';
	      		}
	      		if($mean>=4&&$mean<4.5){
	      			$a_skor4045++;
	      			$li_a4045.='<li class="list-group-item">'.$ability_map[$r][0].' '.$ability_map[$r][2].'</li>';
	      		}
	      		if($mean>=3&&$mean<4){
	      			$a_skor3040++;
	      			$li_a3040.='<li class="list-group-item">'.$ability_map[$r][0].' '.$ability_map[$r][2].'</li>';
	      		}
	      		if($mean<3){
	      			$a_skor3++;
	      			$li_a3.='<li class="list-group-item">'.$ability_map[$r][0].' '.$ability_map[$r][2].'</li>';
	      		}
	      		
	      		//kira sd kena buat loop lg sekali
	      		$sum=0;
	      		for($c=3;$c<=$bil_col;$c++){
	      			$sum+=pow(($ability_map[$r][$c] - $mean),2);
	      		}
	      		$sd = number_format(sqrt($sum/$N), 1, '.', '');//sqrt($sum/$N);
	      		echo "<td  class='tdcenter'>".$mean."</td>";
	      		echo "<td  class='tdcenter'>".$sd."</td>";
	      		echo "</tr>";
	      		
	      		//Utk masukkan dlm grid view
	      		$ability_map[$r][$bil_col+1]=$mean;
	      		$ability_map[$r][$bil_col+2]=$sd;
	      	}
	      	echo "<tr>";
	      	for($c=0;$c<=$bil_col;$c++){//jum markah
	      		echo "<td class='tdcenter'>".$ability_map[$bil_row+1][$c]."</td>";//boleh guna sum dan count dr object
	      	}
	      	echo "<td></td><td></td></tr>";
            echo "<tr>";
	      	for($c=0;$c<=$bil_col;$c++){//jum purata markah
	      		echo "<td class='tdcenter'>".$ability_map[$bil_row+2][$c]."</td>";
	      		
	      		if($c>2){
	      			$purata_markah = $ability_map[$bil_row+2][$c];
	      			//utk summary mean personal
	      			$bil_respondan++;
	      			if($purata_markah>=4.5){
	      				$skor45++;
	      				$li_p45.='<li class="list-group-item">'.$ability_map[0][$c].'</li>';
	      			}
	      			if($purata_markah>=4&&$purata_markah<4.5){
	      				$skor4045++;
	      				$li_p4045.='<li class="list-group-item">'.$ability_map[0][$c].'</li>';
	      			}
	      			if($purata_markah>=3&&$purata_markah<4){
	      				$skor3040++;
	      				$li_p3040.='<li class="list-group-item">'.$ability_map[0][$c].'</li>';
	      			}
	      			if($purata_markah<3){
	      				$skor3++;
	      				$li_p3.='<li class="list-group-item">'.$ability_map[0][$c].'</li>';
	      			}
	      		}

	      	}
	      	echo "<td></td><td></td></tr>";
	      	//nk print
//*/        	
 //   }else{//end if bil personal
 //   	Echo "<h3>Tiada Rekod Personal Berdaftar Atau Tiada Personal Membuat Penilaian Dalam Bidang Ini</h3>";
 //   }
    	
    
	      ?>
    </tbody>
  </table>
  
</div>

<div class="panel panel-success">
	<div class="panel-heading">
	<h4 class="panel-title">
	<a data-toggle="collapse" data-parent="personal_accordion" href="#cetak_1">Versi Cetak Abiliti Map</a>
	</h4>
	</div>
	<div id="cetak_1" class="panel-collapse collapse">
		<div class="panel-body">
<?php 
$provider = new ArrayDataProvider([
		'allModels' => $ability_map,

]);

echo GridView::widget([
		'dataProvider' => $provider,

]);
//*/
?>
		  </div>
	</div>
</div>

	</div>
	<div class="tab-pane" id="view_summary_personal">
<div class="col-md-4">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr><th class="col-md-2">Bil Respondan</th><th class="col-md-2 text-center"><span class="badge"><?=$bil_respondan;?></span></th></tr>
		
	</thead>
	<tbody>
		<tr>
			<td class="col-md-2">Skor >= 4.5 </td><td class="col-md-2 text-center"><span class="badge"><?=$skor45;?></span></td>
		</tr>
		<tr>
			<td class="col-md-2">4.0 <= Skor < 4.5 </td><td class="col-md-2 text-center"><span class="badge"><?=$skor4045;?></span></td>
		</tr>
		<tr>
			<td class="col-md-2">3.0 <= Skor < 4.0 </td><td class="col-md-2 text-center"><span class="badge"><?=$skor3040;?></span></td>
		</tr>
		<tr>
			<td class="col-md-2">Skor < 3.0 </td><td class="col-md-2 text-center"><span class="badge"><?=$skor3;?></span></td>
		</tr>
		
	</tbody>
</table>
</div>

<div class="col-md-6">

<?= ChartJs::widget([
    'type'=> 'pie',
    'data' => [
    'labels'=> [
        "Skor >= 4.5",
        "4.0 <= Skor < 4.5",
        "3.0 <= Skor < 4.0",
    	"Skor < 3.0"
    ],
    'datasets'=> [
        	[
	            'data'=> [$skor45, $skor4045, $skor3040,$skor3],
	            'backgroundColor'=> [
	                "Red",
	                "Fuchsia",
	                "Yellow",
	            	"LawnGreen"
	            ],
	            'hoverBackgroundColor'=> [
	                "Red",
	                "Fuchsia",
	                "Yellow",
	            	"LawnGreen"
	            ]
        	]
		]
    ]
]);
?>
</div>
<div class="col-md-10">
	<div class="panel-group" id="personal_accordion">
		<div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pa_1">Personal Skor >= 4.5</a>
		  		</h4>
		  </div>
		  <div id="pa_1" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
				    <?=($li_p45!="")?$li_p45:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	   <div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pa_2">Personal 4.0 <= Skor < 4.5</a>
		  		</h4>
		  </div>
		  <div id="pa_2" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
			    <?=($li_p4045!="")?$li_p4045:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	   <div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pa_3">Personal 3.0 <= Skor < 4.0</a>
		  		</h4>
		  </div>
		  <div id="pa_3" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
				    <?=($li_p3040!="")?$li_p3040:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	   <div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pa_4">Personal < 3.0</a>
		  		</h4>
		  </div>
		  <div id="pa_4" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
				    <?=($li_p3!="")?$li_p3:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	</div>
	</div>	
	</div>
	<div class="tab-pane" id="view_summary_ability">		
<div class="col-md-4">
<table class="table table-striped table-bordered table-hover table-condensed">
	<thead>
		<tr><th class="col-md-2">Bil Abiliti</th><th class="col-md-2 text-center"><span class="badge"><?=$bil_abiliti;?></span></th></tr>
		
	</thead>
	<tbody>
		<tr>
			<td class="col-md-2">Skor >= 4.5 </td><td class="col-md-2 text-center"><span class="badge"><?=$a_skor45;?></span></td>
		</tr>
		<tr>
			<td class="col-md-2">4.0 <= Skor < 4.5 </td><td class="col-md-2 text-center"><span class="badge"><?=$a_skor4045;?></span></td>
		</tr>
		<tr>
			<td class="col-md-2">3.0 <= Skor < 4.0 </td><td class="col-md-2 text-center"><span class="badge"><?=$a_skor3040;?></span></td>
		</tr>
		<tr>
			<td class="col-md-2">Skor < 3.0 </td><td class="col-md-2 text-center"><span class="badge"><?=$a_skor3;?></span></td>
		</tr>
		
	</tbody>
</table>
</div>
<div class="col-md-6">

<?= ChartJs::widget([
    'type'=> 'pie',
    'data' => [
    'labels'=> [
        "Skor >= 4.5",
        "4.0 <= Skor < 4.5",
        "3.0 <= Skor < 4.0",
    	"Skor < 3.0"
    ],
    'datasets'=> [
        	[
	            'data'=> [$a_skor45, $a_skor4045, $a_skor3040,$a_skor3],
	            'backgroundColor'=> [
	                "Red",
	                "Fuchsia",
	                "Yellow",
	            	"LawnGreen"
	            ],
	            'hoverBackgroundColor'=> [
	                "Red",
	                "Fuchsia",
	                "Yellow",
	            	"LawnGreen"
	            ]
        	]
		]
    ]
]);
?>
</div>	
<div class="col-md-10">
	<div class="panel-group" id="personal_accordion">
		<div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pb_1">Abiliti Skor >= 4.5</a>
		  		</h4>
		  </div>
		  <div id="pb_1" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
				    <?=($li_a45!="")?$li_a45:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	   <div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pb_2">Abiliti 4.0 <= Skor < 4.5</a>
		  		</h4>
		  </div>
		  <div id="pb_2" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
			    <?=($li_a4045!="")?$li_a4045:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	   <div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pb_3">Abiliti 3.0 <= Skor < 4.0</a>
		  		</h4>
		  </div>
		  <div id="pb_3" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
				    <?=($li_a3040!="")?$li_a3040:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	   <div class="panel panel-success">
		  <div class="panel-heading">
		  		<h4 class="panel-title">
		  			<a data-toggle="collapse" data-parent="personal_accordion" href="#pb_4">Abiliti < 3.0</a>
		  		</h4>
		  </div>
		  <div id="pb_4" class="panel-collapse collapse">
			  <div class="panel-body">
			    <ul class="list-group">
				    <?=($li_a3!="")?$li_a3:"Tiada Rekod";?>
				  </ul>
			  </div>
		</div>
	   </div>
	</div>
	</div>	

	</div>
</div>	
<?php 
}else{//end if bil personal
	Echo "<h3>Tiada Rekod Personal Berdaftar Dalam Bidang Ini</h3>";
}
?>
