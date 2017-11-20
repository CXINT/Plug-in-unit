
#boyAnimate.js
##需要配合animate.css动画库
###html部分
	
 	`<div class="boy-animate" 
 	boy-animate-duration="2s" 
 	boy-animate-effect="bounce" 
 	boy-animate-delay="0s">
 	</div>`
 	<br>
 	**boy-animate-duration:表示动画执行的时间(秒);<br>
 	boy-animate-effect:表示动画效果的class类<br>
 	boy-animate-delay:动画延迟执行的时间(秒<br>**

##js部分
  `animated = new boyAnimate({
  		class: 'boy-animate', //需要设置动画的类
  		animate: 'animate'	  //执行动画的class
  })`