function allowDrop(ev)//to allow to drop a picture
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
    //to get the data related to the event
    var data=ev.dataTransfer.getData("Text");
    var biobrick = document.getElementById(data).cloneNode(true);//and make a clone of it
    
    //to get what is save in "save1"
    var save = document.getElementById('save1');

    //to only keep the name of the biobrick moved by the user
    var img = biobrick.src;
    img = img.substring(img.lastIndexOf("/")+1,img.length);
    var brick = img.split('.')[0];
    var bool = confirm("Do you want to add : "+brick+"?");

    //if the user confirm he wants to move this biobrick,
    if (bool === true){ 
	if (save.value !==''){//"save1" is not empty, so the moved biobrick is the second one that composes the new assembly (=task)
	    document.getElementById('save2').value = img;//it's name is saved in "save2"	
	}
	else {//if it's the first one
	    save.value = img ; //it's saved in "save1"
	}
	var object = ev.target.appendChild(biobrick); 

        var title = document.getElementById('title'); 
        var project = title.innerHTML;
	stick(id,project); //to create the new task
    }
}

function getName(id)//to get the name of the image : value corresponding to the id,
{
    var img = document.getElementById(id).value;
    document.getElementById(id).value='';//and to delete this value
    return img; 
}

function deleteDiv(task_id)
{
    var task = document.getElementById(task_id);
    task.innerHTML='';
}

function createImage(task_id,img_id,img1,img2,button_id)//to create a new image
{
    var myAjax;
    if(window.XMLHttpRequest){
	myAjax = new XMLHttpRequest();
    }
    myAjax.open('POST','image.php',false);//file that will create the image

    myAjax.onreadystatechange = function()
    {
	if(myAjax.readyState === 4 && myAjax.status === 200){//if "image.php" is over and has occured normaly
	    name=myAjax.responseText; //we get the name of the new image return by "image.php"
	    var img = document.createElement('img');//create a new tag "img"	    
	    var title = name.split('/')[2];
	    title = title.split('.')[0];
	    img.src = name; //fill it with the image's name
	    img.id = img_id;//its id
	    img.className = 'newBrick';//its CSS class
	    //and fix its attribute : to be able to drag and drop it, and click on it
	    img.draggable='true';
	    img.setAttribute('ondragstart','drag(event)');
	    img.setAttribute("onclick","window.open('details.php?title="+title+"');");
            
	    //to create a window that appears when the mouse is on the image
            var text = document.createElement('em');
            text.innerHTML = 'Click to see or modify data about this task';
	    var div = document.getElementById(task_id);
	    div.style.width = '';
	    div.appendChild(img);
            div.appendChild(text);
	}
    }
    
    myAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //to send parameters to "image.php" (POST method)
    var parameter = "img1="+img1+"&img2="+img2;
    myAjax.send(parameter);

    return name;
}

function createDiv(newtask_id,id,level)//to create a new div that can be drag and drop
{
    var newDiv = document.createElement('div');
    newDiv.className = "task";

    //to calculate the length of this new div
    var width = (Number(level)+1)*180;
    newDiv.style.width = width+'px';

    //and to set its attribute
    newDiv.id = newtask_id;
    newDiv.setAttribute('name',level);
    newDiv.setAttribute('ondrop','drop(event,this.id)');
    newDiv.setAttribute('ondragover','allowDrop(event)');

    var button = document.getElementById(id);    
   
    //the div is inserted before the button "new level"
    var parent = document.forms['button'];
    parent.insertBefore(newDiv,button);
    return newDiv;
}

function setButtonId(id,button_id)//to give a new id to a button
{
    var button = document.getElementById(id);
    button.id = button_id;
}

function addButton(id,button_id)//to create a new button
{
    var button = document.createElement('button');
    
    var old_id = Number(button_id)-150;
    var name = document.getElementById(old_id).name;
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

function save(id,name,project){//to save the new task in the project
    
    var level = document.getElementById(id); //to get the level where is this new assembly
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
    //To send parameters to "saveProject" (POST method)
    var parameter = "level="+level+"&name="+name+"&project="+project;
    myAjax.send(parameter);    
}

function stick(id,project) //to create the image corresponding to the new assembly : get informations
{
    var inDiv = document.getElementById(id).innerHTML; //to get the element into the div corresponding to the id (task id)
    var nbImg = inDiv.match(new RegExp("img","g")).length; //to search the world 'img' in it, and count its occurence

    //if 2 biobricks in the div
    if(nbImg === 2){	
	//to get the names of the 2 biobricks
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

function addTask(id) //activate when the button "new task" is pressed. ONLY FOR THE FIRST LEVEL
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

function addTask2(id) //activate when the button "new task" is pressed. FROM THE SECOND LEVEL
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

function addLevel(id) //activate when the button "new level" is pressed
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
    createDiv(newtask_id,newButton_id,level);//to create the first div of the level
}
