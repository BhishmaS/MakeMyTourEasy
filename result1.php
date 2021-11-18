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
		$state=$_POST['state'];
		switch($clocation)
		{
			case "Anantapur": $s=0; break;
			case "Chittoor": $s=1; break;
			case "East Godavari": $s=2; break;
			case "Guntur": $s=3; break;
			case "Visakhapatnam": $s=4; break;
			case "Krishna": $s=5; break;
			case "West Godavari": $s=6; break;
			case "Nellore": $s=7; break;
			case "Prakasam": $s=8; break;
			case "Srikakulam": $s=9; break;
			case "Kurnool": $s=10; break;
			case "Vizianagaram": $s=11; break;
			case "Kadapa": $s=12; break;
			
		}
		$l=0;
		for($i=0;$i<13;$i++)
		{
			if(isset($_POST[$i])||$i==$s)
			{
				 $selected[$l]=$i;
				 $l++;
			}
		}
		
		$conn=mysqli_connect("localhost","root","12345");
		$db=mysqli_select_db($conn,"makemytoureasy");
		
		$q="select *from cost1;";
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
							if($min>$cost2[$j][$k])
								$min=$cost2[$j][$k];
						}
						if($min>99990)
							$sum=$sum+0;
						else
						{
							$sum=$sum+$min;
							
							for($k=0;$k<$l;$k++){
								$cost5[$j][$k]=$cost5[$j][$k]-$min; }
							
							
							
							
						}
					
						$min=999999;
						for($k=0;$k<$l;$k++)
						{
							if($min>$cost2[$k][$j])
								$min=$cost2[$k][$j];
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
		
		echo "<div class=add><i><marquee scrollamount=7>Happy Journey</marquee></i></div>";
		echo "<div class=text>";
		echo "<br/><br/><br/>";
		echo "Hello Mr/Mrs ".$name.", to travel through the mentioned regions with a minimum distance, follow the path given below:<br/><br/><br/>";		
		
		$f[$l1-1]=$s;
		for($k=0;$k<$l1;$k++)
		{
			$i=$selected[$f[$k]];
			switch($i)
			{
				case "0": echo "Anantapur"; break;
				case "1": echo "Chittoor"; break;
				case "2": echo "East Godavari"; break;
				case "3": echo "Guntur"; break;
				case "4": echo "Visakhapatnam"; break;
				case "5": echo "Krishna"; break;
				case "6": echo "West Godavari"; break;
				case "7": echo "Nellore"; break;
				case "8": echo "Prakasam"; break;
				case "9": echo "Srikakulam"; break;
				case "10": echo "Kurnool"; break;
				case "11": echo "Vizianagaram"; break;
				case "12": echo "Kadapa"; break;
			}
			if($k<$l1-1)
				echo "	.....>";
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