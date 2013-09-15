function allowDrop(ev)
{
    ev.preventDefault();
}
function drag(ev)
{
    ev.dataTransfer.setData("Text",ev.target.id);
}
function drop(ev,id)
{
    ev.preventDefault(); 
    var data=ev.dataTransfer.getData("Text");
    var biobrick = document.getElementById(data).cloneNode(true);
    
    var save = document.getElementById('save1');
    var img = biobrick.src;
    img = img.substring(img.lastIndexOf("/")+1,img.length);
    var brick = img.split('.')[0];
    var bool = confirm("Do you want to add : "+brick+"?");

    if (bool == true){
	if (save.value!=''){
	    document.getElementById('save2').value = img;	
	}
	else {
	    save.value = img ;
	}
	var object = ev.target.appendChild(biobrick); 
	stick(id);
    }
}

function link(id,name){
    document.getElementById('detail').href="details.php?task="+id+"&title="+name;
}

function addInfo(id){
    var detail = document.getElementById('details');
    var save = document.getElementById('save').value = id;
    detail.className = 'detail';    
}

function getName(id){
    var img = document.getElementById(id).value;
    document.getElementById(id).value='';
    return img; 
}

function deleteDiv(task_id){
    var task = document.getElementById(task_id);
    task.innerHTML='';
}

function createImage(task_id,img_id,img1,img2,button_id){
    var myAjax;
    if(window.XMLHttpRequest){
	myAjax = new XMLHttpRequest();
    }
    myAjax.open('POST','image.php',false);

    myAjax.onreadystatechange = function()
    {
	if(myAjax.readyState == 4 && myAjax.status == 200){
	  name=myAjax.responseText;
	    var img = document.createElement('img');
	    img.src = name;
	    img.id = img_id;
	    img.className = 'newBrick';
	    img.draggable='true';
	    img.setAttribute('ondragstart','drag(event)');
	    img.setAttribute("onclick","window.open('details.php?title="+name+"');");
	    var div = document.getElementById(task_id);
	    div.style.width = '';
	    div.appendChild(img);
	}
    }
    
    myAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var parameter = "img1="+img1+"&img2="+img2;
    myAjax.send(parameter);
}

function createDiv(newtask_id,id){
    var newDiv = document.createElement('div');
    newDiv.className = "task";
    newDiv.style.width = '300px';
    newDiv.id = newtask_id;
    newDiv.setAttribute('ondrop','drop(event,this.id)');
    newDiv.setAttribute('ondragover','allowDrop(event)');
    var button = document.getElementById(id);
   
    var parent = document.forms['button'];
    parent.insertBefore(newDiv,button);
}

function setButtonId(id,button_id){
    var button = document.getElementById(id);
    button.id = button_id;
}

function addButton(id,button_id){
    var button = document.createElement('button');
    button.type = 'button';
    button.id = button_id;
    button.setAttribute('onclick','addTask(this.id)');
    button.innerHTML = 'new Task';
    
    var level_button = document.getElementById(id);
   
    var parent = document.forms['button'];
    parent.insertBefore(button,level_button);
}

function stick(id){
    var inDiv = document.getElementById(id).innerHTML; 
    var nbImg = inDiv.match(new RegExp("img","g")).length;

    //si deux bricks ont été déplacées
    if(nbImg == 2){	
	var img1 = getName('save1');
	var img2 = getName('save2');
	var img_id = Number(id)-99;
	var button_id = Number(id)-50;
	//Suppression de la div vide
	deleteDiv(id);
	
	//Inclusion du code creant la nouvelle image
	createImage(id,img_id,img1,img2,button_id);	
    }
}

function addTask(id){
    //Calcul des id
    var task_id = Number(id)+50;
    var newtask_id = Number(id)+51;

    //ajout tache
    var button_id = Number(newtask_id)-50;
    //alert(button_id);
    setButtonId(id,button_id);  
  
    //Ajout d'une division
    createDiv(newtask_id,button_id);
    
    //ajout niveau
    var oldButton_id = Number(id) + 150;
    var button_id = Number(oldButton_id)+1;
    setButtonId(oldButton_id,button_id);
}

function addLevel(id){

    //Calcul des id
    var newButton_id = Number(id);
    var task_id = Number(id)-100;
    var newtask_id = Number(id)+50;

    //Changement de l'identifiant des boutons
    
    //ajout niveau
    button_id = Number(id)+150;// addLevel Button's id
    setButtonId(id,button_id);  

    //ajout tache 
    var oldButton_id = Number(id)-150;
    addButton(button_id,newButton_id);

    //Ajout d'une division
    var newBr = document.createElement('br');
    var button = document.getElementById(newButton_id);
    var parent = document.forms['button'];

    parent.insertBefore(newBr,button); 
    
    createDiv(newtask_id,newButton_id);
}
