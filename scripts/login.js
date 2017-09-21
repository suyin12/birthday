$(function(){
  		var getCvs=document.getElementById('cvs');
  		var ctx = getCvs.getContext('2d');
  		var width = ctx.canvas.width;
  		var height = ctx.canvas.height;
  		var r = width/2;

 		// drawCirceBack()
  		function drawCirceBack(){
  			ctx.save();
  			ctx.translate(r,r)//从新映射原点
  			ctx.beginPath();
  			ctx.lineWidth=10;
  			ctx.arc(0, 0, r-10, 0, 2*Math.PI,false);
        ctx.strokeStyle = '#00BCD4';
  			ctx.stroke();


  			var houreNumber = [3,4,5,6,7,8,9,10,11,12,1,2]
  			houreNumber.forEach(function(number,index){
  				ctx.font ='20px Arial';
  				ctx.textAlign = 'center';
  				ctx.textBaseline = 'middle';
          ctx.fillStyle='#20A0FF';
  				var rad = 2*Math.PI/12*index;
  				var x = Math.cos(rad)*(r-30);
  				var y = Math.sin(rad)*(r-30);
  				ctx.fillText(number,x,y);

  			})

  			for(var i = 0 ; i < 60; i++){
  				var rad = 2*Math.PI/60*i;
  				var x = Math.cos(rad)*(r-20);
  				var y = Math.sin(rad)*(r-20);
  				ctx.beginPath();
  				if(i%5 != 0){
  					ctx.fillStyle='#00BCD4';
  				}else{
  					ctx.fillStyle='red';
  				}	
  				ctx.arc(x,y,2,0,2*Math.PI,false);
  				ctx.fill();
  			}
  		}

  		// drawHoure(2,30)
  		function drawHoure(houre,minute){
  			var rad = 2*Math.PI/12 * houre;
  			var mrad = 2*Math.PI/12/60 * minute;
  			ctx.save();

  			ctx.rotate(rad+mrad)
  			ctx.beginPath();
  			ctx.lineWidth = 6;
  			ctx.lineCap = 'round';//定义线条两顶端的样式（形状）
  			ctx.moveTo(0,10);
  			ctx.lineTo(0,-r/2)
  			ctx.stroke();

  			ctx.restore();
  			

  		}

  		// drawMinute(30)
  		function drawMinute(minute){
  			var rad = 2*Math.PI/60 * minute;

  			ctx.save();
  			ctx.rotate(rad)
  			ctx.beginPath();
  			ctx.lineWidth = 4;
  			ctx.lineCap = 'round';//定义线条两顶端的样式（形状）
  			ctx.moveTo(0,10);
  			ctx.lineTo(0,-r+60)
  			ctx.stroke();

  			ctx.restore();
  		}

  		// drawSecond(60)
  		function drawSecond(second){
  			var rad = 2*Math.PI/60 * second;

  			ctx.save();
  			ctx.rotate(rad)
  			ctx.beginPath();
  			ctx.fillStyle="red";
  			ctx.lineWidth = 2;
  			ctx.lineCap = 'round';//定义线条两顶端的样式（形状）
  			ctx.moveTo(-2,30);
  			ctx.lineTo(2,30)
  			ctx.lineTo(1,-r+40)
  			ctx.lineTo(-1,-r+40)
  			ctx.fill();

  			ctx.restore();
  		}

		// drawMiddleCirce()
  		function drawMiddleCirce(){
  			ctx.beginPath();
  			ctx.fillStyle='white';
  			ctx.arc(0, 0, 3, 0, 2*Math.PI,false);
  			ctx.fill();
  		}

  		
  		function drawAll(){
  			ctx.clearRect(0,0,width,height)
  			var getData = new Date();
	  		var h = getData.getHours();
	  		var m = getData.getMinutes();
	  		var s = getData.getSeconds();
  			drawCirceBack();
	  		drawHoure(h,m);
	  		drawMinute(m);
	  		drawSecond(s);	
	  		drawMiddleCirce();
  			ctx.restore();
  		}
  		
	  	drawAll();
  		setInterval(drawAll,1000)
  })