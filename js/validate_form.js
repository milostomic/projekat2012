function validateForm()
{
var x=document.forms["forma"]["username"].value;
if (x==null || x=="")
  {
  alert("Morate uneti korisnicko ime!");
  return false;
  }

var x=document.forms["forma"]["password"].value;
if (x==null || x=="")
  {
  alert("Morate uneti sifru!");
  return false;
  }
  
var x=document.forms["forma"]["re_password"].value;
if (x==null || x=="")
  {
  alert("Morate ponoviti sifru!");
  return false;
  }
  
var pass=document.forms["forma"]["password"].value;
var re_pass=document.forms["forma"]["re_password"].value;
if (pass != re_pass) 
	{ 
	alert("Sifre se ne poklapaju.");
	return false; 
	}

var x=document.forms["forma"]["ime"].value;
if (x==null || x=="")
  {
  alert("Morate uneti ime!");
  return false;
  }  
  
var x=document.forms["forma"]["prezime"].value;
if (x==null || x=="")
  {
  alert("Morate uneti prezime!");
  return false;
  }  
  
var x=document.forms["forma"]["telefon"].value;
if (x==null || x=="")
  {
  alert("Morate uneti telefon!");
  return false;
  }  
  
var x=document.forms["forma"]["email"].value;
if (x==null || x=="")
  {
  alert("Morate uneti e-mail!");
  return false;
  }
  
var x=document.forms["forma"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Niste ispravno uneli e-mail!");
  return false;
  }
  
var x=document.forms["forma"]["pravoID"].value;
if (x==null || x=="")
  {
  alert("Morate odabrati da li ste nastavnik ili demonstrator!");
  return false;
  }
}