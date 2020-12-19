<?php
	$pilihan = $_POST['pilihan'];
	if($pilihan==1){		
		echo "<script>eval(\"parent.location='angkot_bkt/ '\");	</script>";
	} else if($pilihan==2){		
		echo "<script>eval(\"parent.location='hotel_bkt/ '\");	</script>";
	} else if($pilihan==3){		
		echo "<script>eval(\"parent.location='ik_bkt/ '\");	</script>";
	} else if($pilihan==4){		
		echo "<script>eval(\"parent.location='kuliner_bkt/ '\");	</script>";
	} else if($pilihan==5){		
		echo "<script>eval(\"parent.location='mosque_bkt/ '\");	</script>";
	} else if($pilihan==6){		
		echo "<script>eval(\"parent.location='rm_bkt/ '\");	</script>";
	} else if($pilihan==7){		
		echo "<script>eval(\"parent.location='souvenir_bkt/ '\");	</script>";
	} else if($pilihan==8){		
		echo "<script>eval(\"parent.location='tourism_bkt/ '\");	</script>";
	}
	else if ($pilihan==9){		
		echo "<script>eval(\"parent.location='JambuAir-Cingkariang_bkt/ '\");	</script>";
	}
?>