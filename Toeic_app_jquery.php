<!DOCTYPE html>

<html>

<head>
<title>Toeic_for_Android</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js">
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
</script>

<script type= "text/javascript">


$(function(){

	// Variable
	var UserMode=0;  // 0 = computer 1= phone
	var list =new Array(820);		  // read from database
	for(var i=0 ;i<820;i++)
	{
		list[i]=new Array(2);
	}	
    
    var Start_Num = 0;	              // first word 
	var Timer_flag =0;				  // only set once
	var Change_rate=0;				  // random value of next word
	var DataInRange =new Array(820);  // data for choosed word
	for(var i=0 ;i<820;i++)
	{
		DataInRange[i]=new Array(2);
	}	
	var NumRange = 0;    // USER Choose Word Range 
	var WordMode = 0;	 // toeic820 or 389
	var WordModeFlag=0;  // only set once
	var  responsiveVoiceCN = new ResponsiveVoice();    //TTS
	var  responsiveVoiceEN = new ResponsiveVoice();		
	
	// Variable
	
	


	$("#btn_Start").click(function(){
	
		if(NumRange==0) alert("Choose the Range");
		
		else
		{
			if(Timer_flag==0)
			{
			Timer_flag =1;
			
			Timer();
				
				
			}


		
			
			
		}
	
	
	
	});
	
	
	
	
	$("#btn_Stop").click(function(){
	
		clearTimeout(t);
		clearTimeout(t_en);
		clearTimeout(t_cn);
		Timer_flag=0;	
		
	
	
	});
	
	
	
	$("#btn_Range").click(function(){
		
	    Start_Num = 0;
		var checked = GetCheckedValue1('range');
		var NumCount = 0;
		var Extra=0;
		if(checked.length==0) alert("you dont choose anyone");
		for(var i =0 ;i < checked.length ; i++)
		{
			
			
			
			for(var ii=0;ii<100;ii++) 
				{   
					
					if (WordMode==1&&checked[i]==3)
				 {
				  for(var ii = 0;ii<89;ii++)
				 {
					DataInRange[ii+NumCount*100][0]=list[(checked[i])*100+ii][0];
					DataInRange[ii+NumCount*100][1]=list[(checked[i])*100+ii][1];	
					 Extra=89;	
				 }
				 break;
				 
				 }
				 else
				 {
					DataInRange[ii+NumCount*100][0]=list[(checked[i])*100+ii][0];
					DataInRange[ii+NumCount*100][1]=list[(checked[i])*100+ii][1];		
				 }
				 
				}
				

			 NumCount++;
			 
			 if(WordMode==0&&checked[i]==7) 
			 {
				 for(var ii =0;ii<20;ii++)
				 {
					DataInRange[ii+NumCount*100][0]=list[800+ii][0];
					DataInRange[ii+NumCount*100][1]=list[800+ii][1];		
				 }
				 Extra=20;
				
			 }
			
			
			
			
			
		}
		NumCount=checked.length*100;
		NumRange=NumCount+Extra;
		Start_Num= Math.floor((Math.random() * NumRange)+1);
		console.log((NumRange));
		alert("你所選範圍是第"+checked+"部分");
		
	
	
	});
	
	
	$("#btn_820").click(function(){
		
		if(WordModeFlag==0)
		{
		WordMode=0;
		WordModeFlag=1;
		$("<p>複習範圍<br></p>"
		+"<input type='checkbox'  value='0' name='range'><font size= '2'>0~100</font><br>"
		+"<input type='checkbox'  value='1' name='range'><font size= '2'>100~200</font><br>"
		+"<input type='checkbox'  value='2' name='range'><font size= '2'>200~300</font><br>"
		+"<input type='checkbox'  value='3' name='range'><font size= '2'>300~400</font><br>"
		+"<input type='checkbox'  value='4' name='range'><font size= '2'>400~500</font><br>"
		+"<input type='checkbox'  value='5' name='range'><font size= '2'>500~600</font><br>"
		+"<input type='checkbox'  value='6' name='range'><font size= '2'>600~700</font><br>"
		+"<input type='checkbox'  value='7' name='range'><font size= '2'>700~840</font><br>")
		.insertAfter("#CheckboxChoose");
		
		$.get("ReadToeic.php",{TOEIC_TYPER : "0"},function(data){
			
			$("#CheckboxChoose").hide();
			var array = data.split(",");
			for(var i=0;i<820;i++)
			{
				list[i][0]=array[i];
			
			}
			
		});
		
		
		$.get("ReadToeic.php",{TOEIC_TYPER : "1"},function(data){
			
			$("#CheckboxChoose").hide();
			var array = data.split(",");
			for(var i=0;i<820;i++)
			{
				list[i][1]=array[i];
			
			}
			
			
			
			
		});
		
		}
		
	});
	
	
	$("#btn_389").click(function(){
		
	if(WordModeFlag==0)
		{
			WordMode=1;
			WordModeFlag=1;
			
		$("<p>複習範圍<br></p> "
		+"<input type='checkbox'  value='0' name='range'><font size= '2'>0~100</font><br>"
		+"<input type='checkbox'  value='1' name='range'><font size= '2'>100~200</font><br>"
		+"<input type='checkbox'  value='2' name='range'><font size= '2'>200~300</font><br>"
		+"<input type='checkbox'  value='3' name='range'><font size= '2'>300~389</font><br>")
		.insertAfter("#CheckboxChoose");
		
		
		
		$.get("../ReadToeic.php",{TOEIC_TYPER : "10"},function(data){
			
			$("#CheckboxChoose").hide();
			var array = data.split(",");
			for(var i=0;i<389;i++)
			{
				list[i][0]=array[i];
			
			}
			
		});
		
		
		$.get("../ReadToeic.php",{TOEIC_TYPER : "11"},function(data){
			
			$("#CheckboxChoose").hide();
			var array = data.split(",");
			for(var i=0;i<389;i++)
			{
				list[i][1]=array[i];
			
			}
			
			
			
			
		});
		
		
		
		
		
		}
		
		
	});
	
	
	$("#Phone_USER").click(function(){
		
		UserMode=1; //phone 
		
		var msg = new SpeechSynthesisUtterance();
		var voices = window.speechSynthesis.getVoices();
		msg.voice = voices[10]; // 
		msg.voiceURI = 'native';
		msg.volume = 1; // 0 to 1
		msg.rate = 1; // 0.1 to 10
		msg.pitch = 2; //0 to 2
		msg.text = 'Phone Mode';
		msg.lang = 'en';

		msg.onend = function(e) {
		console.log('Finished in ' + event.elapsedTime + ' seconds.');
		};

		speechSynthesis.speak(msg);
	});
	
	
	
	//---------------function
	
	
  function GetCheckedValue1(checkBoxName)
    {
       return $('input[name=' + checkBoxName + ']:checked').map(function ()
       {
         return $(this).val();
       })
       .get();
   }
   
   
   
   function Timer()
	{
		
	
	 
	  t_en=setTimeout(Eng_change,1);  //different from javascript
	  t_cn=setTimeout(Cn_change,2000);
	  t=setTimeout(Timer,6000);
	 
	
	 
	}
	
	function Eng_change()
	{
	
	 $("#cn").html(" ");
	 
	 Change_rate =  Math.floor((Math.random() * 5)+1);
	 
	 console.log(Change_rate);
	 
     if(Start_Num+Change_rate<NumRange)	 
	 {  
		Start_Num=Start_Num+Change_rate;
		$("#eng").html(DataInRange[Start_Num][0]);
       
	 }
	 else
	 {
	    Start_Num=Math.floor((Math.random() * NumRange));
		$("#eng").html(DataInRange[Start_Num][0]);
		
	 }
	 
		if(UserMode==0)
		{
		responsiveVoice.speak(DataInRange[Start_Num][0], "US English Female", {rate: 1});  
		}
		else
		{
		
		var words = new SpeechSynthesisUtterance(DataInRange[Start_Num][0]);
    
		words.voice = speechSynthesis.getVoices().filter(function(voice) { return voice.name == 'Google US English'; })[0];
  
		words.rate = 0.8; // 0.1 to 10
　 　	speechSynthesis.speak(words);	
			
		}
	 }
	 
	 
	 function Cn_change()
 
	{
	  
	
	$("#cn").html(DataInRange[Start_Num][1]);
	
		if(UserMode==0)
		{
		responsiveVoice.speak(DataInRange[Start_Num][1], "Chinese Female", {rate: 1});  
		}
	}
	 
	 

});




</script>


</head>


<body>

<h1> 會先顯示英文，兩秒後再跳出中文 </h1>

<table style = "font-size:25px;" width = "600"  height= "600" border="1">
　<tr >
　	<td width = "200"  height= "200" align="center">英文</td>
	<td width = "200"  height= "200"  align="center">中文</td>
	<td width = "200"  height= "200" align="center">選項</td>
　</tr>
  
  <tr >
    <td width = "200"  height= "200"  id="eng" align="center">請選擇範圍</td>
	<td width = "200"  height= "200"  id="cn" align="center">請選擇範圍</td>
	<td width = "200"  height= "200"  id="choose" align="center">
		<form  id="CheckboxChoose">
		
		</form>
		
	</td>
  </tr>
</table>


<form >
<input type="button" value="Start" id="btn_Start">
<input type="button" value="Stop"  id="btn_Stop">
<input type="button" value="SendRange"  id="btn_Range">
<input type="button" value="Toeic_840"  id="btn_820">
<input type="button" value="Toeic_important389"  id="btn_389">
<input type="button" value="Phone"  id="Phone_USER">
<br>
秒數輸入 : <input type="number" name = "timeinput" id="SecondControl">
</form>






</body>





</html>