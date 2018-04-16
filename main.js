
function getUsers(){
var endPoint= "functions.php?function=getUsers";
var xhr = new XMLHttpRequest();
		xhr.open('GET', endPoint, true);
		xhr.onload = function(){
			if (this.status == 200){
				var data = JSON.parse(this.response);
				var info = '';

				for (i=0; i<data.length; i++) {
					info += '<div id="'+data[i].id+'"><button onclick="viewUser('+data[i].id+')">View</button><button onclick="delUser('+data[i].id+')">Delete</button>'+data[i].lname+', '+data[i].fname+'</div>';
     			}
				document.getElementById('app').innerHTML = info;
			};
		};
		xhr.send();
};

function addUserForm(){
	var x = '';
	x += 'First Name: <input type="text" name="fname"><br>';
	x += 'Last Name: <input type="text" name="lname"><br>';
	x += 'Email: <input type="text" name="email"><br>';
	x += 'Password: <input type="password" name="password"><br>';
	x += 'Number: <input type="text" name="number"><br>';
	x += '<button onclick="addUser()">Add User</button>';
	document.getElementById('app').innerHTML = x;
}

function addUser(){
	var endPoint = "functions.php?function=addUser";

	var formData = new FormData();
	formData.append("fname", document.getElementsByName("fname")[0].value);
	formData.append("lname", document.getElementsByName("lname")[0].value);
	formData.append("email", document.getElementsByName("email")[0].value);
	formData.append("password", document.getElementsByName("password")[0].value);
	formData.append("number", document.getElementsByName("number")[0].value);

	var xhr = new XMLHttpRequest();
		xhr.open('POST', endPoint, true);
		xhr.onload = function(){
			if (this.status == 200){
				getUsers();
			};
		};
		xhr.send(formData);
}

function delUser(id){
	var endPoint = "functions.php?function=delUser&id="+id;
	var xhr = new XMLHttpRequest();
		xhr.open('GET', endPoint, true);
		xhr.onload = function(){
			if (this.status == 200){
				getUsers();
			};
		};
		xhr.send();
		
};

function viewUser(id){
	var endPoint = "functions.php?function=viewUser&id="+id;
	var xhr = new XMLHttpRequest();
		xhr.open('GET', endPoint, true);
		xhr.onload = function(){
			if (this.status == 200){
				var data = JSON.parse(this.response);
				var info = '';

					info += '<div class="viewInfo">';
					info += 'ID: '+data[0].id+' </br>';
					info += 'FIRST NAME: '+data[0].fname+' </br>';
					info += 'LAST NAME: '+data[0].lname+' </br>';
					info += 'EMAIL: '+data[0].email+' </br>';
					info += 'NUMBER: '+data[0].number+' </br>';

					info += '<button onclick="editUser('+data[0].id+')">EDIT</button>';

					info += '</div>';
     			
				document.getElementById('app').innerHTML = info;
			};
		};
		xhr.send();
		
};
function editUser(id){
var x = '';
	x += 'First Name: <input type="text" name="fnameEDIT"><br>';
	x += 'Last Name: <input type="text" name="lnameEDIT"><br>';
	x += 'Email: <input type="text" name="emailEDIT"><br>';
	x += 'Password: <input type="password" name="passwordEDIT"><br>';
	x += 'Number: <input type="text" name="numberEDIT"><br>';
	x += '<button onclick="updateUser('+id+')">Update User</button>';
	document.getElementById('app').innerHTML = x;
};
function updateUser(id){
	var endPoint = "functions.php?function=updateUser&id="+id;
	var formData = new FormData();
	formData.append("fname", document.getElementsByName("fnameEDIT")[0].value);
	formData.append("lname", document.getElementsByName("lnameEDIT")[0].value);
	formData.append("email", document.getElementsByName("emailEDIT")[0].value);
	formData.append("password", document.getElementsByName("passwordEDIT")[0].value);
	formData.append("number", document.getElementsByName("numberEDIT")[0].value);

	var xhr = new XMLHttpRequest();
		xhr.open('POST', endPoint, true);
		xhr.onload = function(){
			if (this.status == 200){
				viewUser(id);
			};
		};
		xhr.send(formData);
}