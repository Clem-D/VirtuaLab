//To add a new experiment

function addExperiment()
{
    var nb = document.getElementById('nbExperiment');
    var value =  nb.value; 
    value = Number(value) + 1;
    nb.value = value;
    
    var parent = document.forms['experiment'];
    
    var myAjax;
    if(window.XMLHttpRequest){
	myAjax = new XMLHttpRequest();
    }
    myAjax.open('POST','newExperiment.php',false);

    myAjax.onreadystatechange = function()
    {
	if(myAjax.readyState === 4 && myAjax.status === 200){
	    var dates = myAjax.responseText;
            //For new form
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'saveTask.php';
            form.name = value;
            
            //For title
            var title = document.createElement('h3');
            title.innerHTML = 'Experiment '+value;
            form.appendChild(title);
            var br = document.createElement('br');
            form.appendChild(br);
            
            //For date
            var label = document.createElement('label');
            label.setAttribute('for','date');
            label.innerHTML = 'Date : ';        
            form.appendChild(label);
            
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'date';
            input.value = dates;
            form.appendChild(input);
            
            br = document.createElement('br');
            form.appendChild(br);
            br = document.createElement('br');
            form.appendChild(br);
            
            //For laboratory technician
            label = document.createElement('label');
            label.setAttribute('for','technician');
            label.innerHTML = 'Laboratory technician : ';        
            form.appendChild(label);
            
            input = document.createElement('input');
            input.name = 'technician';
            input.type = 'text';
            form.appendChild(input);
            
            br = document.createElement('br');
            form.appendChild(br);
            br = document.createElement('br');
            form.appendChild(br);
            
            //For methode
            label = document.createElement('label');
            label.setAttribute('for','method');
            label.innerHTML = 'Method : ';        
            form.appendChild(label);
            
            var input = document.createElement('input');
            input.name = 'method';
            input.type = 'text';
            form.appendChild(input);
            
            br = document.createElement('br');
            form.appendChild(br);
            br = document.createElement('br');
            form.appendChild(br);
            
            //For antibiotic
            
            label = document.createElement('label');
            label.setAttribute('for','antiB');
            label.innerHTML = 'Antibiotic(s) : ';  
            form.appendChild(label);
            
            input = document.createElement('select');
            input.name = 'antiB';
            
            input.options[input.length]=new Option('Ampicillin','AmpR');
            input.options[input.length]=new Option('Kanamycin','KanR');
            input.options[input.length]=new Option('Chloramphenicol','ChloR');
            input.options[input.length]=new Option('Tetracyclin','TetR');
            
            form.appendChild(input);
            
            //var button = document.createElement('button');
            //button.type = 'button';
            //button.innerHTML = 'Add an antibiotic'; 
            //button.id = 'newA';
            //var param = 'newAntibiotic('+parent+',this.id)';
            //button.setAttribute('onclick',param);
            //parent.appendChild(button);
            
            br = document.createElement('br');
            form.appendChild(br);
            br = document.createElement('br');
            form.appendChild(br);
            
            //For comments
            label = document.createElement('label');
            label.setAttribute('for','comments');
            label.innerHTML = 'Annotations : ';        
            form.appendChild(label);
            
            input = document.createElement('textarea');
            input.name = 'comments';
            form.appendChild(input);
            
            var br = document.createElement('br');
            form.appendChild(br);
            var br = document.createElement('br');
            form.appendChild(br);
            
            //For progress
            label = document.createElement('label');
            label.setAttribute('for','progress');
            label.innerHTML = 'Succeed : ';        
            form.appendChild(label);
            
            input = document.createElement('input');
            input.type = 'radio';
            input.name = 'progress';
            input.value = 'yes';
            label = document.createTextNode(' Yes');        
            form.appendChild(input);
            form.appendChild(label);
            
            input = document.createElement('input');
            input.type = 'radio';
            input.name = 'progress';
            input.value = 'no';
            label = document.createTextNode(' No');
            form.appendChild(input);
            form.appendChild(label);
            
            br = document.createElement('br');
            form.appendChild(br);
            br = document.createElement('br');
            form.appendChild(br);
            
            //For button 'save'
            var button = document.createElement('input');
            button.type = 'submit';
            button.value = 'Save'; 
            form.appendChild(button);
            
            parent.appendChild(form);
            
            br = document.createElement('br');
            parent.appendChild(br);
            br = document.createElement('br');
            parent.appendChild(br);
	}
    }
    
    myAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    myAjax.send(null);
    
}