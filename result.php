<html>
	<head>
		<title>MakeMyTourEasy</title>
		<style>
			.logo{
				color:white;	
				font-family: sans-serif;
				padding-top: 4px;
  				padding-bottom:1px;
  				padding-left: 40px;
				 text-shadow: 3px 2px blue;
			}
			.add{
				color:white;	
				font-family: sans-serif;
				padding-top: 4px;
  				padding-bottom:1px;
  				padding-left: 40px;
				 text-shadow: 3px 2px blue;
				 font-size:50px;
				 font-style: italic;
			}
			.text{
				color:white;	
				font:bold 20px Sans-serif;
				padding-top: 4px;
  				padding-bottom:1px;
  				padding-left: 40px;
				 text-shadow: 1.5px 1.5px #0000ff;
				 font-style: italic;
				 font-size:23px;
			}
			.padd{
				font:bold 20px Sans-serif;
				color:#0066ff;
				padding-top: 30px;
			}
			.padd1{
				padding-top:2px;
				padding-left:80px;
				padding-bottom:4px;
			}
			.padd2{
				color:#ff5722;	
				padding-top:2px;
				padding-left:80px;
				padding-bottom:4px;
			}
			.padd3{
				width:100%;
					padding: 8px 8px;
			}
			body:before {
				content: '';
				position: fixed;
				width: 100vw;
				height: 100vh;
				background-image: url("3.jpg");
				background-position: center center;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: cover;
				-webkit-filter: blur(13px);
				opacity:0.9;
				z-index: -9;
			}	
		</style>	
		
		<link rel="stylesheet" href="w3s.css">
	</head>
	<body>
		<div class="w3-container w3-blue">
			<div class="w3-row-padding">
				<div class="w3-half">
					<h1 class=logo><a href="makemytoureasy.html" style="text-decoration:none"><i>MakeMyTourEasy</i></a></h1>
				</div>
			</div>
		</div> 
	<?php
		$name=$_POST['tname'];
		$country=$_POST['country'];
		$tour=$_POST['tourh'];
		$clocation=$_POST['location'];	
		
		switch($clocation)
		{
			case "Andhra Pradesh": $s=0; break;
			case "Arunachal Pradesh": $s=1; break;
			case "Assam": $s=2; break;
			case "Bihar": $s=3; break;
			case "Chhattisgarh": $s=4; break;
			case "Goa": $s=5; break;
			case "Gujarat": $s=6; break;
			case "Haryana": $s=7; break;
			case "Himachal Pradesh": $s=8; break;
			case "Jammu and Kashmir": $s=9; break;
			case "Jharkhand": $s=10; break;
			case "Karnataka": $s=11; break;
			case "Kerala": $s=12; break;
			case "Madhya Pradesh": $s=13; break;
			case "Maharashtra": $s=14; break;
			case "Manipur": $s=15; break;
			case "Meghalaya": $s=16; break;
			case "Mizoram": $s=17; break;
			case "Nagaland": $s=18; break;
			case "Odisha(Orissa)": $s=19; break;
			case "Punjab": $s=20; break;
			case "Rajasthan": $s=21; break;
			case "Sikkim": $s=22; break;
			case "Tamil Nadu": $s=23; break;
			case "Telangana": $s=24; break;
			case "Tripura": $s=25; break;
			case "Uttar Pradesh": $s=26; break;
			case "Uttarakhand": $s=27; break;
			case "West Bengal": $s=28; break;
		}
		$l=0;
		for($i=0;$i<29;$i++)
		{
			if(isset($_POST[$i])||$i==$s)
			{
				 $selected[$l]=$i;
				 $l++;
			}
		}
		
		$conn=mysqli_connect("localhost","root","12345");
		$db=mysqli_select_db($conn,"makemytoureasy");
		
		$q="select *from cost;";
		$res=mysqli_query($conn,$q);
		
		$l1=0;
		$i=0;
		$i1=0;
		$i2=0;
		
		while($row = mysqli_fetch_array($res))
		{
			if($i<$l)
            if($l1==$selected[$i])
			{
				if($s==$selected[$i])
				{
					$s=$i1;
				}
				$i2=0;
				for($j=0;$j<$l;$j++)
				{
					$k=$selected[$j];
					$cost1[$i1][$i2]=$row[$k];
					$i2++;
				}
				$i1++;
				$i++;
			}
			$l1++;
		}
		
		for($i=0;$i<$l;$i++)
		{
			for($j=0;$j<$l;$j++)
			{
				$cost3[$i][$j]=$cost1[$i][$j];
			}
		}
		
		
		
		$c1=0;
		for($i=0;$i<$l;$i++)
		{
			$min=$cost3[$i][0];
			for($j=0;$j<$l;$j++)
			{
				if($min>$cost3[$i][$j])
				$min=$cost3[$i][$j];
			}
			$c1=$c1+$min; 
			for($j=0;$j<$l;$j++){
			$cost3[$i][$j]=$cost3[$i][$j]-$min; }
		}
		
		for($i=0;$i<$l;$i++)
		{
			$min=$cost3[0][$i];
			for($j=0;$j<$l;$j++)
			{
				if($min>$cost3[$j][$i])
				$min=$cost3[$j][$i];
			}
			$c1=$c1+$min;
			for($j=0;$j<$l;$j++)
			  $cost3[$j][$i]=$cost3[$j][$i]-$min;
		}
		
		$s1=$s;
		$f[0]=$s1;
		$l1=1;
		
		for($i=0;$i<$l;$i++)
		{
			$a[$i]=$i;
		}
		$a[$i+1]=$i+1;
		$x=$i+1;
		$a[$s]=$x;
		for($p=0;$p<$l;$p++)
		{
			$sum=0;
			$c2=999999;
			for($y=0;$y<$l;$y++)
			{
				$i=$a[$y];
				if($i!=$s1&&$a[$i]!=$x)
				{
					for($j=0;$j<$l;$j++)
					{
						for($k=0;$k<$l;$k++)
						{
							$cost2[$j][$k]=$cost3[$j][$k];
						}
					}
					for($j=0;$j<$l;$j++)
					{
						$cost2[$s1][$j]=999999;
						$cost2[$j][$i]=999999;
					}
					$cost2[$i][$s]=999999;
				
					
					
					
					
					
					
					
					
					
					for($j=0;$j<$l;$j++)
					{
						for($k=0;$k<$l;$k++)
						{
							$cost5[$j][$k]=$cost2[$j][$k];
						}
					}
					
					
					
					
					
					
					
					
					
					
					
					$sum=0;
					for($j=0;$j<$l;$j++)
					{
						$min=999999;
						for($k=0;$k<$l;$k++)
						{
							if($min>$cost5[$j][$k])
								$min=$cost5[$j][$k];
						}
						if($min>99990)
							$sum=$sum+0;
						else
						{
							$sum=$sum+$min;
							
							for($k=0;$k<$l;$k++){
								$cost5[$j][$k]=$cost5[$j][$k]-$min; }
						}
					}
					for($j=0;$j<$l;$j++)
					{
						$min=999999;
						for($k=0;$k<$l;$k++)
						{
							if($min>$cost5[$k][$j])
								$min=$cost5[$k][$j];
						}
						if($min>99990)
							$sum=$sum+0;
						else
						{
							$sum=$sum+$min;
							
							for($k=0;$k<$l;$k++){
								$cost5[$k][$j]=$cost5[$k][$j]-$min; }	
						}
					}
					
					$c3=$c1+$sum+$cost3[$s1][$i];
					
					if($c3<=$c2){
						$c2=$c3;
						$v=$i;
						for($j=0;$j<$l;$j++)
						{
							for($k=0;$k<$l;$k++)
							{
								$cost4[$j][$k]=$cost2[$j][$k];
							}
						}
					}
				
				
				}
			}
			$c1=$c2;
			$a[$v]=$x;
			$f[$l1++]=$v;
			$s1=$v;
			for($j=0;$j<$l;$j++)
			{
				for($k=0;$k<$l;$k++)
				{
					$cost3[$j][$k]=$cost4[$j][$k];
				}
			}
		}
		
		echo "<div class=add><marquee scrollamount=7>Happy Journey</marquee></div>";
		echo "<div class=text>";
		echo "<br/><br/><br/>";
		echo "Hello Mr/Mrs ".$name.", to travel through the mentioned regions with a minimum distance, follow the path given below:<br/><br/><br/>";
		
		
		$f[$l1-1]=$s;
		for($k=0;$k<$l1;$k++)
		{
			$i=$selected[$f[$k]];
			switch($i)
			{
				case "0": echo "Andhra Pradesh"; break;
				case "1": echo "Arunachal Pradesh"; break;
				case "2": echo "Assam"; break;
				case "3": echo "Bihar"; break;
				case "4": echo "Chhattisgarh"; break;
				case "5": echo "Goa"; break;
				case "6": echo "Gujarat"; break;
				case "7": echo "Haryana"; break;
				case "8": echo "Himachal Pradesh"; break;
				case "9": echo "Jammu and Kashmir"; break;
				case "10": echo "Jharkhand"; break;
				case "11": echo "Karnataka"; break;
				case "12": echo "Kerala"; break;
				case "13": echo "Madhya Pradesh"; break;
				case "14": echo "Maharashtra"; break;
				case "15": echo "Manipur"; break;
				case "16": echo "Meghalaya"; break;
				case "17": echo "Mizoram"; break;
				case "18": echo "Nagaland"; break;
				case "19": echo "Odisha(Orissa)"; break;
				case "20": echo "Punjab"; break;
				case "21": echo "Rajasthan"; break;
				case "22": echo "Sikkim"; break;
				case "23": echo "Tamil Nadu"; break;
				case "24": echo "Telangana"; break;
				case "25": echo "Tripura"; break;
				case "26": echo "Uttar Pradesh"; break;
				case "27": echo "Uttarakhand"; break;
				case "28": echo "West Bengal"; break;
			}
			if($k<$l1-1)
				echo "     .....>     ";
		}
		
		$d=0;
		for($i=0;$i<$l;$i++)
			$d=$d+$cost1[$f[$i]][$f[$i+1]];
		
		echo "<br/><br/>Distance to be travelled:".$d." Km";
		echo "</div>";
		echo "<br/><br/><br/><div class=add><marquee direction=right scrollamount=7>Happy Journey</marquee></div>";
	?>
	</body>
<html>