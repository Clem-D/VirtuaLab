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

    if (bool === true){
		if (save.value !==''){
	    	document.getElementById('save2').value = img;	
		}
		else {
			save.value = img ;
		}
		var object = ev.target.appendChild(biobrick); 
		var title = document.getElementById('title'); 
		var project = title.innerHTML;
		stick(id,project);
    }
}

function getName(id)
{
    var img = document.getElementById(id).value;
    document.getElementById(id).value='';
    return img; 
}

function deleteDiv(task_id)
{
    var task = document.getElementById(task_id);
    task.innerHTML='';
}

function createImage(task_id,img_id,img1,img2,button_id)
{
    var myAjax;
    if(window.XMLHttpRequest){
		myAjax = new XMLHttpRequest();
    }
    myAjax.open('POST','image.php',false);

    myAjax.onreadystatechange = function()
    {
	if(myAjax.readyState === 4 && myAjax.status === 200){
	  name=myAjax.responseText;
	    var img = document.createElement('img');	    
	    var title = name.split('/')[2];
	    title = title.split('.')[0];
	    img.src = name;
	    img.id = img_id;
	    img.className = 'newBrick';
	    img.draggable='true';
	    img.setAttribute('ondragstart','drag(event)');
	    img.setAttribute("onclick","window.open('details.php?title="+title+"');");
            
            var text = document.createElement('em');
            text.innerHTML = 'Click to see or modify data about this task';
	    var div = document.getElementById(task_id);
	    div.style.width = '';
	    div.appendChild(img);
            div.appendChild(text);
	}
    }
    
    myAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var parameter = "img1="+img1+"&img2="+img2;
    myAjax.send(parameter);
    return name;
}

function createDiv(newtask_id,id,level)
{
    var newDiv = document.createElement('div');
    newDiv.className = "task";
    var width = (Number(level)+1)*180;
    newDiv.style.width = width+'px';
    newDiv.id = newtask_id;
    newDiv.setAttribute('name',level);
    newDiv.setAttribute('ondrop','drop(event,this.id)');
    newDiv.setAttribute('ondragover','allowDrop(event)');
    var button = document.getElementById(id);    
   
    var parent = document.forms['button'];
    parent.insertBefore(newDiv,button);
    return newDiv;
}

function setButtonId(id,button_id)
{
    var button = document.getElementById(id);
    button.id = button_id;
}

function addButton(id,button_id)
{
    var button = document.createElement('button');
    
    var old_id = Number(button_id)-150;
    var name = document.getElementById(old_id).name;
    //alert(name);
    var new_name = Number(name)+1;
    
    button.type = 'button';
    button.id = button_id;
    button.setAttribute('onclick','addTask(this.id)');
    button.innerHTML = 'new Task';
    button.name = new_name;
    
    var level_button = document.getElementById(id);
   
    var parent = document.forms['button'];
    parent.insertBefore(button,level_button);
    
    return new_name;
}

function save(id,name,project){
    
    var level = document.getElementById(id);
    var myAjax;
    level = level.getAttribute('name');
    
    if(window.XMLHttpRequest){
	myAjax = new XMLHttpRequest();
    }
    
    myAjax.open('POST','saveProject.php',false);
    
    myAjax.onreadystatechange = function()
    {
	if(myAjax.readyState === 4 && myAjax.status === 200){
	  var test=myAjax.responseText;          
        }
    }
    myAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var parameter = "level="+level+"&name="+name+"&project="+project;
    myAjax.send(parameter);    
}

function stick(id,project)
{
    var inDiv = document.getElementById(id).innerHTML; 
    var nbImg = inDiv.match(new RegExp("img","g")).length;

    //if 2 biobricks in the div
    if(nbImg === 2){	
	var img1 = getName('save1');
	var img2 = getName('save2');
	var img_id = Number(id)-99;
	var button_id = Number(id)-50;
	//to delete the empty div
	deleteDiv(id);
	
	//to create a new image
	var name = createImage(id,img_id,img1,img2,button_id);
        
        //To save the new task
        save(id,name,project);
    }
}

function addTask(id)
{
    //to calculate id
    var newtask_id = Number(id)+51;

    //to add a task
    var button_id = Number(newtask_id)-50;
    setButtonId(id,button_id);  
  
    //to add a div
    var level = document.getElementById(button_id).name;
    createDiv(newtask_id,button_id,level);
    
    //to add a level
    var oldButton_id = Number(id) + 150;
    var button_id = Number(oldButton_id)+1;
    setButtonId(oldButton_id,button_id);
}

function addTask2(id)
{
    //to calculate id
    var newtask_id = Number(id)+51;

    //to add a task
    var button_id = Number(newtask_id)-50;
    setButtonId(id,button_id);  
  
    //to add a div
    var level = document.getElementById(button_id).name;
    createDiv(newtask_id,button_id,level);
}

function addLevel(id)
{
    
    //to calculate  ids
    var newButton_id = Number(id);
    var newtask_id = Number(id)+50;
    var previousButton = Number(id)-150;

    //to change button's ids
    
    //to add a level
    button_id = Number(id)+150;// addLevel Button's id
    setButtonId(id,button_id);  
    //to add a task 
    var name = addButton(button_id,newButton_id);
    //to modify previous button task
    previousButton = document.getElementById(previousButton);
    previousButton.setAttribute('onclick','addTask2(this.id)');

    //to add a div
    var newBr = document.createElement('br');
    var button = document.getElementById(newButton_id);
    var parent = document.forms['button'];

    parent.insertBefore(newBr,button); 
    
    var newDiv = document.createElement('div');
    newDiv.className = "level2";
    newDiv.innerHTML = "Level "+ (Number(name)+1);
    var newButton = document.getElementById(newButton_id);
    var parent = document.forms['button'];
    parent.insertBefore(newDiv,newButton);
    
    var level = Number(name);
    createDiv(newtask_id,newButton_id,level);
}

//To drag and drop

//To create a new biobrick

//To create a new frame
