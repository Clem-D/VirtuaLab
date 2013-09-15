function allowDrop(ev)
{
    ev.preventDefault();
}
function drag(ev)
{
    ev.dataTransfer.setData("Text",ev.target.id);
}
function drop(ev)
{
    var img3 = document.getElementById('save1').value;
    var img4 = document.getElementById('save2').value;

    ev.preventDefault(); 
    var data=ev.dataTransfer.getData("Text");
    var biobrick = document.getElementById(data).cloneNode(true);
    
    var save = document.getElementById('save1');
    var img = biobrick.src;
    img = img.substring(img.lastIndexOf("/")+1,img.length);
    if (save.value!=''){
	document.getElementById('save2').value = img;	
    }
    else {
	save.value = img ;
    }
    var object = ev.target.appendChild(biobrick); 
}

function link(id,name){
    document.getElementById('detail').href="details.php?task="+id+"&title="+name;
}

/*
function changeState(){
    var id = document.forms['selectedState'].elements['save'].value;
    id2 = id - 1000;
    var image1 = document.getElementById(id2);
    var image2 = document.getElementById(id2+1);
    var button = document.getElementById(id);
    if(document.forms['selectedState'].elements['done'].checked==true){   
	image1.className = 'done';
	button.className = 'done';
	image2.className = 'in';	
    }  
}*/

function addInfo(id){
    var detail = document.getElementById('details');
    var save = document.getElementById('save').value = id;
    detail.className = 'detail';    
}

function addTask(id){
    //Recuperation des noms des deux parents
    var img1 = document.getElementById('save1').value;
    var img2 = document.getElementById('save2').value;

    document.getElementById('save1').value='';
    document.getElementById('save2').value='';

    var img3 = document.getElementById('save1').value;
    var img4 = document.getElementById('save2').value;

    //Calcul des id
    task_id = Number(id)+50;
    img_id = Number(id)-49;
    newtask_id = Number(id)+51;

    //Suppression de la div vide
    var task = document.getElementById(task_id);
    task.parentNode.removeChild(task);

    //Inclusion du code creant la nouvelle image
    var myAjax;

    if(window.XMLHttpRequest){
	myAjax = new XMLHttpRequest();
    }
    myAjax.open('POST','image.php',false);

    myAjax.onreadystatechange = function()
    {
	if(myAjax.readyState == 4 && myAjax.status == 200){
	  name=myAjax.responseText;
	  document.getElementById('level').innerHTML += "<div class='task' id="+task_id+" ondrop='drop(event)' ondragover='allowDrop(event)'><img src="+name+" id="+img_id+" draggable='true' ondragstart='drag(event)'></div>";
	}
    }
    
    myAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var parameter = "img1="+img1+"&img2="+img2;
    myAjax.send(parameter);
    
    //Ajout d'une division
    document.getElementById('level').innerHTML += " <div class='task' style='width:500px' id="+newtask_id+" ondrop='drop(event)' ondragover='allowDrop(event)'></div>";

    //Changement de l'identifiant du bouton
    var button_id = Number(newtask_id)-50;
    var button = document.getElementById(id);
    button.id = button_id;
}

