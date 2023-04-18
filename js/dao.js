let lis = document.querySelectorAll('li')
let cont1 = document.getElementById('cont1')
let cont2 = document.getElementById('cont2')
for (let i = 0;i<lis.length;i++){
	lis[i].onclick = function(event){
		if(event.target.classList.contains('first')){
			changPage()
			cont1.style.display = 'block'
		}else{
			changPage()
			cont2.style.display = 'block'
		}
	}
}
function changPage(){
	document.querySelectorAll('.cont').forEach(el=>{
		el.style.display = 'none'
	})
}

let lis2=document.getElementsByClassName('nav2');
let divs=document.querySelector('.cun').querySelectorAll('div');
for(let i=0;i<lis2.length;i++){
   lis2[i].setAttribute('index',i);
   lis2[i].onclick=function(){
       for(let i=0;i<lis2.length;i++){
           lis2[i].className='';
       }
       let index=this.getAttribute('index');
       for(let i=0;i<divs.length;i++){
           divs[i].style.display='none';
       }
       divs[index].style.display='block';
   }
}
