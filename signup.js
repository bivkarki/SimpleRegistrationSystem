  var x1=Math.ceil (Math.random() * 9);
        var x2=Math.ceil (Math.random() * 9);
        var x3=Math.ceil (Math.random() * 9);
        var x4=Math.ceil (Math.random() * 9);
        var x5=Math.ceil (Math.random() * 9);
        var x6=Math.ceil (Math.random() * 9);
        var ch1 = String.fromCharCode(65 + Math.ceil (Math.random() * 25));
        var ch2=String.fromCharCode(97+Math.ceil (Math.random() * 25));
       var captcha=x1+ch1+x2+x3+ch2+x4+x5+x6;
  function generate()
  {
  	document.getElementById("captcha").innerHTML="<center><sub>"+x1+"</sub>\t"+"<sup>"+ch1+"</sup>\t"+x2+"\t"+x3+"\t"+"<sub>"+ch2+"</sub>\t"+"<sup>"+x4+"</sup>\t"+x5+"\t<sup>"+x6+"</sup></center>";
  }
         
function res()
{
	document.getElementById("msg").style.display="none";
}




