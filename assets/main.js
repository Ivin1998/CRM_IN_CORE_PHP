const script1 = document.createElement('script');
script1.src = '../assets/validations.js';
document.head.appendChild(script1);


script1.onload=function(){
    const script2=document.createElement('script');
    script2.src='../assets/sweetalert.js';
    document.head.appendChild(script2);
};



