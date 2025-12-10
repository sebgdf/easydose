/*
 * Liste des Objets
 * 
 */
let souscategorieslist='';

function EsrData(esr_id,valuename,value) {
	  this.esr_id = esr_id;
	  this.valuename = valuename;
	  this.value = value;
	}



function OptimisationData(optim_id,valuename,value) {
	  this.optimid = optim_id;
	  this.valuename = valuename;
	  this.value = value;
	}
/*
 * Liste des fonctions 
 * 
 */


function changetextindiv(divid,text){
	$("#"+divid).html(text);
}
function changeValueAsynck(url,esr_id,_valuename,_value){
	  var data
	   $.ajax({
	    url: url,
	    type: 'POST',
	    data : new EsrData(esr_id,_valuename,_value),
	    dataType : 'json',
	    success: function(datas){
	            console.log(datas); 
	        }
	    });
	}

function loadbestEval(url,optimid){
	url2=url.replace("_optimid", optimid);

	$('#bestcomment_'+optimid).load(url2);
}

function changeValueOptimAsynck(url2,optim_id,_valuename,_value){

	  var data
	   $.ajax({
	    url: url2,
	    type: 'POST',
	    data : new OptimisationData(optim_id,_valuename,_value),
	    dataType : 'json',
	    success: function(datas){
	            console.log(datas); 
	        }
	    });
	}


function changeValueEsr(url,esr_id,valueName,value){
		changeValueAsynck(url,esr_id,valueName,value);
	}

	
	

function annulerrechercherpatient(form,urlinit){
	
	//$('input[name=group1]:checked').val('');
	//$('#search-firstname').checked=false;
	//Searchnom
	$('#search-firstname').val('');	
	//Searchprenom
	$('#search-lastname').val('');	
	//SearchpIPP
	$('#search-ipp').val('');	
	//SearchIDR
	$('#search-id-regional').val('');	
	//SearchBD
	//('#SearchBD').val('');	
	//SearchHRDV
	//$('#SearchHRDV').val('');
	$('#maincontent').loading({
		stoppable: true,
        message: 'Chargement...',
        theme: 'dark'
      });	
    url=encodeURI(urlinit);
  
	$('#maincontent').load(url);

	return false;
}



function insertNote(urlpatient2){

	    url=$('#forminsertnote').attr('action');
    notepatient=encodeURI($('#notepatient').val());
    idpatient=encodeURI($('#idpatient').attr('value'));
     
    
    $.ajax({
    		url:url,
    		type:'POST',
    		data: 'idpatient='+idpatient+"&notepatient="+notepatient,
    
            success: function(code_html,statut){
            
            	$('#lastcoment').html(code_html.content);            	   
            	   urlpatient=urlpatient2.replace("patientid",idpatient);
            	   $('#commentairespatient').load(urlpatient);
            	},
            
            	error: function(resultat,statut,erreur){
            	
            			
            },
    
            complete: function(resultat,statut){
            	$('#notepatient').val('');
            }
    
    });


}


function rechercheglobale(url){

	recherche=$('#inputrechercheglobale').val();
	
	recherchereplace=replaceAll(recherche," ","+");
	var url2=url.replace("_words", recherchereplace);
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url2);
	$('#tabledetailcontent').html("");
		
}



function statistiques(url){

	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url);
	$('#tabledetailcontent').html("");
	
}



function optimdose(url){
	

	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url);
	$('#tabledetailcontent').html("");
	
}


function escapeRegExp(string){

    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");

}

 

/* Define functin to find and replace specified term with replacement string */

function replaceAll(str, term, replacement) {

  return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);

}


function accueil(url){
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url);
	$('#tabledetailcontent').html("");
}


function filtre(url){
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url);
	$('#tabledetailcontent').html("");
}


function loadpageesr(url1,url2,elementid){
	loadesr('image_esr',url1);
	loadesr('contenu_esr',url2);
	$('.filearianne').removeClass('current');
	$('#'+elementid).addClass('current'); 
}

function loadpageei(url1,url2,elementid){
	loadesr('image_esr',url1);
	loadesr('contenu_esr',url2);
	$('.filearianne').removeClass('current');
	$('#'+elementid).addClass('current'); 
}

function chargimgdispositif(url){
	$('#descriptiondispositif').load(url);
}

function chargimgdispositif2(url){
	$('#descriptiondispositif2').load(url);
}
function chargimgdispositif3(url){
	$('#descriptiondispositif3').load(url);
}
function saveoptim(optimid,id,currentvalue){
	
}

function changeesrValueGlobal(url,id_esr,type,id){
	
	if(type=='input'){
		
		$('#'+id).on('input',function(e){    
	    	changeValueEsr(url,id_esr,id,this.value);
	    });

	}
	if(type=='select'){
			
			$('#'+id).change(function(){
    	
		    	var fonction = $(this).children("option:selected").val();
		    	changeValueEsr(url,id_esr,id,fonction);  	
    	
    	});
	}
}

function lierInput(div_id,type,id){	
//loadpageesr
	if(type=='input'){
		$('#'+id).on('input',function(e){ 
			changetextindiv(div_id,this.value);
	    });
	}
	
	if(type=='select'){
		$('#'+id).change(function(){
	    	
	    	var fonction = $(this).children("option:selected").val();
	    	changetextindiv(div_id,fonction);  	
	
	});
	}
	
	if(type=='selecttext'){
		$('#'+id).change(function(){
	    	
	    	var fonction = $(this).children("option:selected").text();
	    	changetextindiv(div_id,fonction);  	
	
	});
	}
	if(type=='checkbox'){
		$('.'+id).click(function(){
			var isChecked = $(this).is(':checked');
			if(isChecked)
			{
	    		var fonction = $(this).next("label").text();
	    		changetextindiv(div_id,fonction);  	
			}
	});
	}
}

function loadesr(div,url){
	/*$('#image_esr').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });*/
	$('#'+div).load(url);
}

function workinprogress(title,url){
	
	titlereplace=title.replace(" ","+");
	var url2=url.replace("_title", titlereplace);
	
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url2);
	$('#tabledetailcontent').html("");
	
}


function viewEsr(urltmp,idesr){

	//Mise à jour de la fenetre de l'ESR
	    url2=urltmp.replace('_id_esr',idesr);
	    $('#contentesrviewer').load(url2);
}
function viewEi(urltmp,idesr){

	//Mise à jour de la fenetre de l'ESR
	    url2=urltmp.replace('_id_esr',idesr);
	    $('#contenteiviewer').load(url2);
}

function esr(url){
	var url2=url.replace("_screenheigth", screen.height);
	
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });
	$('#maincontent').load(url2);
	
	$('#tabledetailcontent').html("");
	
}


function listepatientswhiteoutreinit(url){
	
	var url2=url.replace("_screenheigth", screen.height);
	/*
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });*/
	$('#maincontent').load(url2);

	$('#tabledetailcontent').html("");
}


function deleteOptim(optimid,url){
	  url2=url.replace('_optimid',optimid);

	 $.ajax({
     url: url2,
     type: 'GET',
     dataType : 'json',
     success: function(datas){
             console.log(datas);
             

         },
     });

}



function delectepatientEpingle(id,url){
	  
	  patientid=id.substring(8);
	  console.log(patientid);
	 
	  url2=url.replace('_patientid',patientid);


	 $.ajax({
       url: url2,
       type: 'GET',
       dataType : 'json',
       success: function(datas){
               console.log(datas);
               div=$("#"+id);
      		 div.detach();
      		 div.remove();

           },
       });

}

function listepatients(url){
	reinitfilter(url)
	var url2=url.replace("_screenheigth", screen.height);
	/*
	$('#maincontent').loading({
		stoppable: true,
	    message: 'Chargement...',
	    theme: 'dark'
	  });*/
	$('#maincontent').load(url2);

	$('#tabledetailcontent').html("");
}

function addFilter(url,patienteposition, pediatrieposition,nrdposition,scannerposition, radioposition, mammoposition){
	var withradio=false;
	var withscan=false;
	var withmammo=false;
	var withnrd=false;
	var withpediatrie=false;
	var withpatientproc=false;
	
	
	if(patienteposition=='R')
		withpatientproc=true;
	if(pediatrieposition=='R')
		withpediatrie=true;
	if(nrdposition=='R')
		withnrd=true;
	if(scannerposition=='R')
		withscan=true;
	if(radioposition=='R')
		withradio=true;
	if(mammoposition=='R')
		withmammo=true;
		
	var url2=url.replace("_withradio",withradio)
	.replace("_withscan",withscan)
	.replace("_withmammo",withmammo)
	.replace("_withnrd",withnrd)
	.replace("_withpediatrie",withpediatrie)
	.replace("_withpatientproc",withpatientproc);
	
	listepatientswhiteoutreinit(url2);	
}

function chargerMammo(url){
	   clone=$("#Femmesdraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   patienteposition="L";
	   
	   
	   
	   clone=$("#pediatriedraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   pediatrieposition="L";
		 
		 
	   clone=$("#draggablenrd");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   nrdposition="L";
	   
	   
	   clone=$("#draggablescanner");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		   scannerposition="L";
		   
		   
		   
		   clone=$("#draggableradio");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 radioposition="L";
		 
		 
		 
		clone=$("#draggablemammo");
		   clone.detach();
		   $("#divreception").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 mammoposition="R";
		 
		 
		 
		 
		 addFilter(url,patienteposition,pediatrieposition,nrdposition,scannerposition,radioposition,mammoposition);	
}


function chargerScanner(url){
	   clone=$("#Femmesdraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   patienteposition="L";
	   
	   
	   
	   clone=$("#pediatriedraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   pediatrieposition="L";
		 
		 
	   clone=$("#draggablenrd");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   nrdposition="L";
	   
	   
	   clone=$("#draggablescanner");
		   clone.detach();
		   $("#divreception").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		   scannerposition="R";
		   
		   
		   
		   clone=$("#draggableradio");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 radioposition="L";
		 
		 
		 
		clone=$("#draggablemammo");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 mammoposition="L";
		 
		 
		 
		 
		 addFilter(url,patienteposition,pediatrieposition,nrdposition,scannerposition,radioposition,mammoposition);	
}



function chargerRadio(url){
	   clone=$("#Femmesdraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   patienteposition="L";
	   
	   
	   
	   clone=$("#pediatriedraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   pediatrieposition="L";
		 
		 
	   clone=$("#draggablenrd");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   nrdposition="L";
	   
	   
	   clone=$("#draggablescanner");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		   scannerposition="L";
		   
		   
		   
		   clone=$("#draggableradio");
		   clone.detach();
		   $("#divreception").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 radioposition="R";
		 
		 
		 
		clone=$("#draggablemammo");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 mammoposition="L";
		 
		 
		 
		 
		 addFilter(url,patienteposition,pediatrieposition,nrdposition,scannerposition,radioposition,mammoposition);	
}

function chargerNrd(url){
	   clone=$("#Femmesdraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   patienteposition="L";
	   
	   
	   
	   clone=$("#pediatriedraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   pediatrieposition="L";
		 
		 
	   clone=$("#draggablenrd");
	   clone.detach();
	   $("#divreception").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   nrdposition="R";
	   
	   
	   clone=$("#draggablescanner");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		   scannerposition="L";
		   
		   
		   
		   clone=$("#draggableradio");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 radioposition="L";
		 
		 
		 
		clone=$("#draggablemammo");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 mammoposition="L";
		 
		 
		 
		 
		 addFilter(url,patienteposition,pediatrieposition,nrdposition,scannerposition,radioposition,mammoposition);	
}


function getinfopatient(id,url2,urltabletmp){

	
	//$('#custom-overlay').css('visibility', 'visible');
	
	$('#maincontent').loading({
		stoppable: true,
        message: 'Chargement...',
        theme: 'dark'
      });
	
    //url2='{{url('infopatient',{'id':'idtoreplace'})}}';
   
    url=url2.replace('idtoreplace',id);


   // urltabletmp='{{ url('tdpatient',{'id':'idtoreplace'}) }}';
    urltable=urltabletmp.replace('idtoreplace',id);
	$('#maincontent').load(url);
	$('#tabledetailcontent').load(urltable);
	
	}


function reinitfilter(url){
	   clone=$("#Femmesdraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   patienteposition="L";
	   
	   
	   
	   clone=$("#pediatriedraggable");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   pediatrieposition="L";
		 
		 
	   clone=$("#draggablenrd");
	   clone.detach();
	   $("#panierinit").append(clone);
	   clone.css('top', 'auto').css('left', 'auto');
	   clone.css('z-index', 1000);
	   nrdposition="L";
	   
	   
	   clone=$("#draggablescanner");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		   scannerposition="L";
		   
		   
		   
		   clone=$("#draggableradio");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 radioposition="L";
		 
		 
		 
		clone=$("#draggablemammo");
		   clone.detach();
		   $("#panierinit").append(clone);
		   clone.css('top', 'auto').css('left', 'auto');
		   clone.css('z-index', 1000);
		 mammoposition="L";
		 
		 
		 
		 
		 addFilter(url,patienteposition,pediatrieposition,nrdposition,scannerposition,radioposition,mammoposition);	
}


function getNotes2(idpatient,urlpatient2) {
	   
	   urlpatient=urlpatient2.replace("patientid",idpatient);
	   $('#commentairepatientworklist'+idpatient).load(urlpatient);
	   $('#lablllastnotesworklist'+idpatient).html("<center>Toutes les notes:</center>");
	   $('#lastcomentworklist'+idpatient).css('display', 'none');
	   $('#moreworklist'+idpatient).css('display', 'none');	
	   $('#moinsNworklist'+idpatient).css('display', 'block');
	
}  


function thisoneei(offset,url){


	datedebut=$("#rechercherchedatedebut").val()
	if(datedebut != '')
	{
		var date=new Date(datedebut);
		day=date.getDate() 
		month=date.getMonth()
		month=((month+1)+'').padStart(2,'0')
		day=((day)+'').padStart(2,'0')
		var strdate=day +'-'+month+'-'+date.getFullYear();  
	}else
		var strdate='-'


datefin=$("#rechercherchedatefin").val()
if(datefin != '')
{
	var date2=new Date(datefin);
	day2=date2.getDate() 
	month2=date2.getMonth()
	month2=((month2+1)+'').padStart(2,'0')
	day2=((day2)+'').padStart(2,'0')
	var strdate2=day2 +'-'+month2+'-'+date2.getFullYear();  
}else
	var strdate2='-'

    url2=url.split('+')[0].replace("numoffset", (offset)).replace("_screenheigth", screen.height).replace("_categorie" , "_").replace("_souscategorieslist",souscategorieslist).replace("_datedebutf",strdate).replace("_datefinf",strdate2);
   $('#eimesdelarations').load(url2);

   $('#pagination').load(url.split('+')[1].replace("numoffset", (offset)).replace("_screenheigth", screen.height));
}

function lastei(offset,url){
	   
	datedebut=$("#rechercherchedatedebut").val()
	if(datedebut != '')
	{
		var date=new Date(datedebut);
		day=date.getDate() 
		month=date.getMonth()
		month=((month+1)+'').padStart(2,'0')
		day=((day)+'').padStart(2,'0')
		var strdate=day +'-'+month+'-'+date.getFullYear();  
	}else
		var strdate='-'


datefin=$("#rechercherchedatefin").val()
if(datefin != '')
{
	var date2=new Date(datefin);
	day2=date2.getDate() 
	month2=date2.getMonth()
	month2=((month2+1)+'').padStart(2,'0')
	day2=((day2)+'').padStart(2,'0')
	var strdate2=day2 +'-'+month2+'-'+date2.getFullYear();  
}else
	var strdate2='-'

	    url2=url.split('+')[0].replace("numoffset", (offset-1)).replace("_screenheigth", screen.height).replace("_categorie" , "_").replace("_souscategorieslist",souscategorieslist).replace("_datedebutf",strdate).replace("_datefinf",strdate2);
	    
	   $('#eimesdelarations').load(url2);

	   $('#pagination').load(url.split('+')[1].replace("numoffset", (offset-1)).replace("_screenheigth", screen.height));
  }

   
function nextei(offset,url){
		
	datedebut=$("#rechercherchedatedebut").val()
	if(datedebut != '')
	{
		var date=new Date(datedebut);
		day=date.getDate() 
		month=date.getMonth()
		month=((month+1)+'').padStart(2,'0')
		day=((day)+'').padStart(2,'0')
		var strdate=day +'-'+month+'-'+date.getFullYear();  
	}else
		var strdate='-'


datefin=$("#rechercherchedatefin").val()
if(datefin != '')
{
	var date2=new Date(datefin);
	day2=date2.getDate() 
	month2=date2.getMonth()
	month2=((month2+1)+'').padStart(2,'0')
	day2=((day2)+'').padStart(2,'0')
	var strdate2=day2 +'-'+month2+'-'+date2.getFullYear();  
}else
	var strdate2='-'
	
	url2=url.split('+')[0].replace("numoffset",(offset+1)).replace("_screenheigth", screen.height).replace("_categorie" , "_").replace("_souscategorieslist",souscategorieslist).replace("_datedebutf",strdate).replace("_datefinf",strdate2);	
		$('#eimesdelarations').load(url2);

		//url3=

		$('#pagination').load(url.split('+')[1].replace("numoffset",(offset+1)).replace("_screenheigth", screen.height));
}


function thisone(offset,url){
    url2=url.replace("numoffset", (offset)).replace("_screenheigth", screen.height);
   $('#maincontent').load(url2);
}

   function last(offset,url){
	   
	   	
	    url2=url.replace("numoffset", (offset-1)).replace("_screenheigth", screen.height);
	    
	   $('#maincontent').load(url2);
  }

   
function next(offset,url){
		url2=url.replace("numoffset",(offset+1)).replace("_screenheigth", screen.height);	
		$('#maincontent').load(url2);
}

function getNotes(idpatient,urlpatient2) {
	   
	   urlpatient=urlpatient2.replace("patientid",idpatient);
	   $('#commentairespatient').load(urlpatient);
	   $('#lablllastnotes').html("Toutes les notes:");
	   $('#lastcoment').css('display', 'none');
	   $('#more').css('display', 'none');	
	   $('#moinsN').css('display', 'block');
	
}

function openlastnotes(){
	$('#lablllastnotes').html("Dernières notes:");
	$('#lastcoment').css('display', 'inline');
	$('#moreN').css('display', 'inline');
	$('#moinsN').css('display', 'none');
		}
function openlastnotes2(idpatient){
	$('#lablllastnotesworklist'+idpatient).html("Dernières notes:");
	$('#lastcomentworklist'+idpatient).css('display', 'inline');
	$('#moreworklist'+idpatient).css('display', 'inline');
	$('#moinsNworklist'+idpatient).css('display', 'none');
		}

function getreturn(url1,url2) {
	/*$('#maincontent').loading({
		stoppable: true,
        message: 'Chargement...',
        theme: 'dark'
      });*/
    url=url1;
    url2=url.replace("_screenheigth", screen.height);
	$('#maincontent').load(url2);
	$('#tabledetailcontent').html("");

}

function sendmailtoAllConfirmed(url2){



	$('#basicExampleModal').loading({
		stoppable: true,
        message: 'Transmission...',
        theme: 'dark'
      });
    
	
	url=$('#formmail').attr('action');
	
	idpatient=$('#modsendallmail').attr('value');
	

	  $.ajax({
		url:url2,
		type:'POST',
		data: 'idpatient='+idpatient,
	
	success: function(code_html,statut){
		
		},

  	error: function(resultat,statut,erreur){
  		
  			$('#basicExampleModal').loading('stop');
  			$("#btnallrestmail").click();
  			
	},

	complete: function(resultat,statut){
	
		$('#basicExampleModal').loading('stop');
		$("#btnallrestmail").click();
	}

  });
}

function getcontenualaGRS(iddiv,url){

	$(iddiv).loading({
		stoppable: true,
        message: 'Chargement...',
        theme: 'dark'
      });
	$(iddiv).load(url);

	$(iddiv).loading('stop');
}

function convertMonthToFranch(month){
	var mths= [
		'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre',
	'Novembre', 'Decembre']
	
	return mths[month];
}
function valmedicchecked(idpatient){
	$('#modsendallmail').attr('value',idpatient);

}

function sendmailtoOneConfirmed(){

	

	$('#modsendmail').loading({
		stoppable: true,
        message: 'Transmission...',
        theme: 'dark'
      });
    
	
	url=$('#formmail').attr('action');
	
	name=$('#libdest').attr('value');
	
	object=$('#form-Subject').val();
	msg=$('#form-text').val();
	
	
  $.ajax({
		url:url,
		type:'POST',
		data: 'mesg='+msg+"&dest="+name+"&obj="+object,
	
	success: function(code_html,statut){
		
		},

  	error: function(resultat,statut,erreur){
  		
  			$('#modsendmail').loading('stop');
  			
  			
	},

	complete: function(resultat,statut){
		$('#modsendmail').loading('stop');
		$("#btnMailAnnuler").click();


		$("#form-text").html('');
		$("#form-Subject").val('');
		$("#libdest").html('Destinataire');
	}

  });
}


function sendmailtoOne(){

	$('#buttonconfirmsendmail').click();
}


function insertNote2(idpatient,urlpatient2,url){

	url=$('#forminsertnote'+idpatient).attr('action');
	notepatient=encodeURI($('#notepatient'+idpatient).val());
	$.ajax({
		url:url,
		type:'POST',
		data: 'idpatient='+idpatient+"&notepatient="+notepatient,

    	success: function(code_html,statut){
    		   $('#lastcomentworklist'+idpatient).html(code_html.content);    		   
    		   urlpatient=urlpatient2.replace("patientid",idpatient);
    		   $('#commentairepatientworklist'+idpatient).load(urlpatient);
    		},
    	error: function(resultat,statut,erreur){
    		
    	},

    	complete: function(resultat,statut){
    		$('#notepatient'+idpatient).val('');
    		url2=url.replace("_patientid",idpatient);		
    		$('#havecomment'+idpatient).load(url2);
    	}

	});

}


function rechercherpatient(form,url2){

	genre=$('input[name=group1]:checked').val();
	if(!genre)
		genre='null';
	//Searchnom
	Searchnom=$('#search-firstname').val();
	if(!Searchnom)
		Searchnom='null';
	//Searchprenom
	Searchprenom=$('#search-lastname').val();
	if(!Searchprenom)
		Searchprenom='null';
	//SearchpIPP
	SearchpIPP=$('#search-ipp').val();
	if(!SearchpIPP)
		SearchpIPP='null';
	//SearchIDR
	SearchIDR=$('#search-id-regional').val();
	if(!SearchIDR)
		SearchIDR='null';
	//SearchBD
	SearchBD=$('#SearchBD').val();
	if(!SearchBD)
		SearchBD='null';
	//SearchHRDV
	SearchHRDV=$('#SearchHRDV').val();
	if(!SearchHRDV)
		SearchHRDV='null';




	$('#maincontent').loading({
		stoppable: true,
        message: 'Chargement...',
        theme: 'dark'
      });
    
    url=encodeURI(url2);
    url=url.replace('Searchnom',Searchnom);
    url=url.replace('Searchprenom',Searchprenom);
    url=url.replace('SearchpIPP',SearchpIPP);
    url=url.replace('SearchIDR',SearchIDR);
    url=url.replace('SearchBD',SearchBD); 
    url=url.replace('SearchHRDV',SearchHRDV);
    url=url.replace('_GENRE',genre);
    url=url.replace('_screenheigth',screen.height);
    
	$('#maincontent').load(url);

	return false;
}

function changeother(idcheckbox){
	
	$(idcheckbox).prop('checked', false);
}
