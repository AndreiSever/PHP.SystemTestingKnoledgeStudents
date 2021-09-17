var d = document;
	function del_spaces(str)
	{
		str = str.replace(/\s/g, '');
		return str;
	}
	$(function(){
		$("#profile").on("click", function(){
			//<div class="alert"><p></div>
			
				var login = del_spaces(d.getElementById('login').value);
				var forename = d.getElementById('forename').value;
				var name = d.getElementById('name').value;
				var thirdname = d.getElementById('thirdname').value;
				var email = d.getElementById('email').value;
				var oldPassword = d.getElementById('oldPassword').value;
				var password = d.getElementById('password').value;
				var password2 = d.getElementById('password2').value;
				var flag=0;
				var text="";
				
				if (login==""){
					flag=1;
					text+="Поле с логином обязательно к заполнению!\r\n";
					//alert('Поле с логином обязательно к заполнению!');
				}
				if (password!="" && password2!="" && password!=password2){
					flag=1;
					text+="Пароли не совпадают!";
					//alert('Пароли не совпадают');
				}
				if (flag==1) alert(text);
				//alert(flag)
				if (flag==0){
					uri="/users/profile_sql/";
					params="edit=ok";
					params+="&login="+login;
					params+="&forename="+forename;
					params+="&name="+name;
					params+="&thirdname="+thirdname;
					params+="&email="+email;
					params+="&oldPassword="+oldPassword;
					params+="&password="+password;
					params+="&password2="+password2;
					//alert(login);
					//params+="&id="+q;
					sqlEditProfile(params,uri);
				}
				//alert(q);
				//alert("fds")
			});
	});
	function sqlEditProfile(params,uri){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{	
						//document.getElementById("foot").innerHTML = request.responseText;
						var mes= request.responseText.match(/<mes>(.*)<\/mes>/)[1];
						var mesemail= request.responseText.match(/<mesemail>(.*)<\/mesemail>/)[1];
						var mespass= request.responseText.match(/<mespass>(.*)<\/mespass>/)[1];
						if (mes=="No"){
							alert("Такой логин уже существует!");
						}
						if (mes=="Ok"){
							alert("Данные успешно сохранены!(Логин,Фамилия,Имя,Отчество)");
						} 
						if (mespass=="Nopass"){
							alert("Не вверно введен старый пароль!");
						}
						if (mespass=="Okpass"){
							alert("Новый пароль успешно сохранен!");
						} 
						if (mesemail=="No"){
							alert("Такой email уже существует!");
						}
						if (mesemail=="Ok"){
							alert("Новый email успешно сохранен!Письмо с подтверждением отправлено на новую почту.");
						} 
						
						 //alert(request.responseText);
						 //callback(id,request);
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	//////////////// Функции для просмотра результата тестирования , а именно вопросов 
	function viewQuestion(r){
		var q = r.parentNode.parentNode.getElementsByTagName('td')[0].getElementsByTagName('span')[0].innerHTML;
		//alert(q);
		uri="/adminpanel/result_table_sql/";
		params="view=ok";
		params+="&id="+q;
		sqlViewQuestionWithCallback(params,uri,q,callbackForViewtQuestion)

	}
	function callbackForViewtQuestion(id,request){
		var	mes=JSON.parse(request.responseText);
		
		if (mes.mesedit=="Ok"){
			var length = mes.length;
			for (var i=0;i<=length-1;i++){
				if (mes[i].ans=="1"){
					document.getElementsByClassName("simple-popup-content")[0].getElementsByClassName("view")[0].innerHTML+=("<div class='greendiv'><h4><p><span  class='greenspan'>Верный ответ</span></h4>"+
						"<p><span>"+mes[i].name+"</span></div>");
					if (mes[i].image!=""){
						document.getElementsByClassName("simple-popup-content")[0].getElementsByClassName("view")[0].innerHTML+="<div class='greendiv'><br/><div class='image1'><img src='/image_result/"+mes[i].image+"'  /></div><br/></div>";
					}
					document.getElementsByClassName("simple-popup-content")[0].getElementsByClassName("view")[0].innerHTML+=("<div class='greendiv'><h4><p><span class='resulttext'>Варианты ответов:</span></h4>"+
						"<p>"+mes[i].var1+
						"<p>"+mes[i].var2+
						"<p>"+mes[i].var3+
						"<p>"+mes[i].var4+
						"<p>"+mes[i].var5+
						"<p>"+mes[i].var6+
						"<h4><p><span class='resulttext'>Ответ:</span></h4>"+
						"<p>"+mes[i].ans1+
						"<p>"+mes[i].ans2+
						"<p>"+mes[i].ans3+
						"<p>"+mes[i].ans4+
						"<p>"+mes[i].ans5+
						"<p>"+mes[i].ans6+"</div><br/>"
						);
				}else{
					document.getElementsByClassName("simple-popup-content")[0].getElementsByClassName("view")[0].innerHTML+=("<div class='reddiv'><h4><p><span  class='redspan'>Не верный ответ</span></h4>"+
						"<p><span>"+mes[i].name+"</span></div>");
					if (mes[i].image!=""){
						document.getElementsByClassName("simple-popup-content")[0].getElementsByClassName("view")[0].innerHTML+="<div class='reddiv'><br/><div class='image1'><img src='/image_result/"+mes[i].image+"'  /></div><br/></div>";
					}
					document.getElementsByClassName("simple-popup-content")[0].getElementsByClassName("view")[0].innerHTML+=("<div class='reddiv'><h4><p><span class='resulttext'>Варианты ответов:</span></h4>"+
						"<p>"+mes[i].var1+
						"<p>"+mes[i].var2+
						"<p>"+mes[i].var3+
						"<p>"+mes[i].var4+
						"<p>"+mes[i].var5+
						"<p>"+mes[i].var6+
						"<h4><p><span class='resulttext'>Ответ:</span></h4>"+
						"<p>"+mes[i].ans1+
						"<p>"+mes[i].ans2+
						"<p>"+mes[i].ans3+
						"<p>"+mes[i].ans4+
						"<p>"+mes[i].ans5+
						"<p>"+mes[i].ans6+"</div><br/>"
						);
				}
			}
		}
		if (mes.mesedit=="No")	{
			$("#simple-popup-backdrop").remove();
			$("#simple-popup").remove();
		}
	}
	function sqlViewQuestionWithCallback(params,uri,id,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						//alert( document.getElementById("foot").innerHTML = request.responseText);
						 //alert(request.responseText);
						 callback(id,request);
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	/////////////
	////////Функции для сохранения результатов теста
	function saveToFileResult(input,numberTest){
		var tableId =input.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('table')[0].id;
		var a=$('#'+tableId+'>tbody > tr'); 
		var out=new Array();
		params="saveToFile=ok";
		if (a[0].className!="default"){
			for (var x=0; x<=a.length-1;x++){ //перебераем все объекты 
				var tdCount=a[x].getElementsByTagName('td');
				out[x]=new Array();
				//alert(a.length);
				for (var y=1; y<tdCount.length-1;y++){
						out[x][y-1]=tdCount[y].getElementsByTagName('span')[0].innerHTML;
						params+="&array["+x+"]["+(y-1)+"]="+out[x][y-1];
						//alert(out[x][y-1])
				}	
			}
			params+='&numberTest='+numberTest;
			uri = "/adminpanel/result_table_sql/";
			sqlForSaveResult(params,uri,numberTest);
		}

	}
	function sqlForSaveResult(params,uri,numberTest){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						//document.getElementById("foot").innerHTML = request.responseText;
						//alert(request.responseText);
						location.href="/adminpanel/file_result/"+numberTest;
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	/////////// Функции для теста
	function activeTab(r){
		//alert(r.innerHTML)
		$('.tab-pane').removeClass('tab-pane active').addClass('tab-pane');
		$('.tab-pane[id="'+r.innerHTML+'"]').addClass('tab-pane active');
	}
	$('.nav-tabs li:first').addClass('active');
	$('.tab-pane:first').addClass('tab-pane active');
	function saveResultTest(r){
		var headers= d.getElementsByClassName('nav nav-tabs')[0].getElementsByTagName('a');
		var count = d.getElementsByClassName('nav nav-tabs')[0].getElementsByTagName('a').length;
		var countTabPane=d.getElementsByClassName('tab-pane');

		uri = "/userpanel/test_sql/"+r;
		params='savetoresult=ok';
		for (var j=0; j<=count-2;j++){
			params+="&headers["+j+"]="+headers[j].id;
			
		}
		for (var x=0; x<=countTabPane.length-2;x++){
			for (var y=0;y<=countTabPane[x].getElementsByTagName('input').length-1;y++){
				if (countTabPane[x].getElementsByTagName('input')[y].checked == true){
					params+="&tabpane["+x+"]["+y+"]="+countTabPane[x].getElementsByTagName('span')[y].innerHTML;
					//alert(countTabPane[x].getElementsByTagName('span')[y].innerHTML);
				}
			}
		}
		for (var x=0; x<=countTabPane.length-2;x++){
			for (var y=0;y<=countTabPane[x].getElementsByTagName('input').length-1;y++){
				//if (countTabPane[x].getElementsByTagName('input')[y].checked == true){
					params+="&taball["+x+"]["+y+"]="+countTabPane[x].getElementsByTagName('span')[y].innerHTML;
					//alert(countTabPane[x].getElementsByTagName('span')[y].innerHTML);
				//}
			}
		}
		sqlSaveResult(r,params,uri);
	}
	function sqlSaveResult(id,params,uri){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						// document.getElementById("foot").innerHTML = request.responseText;
						var mes= request.responseText.match(/<mes>(.+)<\/mes>/)[1];
						if (mes=="No"){
							location.reload();
						}
						if (mes=="Ok"){
							window.location.href="/userpanel/resulttest/"+id;
						} 
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	////////////
	////PrewiewTest
	function startTest(id){
		uri = "/userpanel/prewiewTest_sql/"+id;
		params='start=ok';
		//params+='&name='+name;
		sqlstartTest(id,params,uri);
	}
	function sqlstartTest(id,params,uri){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{	
						//alert(request.responseText);
						//document.getElementById("foot").innerHTML = request.responseText;
						var mes= request.responseText.match(/<mes>(.+)<\/mes>/)[1];
						if (mes=="No"){
							alert("Количество вопросов для теста меньше,чем нужно!Подойдите к преподавателю, чтобы это исправить.");
						}
						if (mes=="Ok"){
							window.location.href="/userpanel/test/"+id;
						} 
						 //callback(name,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	////
	///////// Функции для Create_group_students
	function addRow(tableId)
	{
		// Считываем значения с формы
		var name = d.getElementById('group').value;
		
		if (name!=""){
			for (var x=0;x<=d.getElementById(tableId).rows.length-1; x++){
				if (d.getElementById(tableId).getElementsByTagName('tr')[x].classList.contains('default')){
					d.getElementById(tableId).getElementsByClassName('default')[0].remove();
				}
			}
			
			uri = "/adminpanel/create_group_sql/";
			params='add=ok';
			params+='&name='+name;
			sqladdgroupcallbeck(name,params,uri,addgroupcallbeck);
			
		}
	}
	function addgroupcallbeck(name,request){
		var mes= request.responseText.match(/<mes>(.+)<\/mes>/)[1];
		if (mes=="Ok"){
			// Находим нужную таблицу
			var tbody = d.getElementById('datatableAdd').getElementsByTagName('TBODY')[0];
			var add=$('.add');
			
			// Создаем строку таблицы и добавляем ее
			var row = d.createElement("TR");
			
			tbody.appendChild(row);
			//for (var y=0; y<add.length;y++){
			var li = d.createElement("li");
			add[0].appendChild(li);
			li.className= "Delete";
			li.innerHTML = '<a  href="/adminpanel/table_list_student/'+name+'">'+name+'</a>';
			var li1 = d.createElement("li");
			add[1].appendChild(li1);
			li1.className= "Delete";
			li1.innerHTML = '<a  href="/adminpanel/list_name_config/'+name+'">'+name+'</a>';
			var li2 = d.createElement("li");
			add[2].appendChild(li2);
			li2.className= "Delete";
			li2.innerHTML = '<a  href="/adminpanel/result_table/'+name+'">'+name+'</a>';
			//}

			row.className = "even pointer";
			// Создаем ячейки в вышесозданной строке
			// и добавляем тх
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");
			td1.className= "a-center";
			row.appendChild(td1);
			row.appendChild(td2);
			
			// Наполняем ячейки
			td1.innerHTML = "<input type='checkbox' class='flat' name='table_records' />";
			td2.innerHTML = name;
			checkboxStyle();
		}
		
		if (mes=="No")	alert("Данная группа уже существует!");
	}
	function sqladdgroupcallbeck(name,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 callback(name,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function deleteRow(r){
		var a=$('tbody > tr'); //выбираем все отмеченные checkbox
		var out=[];
		var delet=$('.Delete');
		for (var x=0; x<a.length;x++){ //перебераем все объекты 
		if (a[x].className=='even pointer selected'){
			out.push(a[x].getElementsByTagName('td')[1].innerHTML);
			for (var y=0; y<delet.length;y++){	
				if (delet[y].getElementsByTagName('a')[0].innerHTML==a[x].getElementsByTagName('td')[1].innerHTML){
						delet[y].remove();
					}
				}
			a[x].remove();
			}
		}
		uri = "/adminpanel/create_group_sql/";
		params='delete[]='+out;
		console.log(out);
		sql(params,uri);
		rowAmountForDefaultNameTest(r);//Сообщения что данные отсутствуют, берется из функции для вопросов 
	}									//потому что одинаковое количество столбцов
	/////////////////////
	/// Функции удаления для списка тестов , а именно их имен.
	function deleteRowNameTest(r,uriN){
		var a=$('#'+r+'>tbody > tr'); //выбираем все отмеченные checkbox
		var out=[];
		for (var x=0; x<a.length;x++){ //перебераем все объекты 
			var tdCount=a[x].getElementsByTagName('td');
			if (a[x].className=='even pointer selected'){
					out.push(tdCount[1].getElementsByTagName('span')[0].innerHTML);
					console.log(out);
				a[x].remove();
			}
		
		}
		uri = uriN;
		params='delete[]='+out;
		sql(params,uri);
		rowAmountForDefaultNameTest(r);
		changePage(r);
	}
	function rowAmountForDefaultNameTest(r){
		var table=d.getElementById(r).rows.length-1;
		if (table<=0){
			var tbody = d.getElementById(r).getElementsByTagName('TBODY')[0];
			var row = d.createElement("TR");
			tbody.appendChild(row);
			row.className = "default";
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");

			td1.className= "a-center";
			row.appendChild(td1);
			row.appendChild(td2);
			// Наполняем ячейки
			td2.innerHTML = 'Данные отсутствуют!';
			

		}
	}
	/////
	//Создание теста
	function selchange(r,value){
		var select=r.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('select');
		//r.options[2].selected=true;
		uri = "/adminpanel/create_config_test_sql/";
		params='change=ok';
		params+='&id='+value;
		//alert(value);
		sqlChangeConfigTestWithCallback(select,params,uri,callbackForConfigTest);
	}
	function callbackForConfigTest(select,request){
		var mes= request.responseText.match(/<meschange>(.+)<\/meschange>/)[1];
		var id1=[];
		var name1=[];
		var st;
		//st=select[0].value;
		//alert(request.responseText);
		for (var h=1;h<=select.length-1;h++){
			st=select[h].getElementsByTagName('option');
			//alert(h);
			if (st.length!=null){
				select[h].innerHTML="";
			}
		
			if (mes=="Ok"){
				//reg=/<id>(.+)<\/id>/;
				var id=request.responseText.match(/<id>(.*)<\/id>/g);
				var name=request.responseText.match(/<name>(.*)<\/name>/g);
				for (var i=0;i<=id.length-1;i++){
					text=String(id[i]);
					id1[i]=text.match(/<id>(.*)<\/id>/)[1];
				}
				for (var y=0;y<=name.length-1;y++){
					text=String(name[y]);
					name1[y]=text.match(/<name>(.*)<\/name>/)[1];
				}
				for (var j=0;j<=name.length-1;j++){
					select[h].innerHTML += "<option value='"+id1[j]+"' >"+name1[j]+"</option>";
				}
				
			}
		}

		if (mes=="No")	alert("Данный направления нет!");
	}
	function sqlChangeConfigTestWithCallback(select,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 callback(select,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}

	function addTableTest(r){
		select=r.parentNode;
		//var count = document.getElementsByClassName('table-day').length;
		//document.getElementsByClassName('table-day')[0].id="1";
		//alert(count)
		uri = "/adminpanel/create_config_test_sql/";
		params='add=ok';
		//alert(value);
		sqlAddConfigTestWithCallback(select,params,uri,callbackForAddConfigTest);
	}
	function callbackForAddConfigTest(select,request){

			var div = d.createElement("div");
			select.appendChild(div);
			div.className = "table-day";
			
			var table = d.createElement("table");
			div.appendChild(table);
			table.className = "table table-striped";
			
			var thead = d.createElement("thead");
			table.appendChild(thead);
			
			var tr = d.createElement("tr");
			thead.appendChild(tr);
			
			var th1 = d.createElement("th");
			tr.appendChild(th1);
			
			var th2 = d.createElement("th");
			tr.appendChild(th2);
			
			var div1=d.createElement("div");
			th1.appendChild(div1);
			div1.className = "input-group";
			
			var label=d.createElement("label");
			div1.appendChild(label);
			label.className = "input-group-addon";
			label.innerHTML="Направление";
			
			var select2=d.createElement("select");
			div1.appendChild(select2);
			select2.className = "form-control";
			select2.setAttribute("onChange","selchange(this,this.value);")
			th2.innerHTML+='<a class="delete-day btn btn-danger" onclick="deleteTestConfig(this)" style="margin-bottom: 10px;">Удалить направление</a> ';
			
			var tbody = d.createElement("tbody");
			table.appendChild(tbody);
			
			var tr = d.createElement("tr");
			tbody.appendChild(tr);
			tbody.className = "crudable";
			
			var td1 = d.createElement("td");
			tr.appendChild(td1);
			
			var div2=d.createElement("div");
			td1.appendChild(div2);
			div2.className = "input-group";
			
			var label1=d.createElement("label");
			div2.appendChild(label1);
			label1.className = "input-group-addon";
			label1.innerHTML="Подтемы";
			
			var select1=d.createElement("select");
			div2.appendChild(select1);
			select1.className = "form-control";
			
			var td2 = d.createElement("td");
			tr.appendChild(td2);
			
			var div3=d.createElement("div");
			td2.appendChild(div3);
			div3.className = "input-group";
			
			var td3 = d.createElement("td");
			tr.appendChild(td3);
			
			var td4 = d.createElement("td");
			tr.appendChild(td4);
			
			div3.innerHTML+='<label class="input-group-addon"> Количество вопросов </label>';
			div3.innerHTML+='<input class="form-control" value="" name="time" type="number">';
			td3.innerHTML+='<div class="crudable-create btn btn-info">+</div>';
			td4.innerHTML+='<div class="crudable-delete btn btn-danger">-</div>';
			
			var mes= request.responseText.match(/<mesdir>(.+)<\/mesdir>/)[1];
			if (mes=="Ok"){
				var mes1= request.responseText.match(/<messub>(.+)<\/messub>/)[1];
				var id1=[];
				var name1=[];
				if (mes1=="Ok"){
					var id=request.responseText.match(/<idsub>(.*)<\/idsub>/g);
					var name=request.responseText.match(/<namesub>(.*)<\/namesub>/g);
					for (var i=0;i<=id.length-1;i++){
						text=String(id[i]);
						id1[i]=text.match(/<idsub>(.*)<\/idsub>/)[1];
					}
					for (var y=0;y<=name.length-1;y++){
						text=String(name[y]);
						name1[y]=text.match(/<namesub>(.*)<\/namesub>/)[1];
					}
					for (var j=0;j<=name.length-1;j++){
						select1.innerHTML += "<option value='"+id1[j]+"' >"+name1[j]+"</option>";
					}
						
				}
				if (mes=="Ok"){
						//reg=/<id>(.+)<\/id>/;
					var id=request.responseText.match(/<iddir>(.*)<\/iddir>/g);
					var name=request.responseText.match(/<namedir>(.*)<\/namedir>/g);
						//alert(id[1]);
					for (var i=0;i<=id.length-1;i++){
						text=String(id[i]);
						id1[i]=text.match(/<iddir>(.*)<\/iddir>/)[1];
					}
					for (var y=0;y<=name.length-1;y++){
						text=String(name[y]);
						name1[y]=text.match(/<namedir>(.*)<\/namedir>/)[1];
					}
					for (var j=0;j<=name.length-1;j++){
						select2.innerHTML += "<option value='"+id1[j]+"' >"+name1[j]+"</option>";
					}		
				}
			}
		$('.crudable').crudable();
		//if (mes=="No")	alert("Данный направления нет!");
	}
	function deleteTestConfig(r){
		r.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
	}
	function sqlAddConfigTestWithCallback(select,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 callback(select,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function saveConfigTest(){
		var table= d.getElementsByClassName('table-day');
		var count = d.getElementsByClassName('table-day').length;
		var numberGroup=d.getElementById('direct').value;
		var nameTest=d.getElementById('nameTest').value;
		var direct=new Array();
		var countRow;
		var select;
		var input;
		uri = "/adminpanel/create_config_test_sql/";
		params='savetodb=ok';
		
		for (var x=0; x<=count-1;x++){
			direct[x] = table[x].getElementsByTagName('select')[0].value;
			countRow= table[x].getElementsByTagName('select').length-1;
			for (var y=1;y<=countRow;y++){
				select = table[x].getElementsByTagName('select')[y].value;
				input = table[x].getElementsByTagName('input')[y-1].value;
				//alert(input)
				params+="&selectsub["+x+"]["+(y-1)+"]="+select;
				params+="&input["+x+"]["+(y-1)+"]="+input;
			}
			params+="&select["+x+"]="+direct[x];
		}
		//alert(direct[0]);
		params+='&numberGroup='+numberGroup;
		params+='&nameTest='+nameTest;
		//alert(value);
		sqlSaveConfigTestWithCallback(params,uri,callbackForSaveConfigTest);
	}
	function callbackForSaveConfigTest(request){
		var mes= request.responseText.match(/<mes>(.+)<\/mes>/)[1];
		if (mes=="No"){
			alert('Данный тест с таким названием для группы уже существует!');
		}
		if (mes=="NoAdd"){
			alert('В каких-то подтемах(ме) количество вопросов меньше,чем было указано в поле!Или не указано вовсе!')
		}
		if (mes=="Nodir"){
			alert('Какого-то направления не существует!Или отправлены пустые данные!');
		}
		if (mes=="Nosub"){
			alert('Какой-то подтемы не существует!Или отправлены пустые данные');
		}
		if (mes=="Nogroup"){
			alert('Такой группы не существует!Или их не вовсе!')
		}
		if (mes=="Default"){
			alert('Какие-то данные не заполнены!Скорее всего имя теста!Или заполнены неверно!');
		}
		if (mes=="Ok"){
			alert('Тест с данными настройками успешно сохранен!');
		}
	}
	function sqlSaveConfigTestWithCallback(params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						// document.getElementById("foot").innerHTML = request.responseText;
						 callback(request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}

	$('.crudable').crudable();
	
	//Функции для вопросов
	function addRowQuestion (r,tableId,uriN){
		var textarea = r.parentNode.getElementsByTagName('textarea');
		var input =r.parentNode.getElementsByTagName('input');
		for (var x=0;x<=d.getElementById(tableId).rows.length-1; x++){
			if (d.getElementById(tableId).getElementsByTagName('tr')[x].classList.contains('default')){
				d.getElementById(tableId).getElementsByClassName('default')[0].remove();
			}
		}
		var name = textarea[0].value;
		var	var1 =	textarea[1].value;
		var	var2 =	textarea[2].value;
		var	var3 =	textarea[3].value;
		var	var4 =	textarea[4].value;
		var	var5 =	textarea[5].value;
		var	var6 =	textarea[6].value;
		var ans1 = input[0].value;
		var ans2 = input[1].value;
		var ans3 = input[2].value;
		var ans4 = input[3].value;
		var ans5 = input[4].value;
		var ans6 = input[5].value;
		
		$("#simple-popup-backdrop").remove();
		$("#simple-popup").remove();
		addRowQuestionToDb(tableId,uriN,name,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6);
	}
	function callbackForQuestion(tableId,name,request){
		var mes= request.responseText.match(/<mesadd>(.+)<\/mesadd>/)[1];
		if (mes=="Ok"){
			var id=request.responseText.match(/<id>(.+)<\/id>/)[1];
			var tbody = d.getElementById(tableId).getElementsByTagName('TBODY')[0];
			var row = d.createElement("TR");
			tbody.appendChild(row);
			row.className = "even pointer";
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");
			var td3 = d.createElement("TD");
			var td4 = d.createElement("TD");
			td1.className= "a-center";
			td2.style.display = "none";
			row.appendChild(td1);
			row.appendChild(td2);
			row.appendChild(td3);
			row.appendChild(td4);
			
			// Наполняем ячейки
			td1.innerHTML = "<input type='checkbox' class='flat' name='table_records' />";
			td2.innerHTML = '<span class="" style="display: inline;">'+id+'</span>';
			td3.innerHTML = '<span class="" style="display: inline;">'+name+'</span>';
			td4.innerHTML = '<a class="demo-2 btn btn-default" onclick="editQuestion(this)"><span class="glyphicon glyphicon-pencil" ></span></a>';
			checkboxStyle();
			changePage(tableId);
		}
		if (mes=="No")	alert("Данный вопрос уже присутствует!");
	}
	
	function addRowQuestionToDb(tableId,uriN,name,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6){
		uri = "/adminpanel/question_sql/"+uriN;
		params='add=ok';
		params+='&name='+name;
		params+='&var1='+var1;
		params+='&var2='+var2;
		params+='&var3='+var3;
		params+='&var4='+var4;
		params+='&var5='+var5;
		params+='&var6='+var6;
		params+='&ans1='+ans1;
		params+='&ans2='+ans2;
		params+='&ans3='+ans3;
		params+='&ans4='+ans4;
		params+='&ans5='+ans5;
		params+='&ans6='+ans6;
		sqlAddQuestionWithCallback(tableId,name,params,uri,callbackForQuestion);	
	}
	function sqlAddQuestionWithCallback(tableId,name,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 callback(tableId,name,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function saveToFileQuestion(numberQuestion){
		//var tableId =input.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('table')[0].id
		//var a=$('#'+tableId+'>tbody > tr'); 
		//var out=new Array();
		params="saveToFile=ok";
		params+='&numberSub='+numberQuestion;
		uri = "/adminpanel/question_sql/";
		sqlForSaveQuestion(params,uri,numberQuestion);

	}
	function sqlForSaveQuestion(params,uri,numberQuestion){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						//document.getElementById("foot").innerHTML = request.responseText;
						//alert(request.responseText);
						//var name=request.responseText.match(/<name>(.+)<\/name>/)[1];
						location.href="/adminpanel/file_question/"+numberQuestion;
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	//////////////////////
	//Функции для модального окна
	$(document).ready(function() {
	  $("a.demo-1").simplePopup({ type: "html", htmlSelector: "#popupAdd" });
	});
	
	$(document).ready(function() {
		$("a.demo-2").simplePopup({ 
			type: "html", 
			htmlSelector: "#popupEdit", 
			beforeOpen: function(){
			
			}
		});
	});
	/////////
	function UpdateRowQuestion (r,tableId,UriN){
		var textarea = r.parentNode.getElementsByTagName('textarea');
		var input =r.parentNode.getElementsByTagName('input');
		var name = textarea[0].value;
		var	var1 =	textarea[1].value;
		var	var2 =	textarea[2].value;
		var	var3 =	textarea[3].value;
		var	var4 =	textarea[4].value;
		var	var5 =	textarea[5].value;
		var	var6 =	textarea[6].value;
		var ans1 = input[1].value;
		var ans2 = input[2].value;
		var ans3 = input[3].value;
		var ans4 = input[4].value;
		var ans5 = input[5].value;
		var ans6 = input[6].value;
		var id = input[7].value;
		$("#simple-popup-backdrop").remove();
		$("#simple-popup").remove();
		UpdateRowQuestionToDb(tableId,UriN,name,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6,id);
	}
	function callbackForQuestionUpdate(tableId,name,id,request){
		var mes= request.responseText.match(/<mesup>(.+)<\/mesup>/)[1];
		if (mes=="Ok"){
			var i=d.getElementById(tableId).getElementsByTagName('TBODY')[0].getElementsByTagName('tr');
			var x=0;
			for (x=0; x<i.length;x++){
				if (i[x].getElementsByTagName('td')[1].getElementsByTagName('span')[0].innerHTML == id ){
					i[x].getElementsByTagName('td')[2].getElementsByTagName('span')[0].innerHTML = name;
				}
			}
		}
		if (mes=="No")	alert("Данное название уже присутствует!");
	}
	
	function UpdateRowQuestionToDb(tableId,UriN,name,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6,id){
		uri = "/adminpanel/question_sql/"+UriN;
		params='save=ok';
		params+='&name='+name;
		params+='&var1='+var1;
		params+='&var2='+var2;
		params+='&var3='+var3;
		params+='&var4='+var4;
		params+='&var5='+var5;
		params+='&var6='+var6;
		params+='&ans1='+ans1;
		params+='&ans2='+ans2;
		params+='&ans3='+ans3;
		params+='&ans4='+ans4;
		params+='&ans5='+ans5;
		params+='&ans6='+ans6;
		params+='&id='+id;
		sqlUpdateQuestionWithCallback(tableId,name,id,params,uri,callbackForQuestionUpdate);	
	}
	function sqlUpdateQuestionWithCallback(tableId,name,id,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 callback(tableId,name,id,request);
						 //alert(request.responseText)
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function editQuestion(r){
		var q = r.parentNode.parentNode.getElementsByTagName('td')[1].getElementsByTagName('span')[0].innerHTML;
		//alert(q);
		uri="/adminpanel/question_sql/";
		params="edit=ok";
		params+="&id="+q;
		sqlEditQuestionWithCallback(params,uri,q,callbackForEditQuestion)
		//document.getElementById("popupEdit").getElementsByTagName('textarea')[0].innerHTML="fdf";

	}
	function callbackForEditQuestion(id,request){
		var mes = JSON.parse(request.responseText);
		if (mes.mesedit=="Ok"){
			document.getElementById("simple-popup").getElementsByTagName('textarea')[0].innerHTML=mes.name;
			
			document.getElementById("simple-popup").getElementsByTagName('textarea')[1].innerHTML=mes.var1;
			document.getElementById("simple-popup").getElementsByTagName('textarea')[2].innerHTML=mes.var2;
			document.getElementById("simple-popup").getElementsByTagName('textarea')[3].innerHTML=mes.var3;
			document.getElementById("simple-popup").getElementsByTagName('textarea')[4].innerHTML=mes.var4;
			document.getElementById("simple-popup").getElementsByTagName('textarea')[5].innerHTML=mes.var5;
			document.getElementById("simple-popup").getElementsByTagName('textarea')[6].innerHTML=mes.var6;
			document.getElementById("simple-popup").getElementsByTagName('input')[0].value=mes.ans1;
			document.getElementById("simple-popup").getElementsByTagName('input')[1].value=mes.ans2;
			document.getElementById("simple-popup").getElementsByTagName('input')[2].value=mes.ans3;
			document.getElementById("simple-popup").getElementsByTagName('input')[3].value=mes.ans4;
			document.getElementById("simple-popup").getElementsByTagName('input')[4].value=mes.ans5;
			document.getElementById("simple-popup").getElementsByTagName('input')[5].value=mes.ans6;
			document.getElementById("simple-popup").getElementsByTagName('input')[6].value=id;
			document.getElementById("simple-popup").getElementsByClassName("relcontent")[0].innerHTML=(
				"<form name='img' enctype='multipart/form-data' method='POST'>"+
					"<input type='file'  name='userfile' accept='image/*' onchange='imgQuestion()' />"+
				"</form>"
			);
			if (mes.image!=""){
				document.getElementById("simple-popup").getElementsByClassName('image')[0].innerHTML="<br/><img src='/image/"+mes.image+"' alt='' /><br/><button type='submit' class='btn btn-default '  onclick='deleteImage();return false;'>Удалить</button>";
			}
		}
		if (mes.mesedit=="No")	{
			$("#simple-popup-backdrop").remove();
			$("#simple-popup").remove();
		}
	}


	function sqlEditQuestionWithCallback(params,uri,id,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 //alert(request.responseText);
						 callback(id,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function deleteRowQuestion(r,uriN){
		var a=$('#'+r+'>tbody > tr'); //выбираем все отмеченные checkbox
		var out=[];
		for (var x=0; x<a.length;x++){ //перебераем все объекты 
			var tdCount=a[x].getElementsByTagName('td');
			if (a[x].className=='even pointer selected'){
					out.push(tdCount[1].getElementsByTagName('span')[0].innerHTML);
					console.log(out);
				a[x].remove();
			}
		
		}
		uri = uriN;
		params='delete[]='+out;
		sql(params,uri);
		rowAmountForDefaultQuestion(r);
		changePage(r);
	}
	function rowAmountForDefaultQuestion(r){
		var table=d.getElementById(r).rows.length-1;
		if (table<=0){
			var tbody = d.getElementById(r).getElementsByTagName('TBODY')[0];
			var row = d.createElement("TR");
			tbody.appendChild(row);
			row.className = "default";
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");
			var td3 = d.createElement("TD");

			td1.className= "a-center";
			row.appendChild(td1);
			row.appendChild(td2);
			row.appendChild(td3);
			// Наполняем ячейки
			td2.innerHTML = 'Данные отсутствуют!';
			

		}
	}
	function addFromFileQuestion(out,tableId,numberSub){
		for (var x=0;x<=d.getElementById(tableId).rows.length-1; x++){
			if (d.getElementById(tableId).getElementsByTagName('tr')[x].classList.contains('default')){
				d.getElementById(tableId).getElementsByClassName('default')[0].remove();
			}
		}
		for (var x=0; x<=out.length-1; x++){
			var name = out[x][0];
			var	var1 =	out[x][1];
			var var2 = out[x][2];
			var var3 = out[x][3];
			var	var4 =	out[x][4];
			var var5 = out[x][5];
			var var6 = out[x][6];
			var	ans1 =	out[x][7];
			var ans2 = out[x][8];
			var ans3 = out[x][9];
			var	ans4 =	out[x][10];
			var ans5 = out[x][11];
			var ans6= out[x][12];
			addRowQuestionToDb(tableId,numberSub,name,var1,var2,var3,var4,var5,var6,ans1,ans2,ans3,ans4,ans5,ans6)
			//addRowStudentToDb(tableId,name,thirdname,password,numberSub);
		}
		$("#preview").html('');
	}
	function outFileQuestion(msg,tableId,numberSub){
		var columnCount=$("maxcolumn",msg).text();
				//var items=$("item",msg).length;
				var out = new Array();
				//var line=(items/columnCount);
				for (var i=0;i<=columnCount-1;i++){
					out[i]=new Array();
					for (var j=0;j<=12;j++){
						out[i][j]=$("#"+i+":eq("+j+")",msg).text();
						//alert($("#"+i+":eq("+j+")",msg).text());
					}
				}
			addFromFileQuestion(out,tableId,numberSub);
	}
	function filelQuestion(nameForm,input,numberSub){
		$("form[name='"+nameForm+"']").on('change', function(e) {
			var formData = new FormData($(this)[0]);
			//formData='xls='+1;
			var tableId =input.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('table')[0].id
			$("#preview").html('');
			$("#preview").html('<div id="block_1" class="barlittle"></div>'+
								'<div id="block_2" class="barlittle"></div>'+
								'<div id="block_3" class="barlittle"></div>'+
								'<div id="block_4" class="barlittle"></div>'+
								'<div id="block_5" class="barlittle"></div>');
								
			$.ajax({
				url: '/adminpanel/question_sql/',
				type: "POST",
				data: formData,
				async: true,
				success: function (msg) {
					outFileQuestion(msg,tableId,numberSub);
					//alert(msg);
				},
				error: function(msg) {
					alert('Ошибка!');
				},
				cache: false,
				contentType: false,
				processData: false
			});		
			$("form[name='uploader']")[0].reset();
		});
	}
	function deleteImage(){
		var formData1 = new FormData();
		uri='/adminpanel/img_question_sql/';
		params="delete=ok";
		params+="&id="+document.getElementById("simple-popup").getElementsByTagName('input')[7].value;
		sqlDeleteImage(params,uri);
	}
	function sqlDeleteImage(params,uri){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						//alert(request.responseText);
						var mes=request.responseText.match(/<mes>(.+)<\/mes>/)[1];
						if (mes=="Ok"){
							document.getElementById("simple-popup").getElementsByClassName('image')[0].innerHTML="";
							$("form[name='img']")[0].reset();
							
						}
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function imgQuestion(){
		$("form[name='img']").off('change.file').on('change.file', function(e) {
			var formData = new FormData($(this)[0]);
			formData.append('id',document.getElementById("simple-popup").getElementsByTagName('input')[7].value);				
			$.ajax({
				url: '/adminpanel/img_question_sql/',
				type: "POST",
				data: formData,
				async: true,
				success: function (msg) {
					//document.getElementById("foot").innerHTML = msg;
					var mes= msg.match(/<mes>(.+)<\/mes>/)[1];
					if (mes=="Ok"){
						var mes1= msg.match(/<img>(.+)<\/img>/)[1];
						document.getElementById("simple-popup").getElementsByClassName('image')[0].innerHTML="<br/><img src='/image/"+mes1+"' alt='' /><br/><button type='submit' class='btn btn-default '  onclick='deleteImage();return false;'>Удалить</button>";
					}
				},
				error: function(msg) {
					alert('Ошибка!');
				},
				cache: false,
				contentType: false,
				processData: false
			});		
		});
	}
	//////////////
	//// Функции для Направлений и подтем
	function deleteRowDirect(r,uriN){
		var a=$('#'+r+'>tbody > tr'); //выбираем все отмеченные checkbox
		var out=[];
		for (var x=0; x<a.length;x++){ //перебераем все объекты 
			var tdCount=a[x].getElementsByTagName('td');
			if (a[x].className=='even pointer selected'){
					out.push(tdCount[1].getElementsByTagName('span')[0].innerHTML);
					console.log(out);
				a[x].remove();
			}
		
		}
		uri = uriN;
		params='delete[]='+out;
		sql(params,uri);
		rowAmountForDefaultDirect(r);
		changePage(r);
	}
	function rowAmountForDefaultDirect(r){
		var table=d.getElementById(r).rows.length-1;
		if (table<=0){
			var tbody = d.getElementById(r).getElementsByTagName('TBODY')[0];
			var row = d.createElement("TR");
			tbody.appendChild(row);
			row.className = "default";
			var td1 = d.createElement("TD");
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");
			var td3 = d.createElement("TD");
			var td4 = d.createElement("TD");
			var td5 = d.createElement("TD");
			td1.className= "a-center";
			row.appendChild(td1);
			row.appendChild(td2);
			row.appendChild(td3);
			row.appendChild(td4);
			row.appendChild(td5);
			// Наполняем ячейки
			td2.innerHTML = 'Данные отсутствуют!';
			

		}
	}
	function addRowDirect(r,uriN,uriLink){
		var input = document.getElementById(r).parentNode.getElementsByTagName('input');
		for (var x=0;x<=d.getElementById(r).rows.length-1; x++){
			if (d.getElementById(r).getElementsByTagName('tr')[x].classList.contains('default')){
				d.getElementById(r).getElementsByClassName('default')[0].remove();
			}
		}
		var name = input[0].value;
		addRowDirectToDb(r,name,uriN,uriLink);
		
	}
	function calbackForDirect(tableId,name,uri,uriLink,request){
		var mes=request.responseText.match(/<mesadd>(.+)<\/mesadd>/)[1];
		if (mes=="Ok"){
			var id=request.responseText.match(/<id>(.+)<\/id>/)[1];
			var tbody = d.getElementById(tableId).getElementsByTagName('TBODY')[0];
			var row = d.createElement("TR");
			tbody.appendChild(row);
			row.className = "even pointer";
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");
			var td3 = d.createElement("TD");
			var td4 = d.createElement("TD");
			var td5 = d.createElement("TD");
			var td6 = d.createElement("TD");
			td1.className= "a-center";
			td2.style.display = "none";
			row.appendChild(td1);
			row.appendChild(td2);
			row.appendChild(td3);
			row.appendChild(td4);
			row.appendChild(td5);
			row.appendChild(td6);
			
			// Наполняем ячейки
			td1.innerHTML = "<input type='checkbox' class='flat' name='table_records' />";
			td2.innerHTML = '<span class="" style="display: inline;">'+id+'</span>';
			td3.innerHTML = '<span class="" style="display: inline;">'+name+'</span>';
			td3.innerHTML+= '<input type="text" class="form-control" name="name" value="'+name+'" style="display: none;"  disabled/>';
			if (uriLink=="/adminpanel/questions/"){
				td4.innerHTML = '<span class="" style="display: inline;"><a href="'+uriLink+id+'" >Посмотреть вопросы</a></span>';
			}else{
				td4.innerHTML = '<span class="" style="display: inline;"><a href="'+uriLink+id+'" >Посмотреть темы</a></span>';
			}
			td5.innerHTML = '<button class="btn btn-default" onclick="editStyleForDirect(this);return false;" ><span class="glyphicon glyphicon-pencil" ></span> </button>';
			td6.innerHTML =	'<button class="btn btn-success" onclick="saveStyleForDirect(this,\''+uri+'\');return false;" disabled><span class="glyphicon glyphicon-ok"></span> </button>';
			checkboxStyle();
			changePage(tableId);
			
		}
		if (mes=="No")	alert("Данное название уже присутствует!");
		
	}


	function addRowDirectToDb(tableId,name,uriN,uriLink){
		uri = uriN;
		params='add=ok';
		params+='&name='+name;
		sqlAddDirectWithCallback(tableId,name,params,uri,uriLink,calbackForDirect);	
	}
	function sqlAddDirectWithCallback(tableId,name,params,uri,uriLink,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 //alert(request.responseText);
						 callback(tableId,name,uri,uriLink,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function calbackForSaveDirect(i,safe,uri,request){
		var mes=request.responseText.match(/<mes>(.+)<\/mes>/)[1];
		var index=0;
		if (mes=="No"){
			for (var x=2; x<i.length-3;x++){	
				i[x].getElementsByTagName('span')[0].innerHTML= safe[index];
				i[x].getElementsByTagName('input')[0].value=safe[index];
				index=index+1;
			}
		}
		if (mes=="No")	alert("Данное название уже присутствует!");
		
	}
	function sqlSaveDirectWithCallback(i,safe,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 //alert(request.responseText);
						 callback(i,safe,uri,request);
						 //alert(request.responseText);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function editStyleForDirect(r){
		var i=r.parentNode.parentNode.getElementsByTagName('td');
		for (var x=2; x<i.length-3;x++){
			if (i[x].getElementsByTagName('span')[0].style.display =="inline" ){
				i[x].getElementsByTagName('span')[0].style.display="none";
				i[x].getElementsByTagName('input')[0].style.display = "block";
				i[x].getElementsByTagName('input')[0].removeAttribute('disabled');
				i[i.length-1].getElementsByTagName('button')[0].removeAttribute('disabled');
			}else if (i[x].getElementsByTagName('span')[0].style.display =="none")
			{
				i[x].getElementsByTagName('span')[0].style.display="inline";
				i[x].getElementsByTagName('input')[0].style.display = "none";
				i[x].getElementsByTagName('input')[0].setAttribute("disabled","true");
				i[i.length-1].getElementsByTagName('button')[0].setAttribute("disabled","true");
			}
		}
	}
	function saveStyleForDirect(r,uriN){
		var i=r.parentNode.parentNode.getElementsByTagName('td');
		var out=[];
		var safe=[];
		out.push(i[1].getElementsByTagName('span')[0].innerHTML);
		for (var x=2; x<i.length-3;x++){	
				safe.push(i[x].getElementsByTagName('span')[0].innerHTML);
				i[x].getElementsByTagName('span')[0].innerHTML=i[x].getElementsByTagName('input')[0].value;
				i[x].getElementsByTagName('span')[0].style.display="inline";
				i[x].getElementsByTagName('input')[0].style.display = "none";
				i[x].getElementsByTagName('input')[0].setAttribute("disabled","true");
				i[i.length-1].getElementsByTagName('button')[0].setAttribute("disabled","true");
				out.push(i[x].getElementsByTagName('span')[0].innerHTML);
			
		}
		console.log(safe);
		console.log(out);
		uri = uriN;
		params='save=ok';
		params+='&id='+out[0];
		params+='&name='+out[1];
		sqlSaveDirectWithCallback(i,safe,params,uri,calbackForSaveDirect);
		
	}

	/////////
	////// Функции для редактирования студентов
	//Выводит сообщение что нет данных, на странице студентов
	function rowAmountForDefault(r){
		var table=d.getElementById(r).rows.length-1;
		if (table<=0){
			var tbody = d.getElementById(r).getElementsByTagName('TBODY')[0];
			var row = d.createElement("TR");
			tbody.appendChild(row);
			row.className = "default";
			var td1 = d.createElement("TD");
			var td1 = d.createElement("TD");
			var td2 = d.createElement("TD");
			var td3 = d.createElement("TD");
			var td4 = d.createElement("TD");
			var td5 = d.createElement("TD");
			var td6 = d.createElement("TD");
			var td7 = d.createElement("TD");
			var td8 = d.createElement("TD");
			td1.className= "a-center";
			row.appendChild(td1);
			row.appendChild(td2);
			row.appendChild(td3);
			row.appendChild(td4);
			row.appendChild(td5);
			row.appendChild(td6);
			row.appendChild(td7);
			row.appendChild(td8);
			// Наполняем ячейки
			td4.innerHTML = 'Данные для этой группы отсутствуют!';
			

		}
	}
	/////
	//Добавление студентов
	function addRowStudent(r,numberGroup){
		var input = document.getElementById(r).parentNode.getElementsByTagName('input');
		for (var x=0;x<=d.getElementById(r).rows.length-1; x++){
			if (d.getElementById(r).getElementsByTagName('tr')[x].classList.contains('default')){
				d.getElementById(r).getElementsByClassName('default')[0].remove();
			}
		}
		var forename = input[0].value;
		var	name =	input[1].value;
		var thirdname = input[2].value;
		//var login= str_rand();
		var password= str_rand();
		addRowStudentToDb(r,forename,name,thirdname,password,numberGroup);
		
	}
	//Удаление студентов
	function deleteRowStudent(r){
		var a=$('#'+r+'>tbody > tr'); //выбираем все отмеченные checkbox
		var out=[];
		for (var x=0; x<a.length;x++){ //перебераем все объекты 
			var tdCount=a[x].getElementsByTagName('td');
			if (a[x].className=='even pointer selected'){
					out.push(tdCount[1].getElementsByTagName('span')[0].innerHTML);
					console.log(out);
				a[x].remove();
			}
		
		}
		uri = "/adminpanel/create_student_sql/";
		params='delete[]='+out;
		sql(params,uri);
		rowAmountForDefault(r);
		changePage(r);
	}
	//Калбек функция для добавления студентов в ручную или из файла
	function calback(tableId,forename,name,thirdname,password,request){
		var newlogin= request.responseText.match(/<login>(.+)<\/login>/)[1];
		var id=request.responseText.match(/<id>(.+)<\/id>/)[1];
		var tbody = d.getElementById(tableId).getElementsByTagName('TBODY')[0];
		var row = d.createElement("TR");
		tbody.appendChild(row);
		row.className = "even pointer";
		var td1 = d.createElement("TD");
		var td2 = d.createElement("TD");
		var td3 = d.createElement("TD");
		var td4 = d.createElement("TD");
		var td5 = d.createElement("TD");
		var td6 = d.createElement("TD");
		var td7 = d.createElement("TD");
		var td8 = d.createElement("TD");
		var td9 = d.createElement("TD");
		td1.className= "a-center";
		td2.style.display = "none";
		row.appendChild(td1);
		row.appendChild(td2);
		row.appendChild(td3);
		row.appendChild(td4);
		row.appendChild(td5);
		row.appendChild(td6);
		row.appendChild(td7);
		row.appendChild(td8);
		row.appendChild(td9);
		
		// Наполняем ячейки
		td1.innerHTML = "<input type='checkbox' class='flat' name='table_records' />";
		td2.innerHTML = '<span class="" style="display: inline;">'+id+'</span>';
		td3.innerHTML = '<span class="" style="display: inline;">'+forename+'</span>';
		td3.innerHTML+= '<input type="text" class="form-control" name="surname" value="'+forename+'" style="display: none;"  disabled/>';
		td4.innerHTML = '<span class="" style="display: inline;">'+name+'</span>';
		td4.innerHTML+= '<input type="text" class="form-control" name="surname" value="'+name+'" style="display: none;"  disabled/>';
		td5.innerHTML = '<span class="" style="display: inline;">'+thirdname+'</span>';
		td5.innerHTML+= '<input type="text" class="form-control" name="surname" value="'+thirdname+'" style="display: none;"  disabled/>';
		td6.innerHTML = '<span class="" style="display: inline;">'+newlogin+'</span>';
		td6.innerHTML+= '<input type="text" class="form-control" name="surname" value="'+newlogin+'" style="display: none;"  disabled/>';
		td7.innerHTML = '<span class="" style="display: inline;">'+password+'</span>';
		td7.innerHTML+= '<input type="text" class="form-control" name="surname" value="'+password+'" style="display: none;"  disabled/>';
		td8.innerHTML = '<button class="btn btn-default" onclick="editStyle(this);return false;" ><span class="glyphicon glyphicon-pencil" ></span> </button>';
		td9.innerHTML =	'<button class="btn btn-success" onclick="saveStyle(this);return false;" disabled><span class="glyphicon glyphicon-ok"></span> </button>';
		checkboxStyle();
		changePage(tableId);
	}
	
	function addRowStudentToDb(tableId,forename,name,thirdname,password,numberGroup){
		uri = "/adminpanel/create_student_sql/"+numberGroup;
		params='add=ok';
		params+='&secondname='+forename;
		params+='&name='+name;
		params+='&thirdname='+thirdname;
		params+='&password='+password;
		sqlAddWithCallback(tableId,forename,name,thirdname,password,params,uri,calback);	
	}
	function sqlAddWithCallback(tableId,forename,name,thirdname,password,params,uri,callback){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						 //document.getElementById("foot").innerHTML = request.responseText;
						 callback(tableId,forename,name,thirdname,password,request);
						 //var image_path = $("#image_path",xml).text();
						 //var user_name = $("#user_name",xml).text();
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	
	function editStyle(r){
		var i=r.parentNode.parentNode.getElementsByTagName('td');
		for (var x=2; x<i.length-2;x++){
			if (i[x].getElementsByTagName('span')[0].style.display =="inline" && x!==5){
				i[x].getElementsByTagName('span')[0].style.display="none";
				i[x].getElementsByTagName('input')[0].style.display = "block";
				i[x].getElementsByTagName('input')[0].removeAttribute('disabled');
				i[i.length-1].getElementsByTagName('button')[0].removeAttribute('disabled');
			}else if (i[x].getElementsByTagName('span')[0].style.display =="none")
			{
				i[x].getElementsByTagName('span')[0].style.display="inline";
				i[x].getElementsByTagName('input')[0].style.display = "none";
				i[x].getElementsByTagName('input')[0].setAttribute("disabled","true");
				i[i.length-1].getElementsByTagName('button')[0].setAttribute("disabled","true");
			}
		}
	}
	function saveStyle(r){
		var i=r.parentNode.parentNode.getElementsByTagName('td');
		var out=[];
		out.push(i[1].getElementsByTagName('span')[0].innerHTML);
		for (var x=2; x<i.length-2;x++){	
			if (x!==5){
				i[x].getElementsByTagName('span')[0].innerHTML=i[x].getElementsByTagName('input')[0].value;
				i[x].getElementsByTagName('span')[0].style.display="inline";
				i[x].getElementsByTagName('input')[0].style.display = "none";
				i[x].getElementsByTagName('input')[0].setAttribute("disabled","true");
				i[i.length-1].getElementsByTagName('button')[0].setAttribute("disabled","true");
				out.push(i[x].getElementsByTagName('span')[0].innerHTML);
			}
		}
		console.log(out);
		uri = "/adminpanel/create_student_sql/";
		params='save=ok';
		params+='&id='+out[0];
		params+='&secondname='+out[1];
		params+='&name='+out[2];
		params+='&thirdname='+out[3];
		params+='&password='+out[4];
		sql(params,uri);
		
	}
	///////////
	//Сохранение в файл студентов
	function saveToFile(input,numberGroup){
		var tableId =input.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('table')[0].id
		var a=$('#'+tableId+'>tbody > tr'); //выбираем все отмеченные checkbox
		var out=new Array();
		params="saveToFile=ok";
		for (var x=0; x<a.length;x++){ //перебераем все объекты 
			var tdCount=a[x].getElementsByTagName('td');
			out[x]=new Array();
			for (var y=2; y<tdCount.length-2;y++){
					out[x][y-2]=tdCount[y].getElementsByTagName('span')[0].innerHTML;
					params+="&array["+x+"]["+(y-2)+"]="+out[x][y-2];
			}	
		}
		params+='&numberGroup='+numberGroup;
		uri = "/adminpanel/create_student_sql/";
		sqlForSave(params,uri,numberGroup);

	}
	function sqlForSave(params,uri,numberGroup){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						//document.getElementById("foot").innerHTML = request.responseText;
						//alert(request.responseText);
						location.href="/adminpanel/file/"+numberGroup;
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	////////////
	//Функции для загрузки из файла студентов
	function addFromFile(out,tableId,numberGroup){
		for (var x=0;x<=d.getElementById(tableId).rows.length-1; x++){
			if (d.getElementById(tableId).getElementsByTagName('tr')[x].classList.contains('default')){
				d.getElementById(tableId).getElementsByClassName('default')[0].remove();
			}
		}
		for (var x=0; x<=out.length-1; x++){
			var forename = out[x][0];
			var	name =	out[x][1];
			var thirdname = out[x][2];
			var password= str_rand();
			addRowStudentToDb(tableId,forename,name,thirdname,password,numberGroup);
		}
		$("#preview").html('');
	}
	function outFile(msg,tableId,numberGroup){
		var columnCount=$("maxcolumn",msg).text();
				//var items=$("item",msg).length;
				var out = new Array();
				//var line=(items/columnCount);
				for (var i=0;i<=columnCount-1;i++){
					out[i]=new Array();
					for (var j=0;j<=2;j++){
						out[i][j]=$("#"+i+":eq("+j+")",msg).text();
						//alert($("#"+i+":eq("+j+")",msg).text());
					}
				}
			addFromFile(out,tableId,numberGroup);
	}
	function filel(nameForm,input,numberGroup){
		$("form[name='"+nameForm+"']").on('change', function(e) {
			var formData = new FormData($(this)[0]);
			var tableId =input.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('table')[0].id
			$("#preview").html('');
			$("#preview").html('<div id="block_1" class="barlittle"></div>'+
								'<div id="block_2" class="barlittle"></div>'+
								'<div id="block_3" class="barlittle"></div>'+
								'<div id="block_4" class="barlittle"></div>'+
								'<div id="block_5" class="barlittle"></div>');
								
			$.ajax({
				url: '/adminpanel/create_student_sql/',
				type: "POST",
				data: formData,
				async: true,
				success: function (msg) {
					outFile(msg,tableId,numberGroup);
					//alert(msg);
				},
				error: function(msg) {
					alert('Ошибка!');
				},
				cache: false,
				contentType: false,
				processData: false
			});		
			$("form[name='uploader']")[0].reset();
		});
	}
	///////////////////////////

	//Функция для обновления постраничной нафигации таблицы при удалении и добавлении
	function changePage(r){
		var i=document.getElementById(r);
		var countTable = i.rows.length-1;
		var countPage= i.parentNode.getElementsByClassName("page-navigation")[0].getElementsByTagName("a").length-4;
		for (x=0;x<i.parentNode.getElementsByClassName("page-navigation")[0].getElementsByTagName("a").length;x++)
		{
			if (i.parentNode.getElementsByClassName("page-navigation")[0].getElementsByTagName("a")[x].hasAttribute('data-selected')){
				var page = i.parentNode.getElementsByClassName("page-navigation")[0].getElementsByTagName("a")[x].innerHTML;
			}
		}
		if (countTable>0){
			if (page>Math.ceil(countTable/10)){
				i.parentNode.getElementsByClassName("page-navigation")[0].remove();
				pagination(r,Math.ceil(countTable/10)-1);
			}else{
				i.parentNode.getElementsByClassName("page-navigation")[0].remove();
				pagination(r,page-1);
			}
		}else{
			i.parentNode.getElementsByClassName("page-navigation")[0].remove();
			pagination(r,0);
		}
	}
	// Функция для постраничной навигации для таблиц
	function pagination(r,startPage){
		$('#'+r).paginate({
			initialPage: startPage,
			optional: false,
			limit: 10,
			onSelect: function(obj, page) {
			  console.log('Page ' + page + ' selected!' );
			  checkboxStyle();
			}
			});
	}
	//Функция для создания постраничной навигации при открытии страницы
	//$('table').length;
	for (var x=1;x<=$('table').length;x++){
		$('#datatable'+x).paginate({
			optional: false,
			limit: 10,
			onSelect: function(obj, page) {
			  console.log('Page ' + page + ' selected!' );
			  checkboxStyle();
			}
		});
	}
	//alert($('table').length)
	

	function sql(params,uri){
		var request = new ajaxRequest();

		request.onreadystatechange = function()
		{
			if (request.readyState==4)
			{
				if (request.status==200)
				{
					if (request.responseText != null)
					{
						//document.getElementById("foot").innerHTML = request.responseText;
						//alert(request.responseText);
						//location.href="/adminpanel/file/422";
					}
					else alert ("Данные не полученны");
				}
				else alert ("Ошибка Ajax"+this.statusText);
			}
		}
		request.open("POST", uri, true);
		request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		request.send(params);
	}
	function ajaxRequest()
	{
		try // IE
		{
			var request = new XMLHttpRequest()
		}
		catch(e1)
		{
			try//This IE 6+?
			{
				request = new ActiveXObject("Msxml2.XMLHTTP")
			}
			catch(e2)
			{
				try // This IE 5?
				{
					request = new ActiveXObject("Microsoft.XMLHTTP")
				}
				catch(e3)// This brouser not supported Ajax
				{
					request = false
				}
			}
		}
		return request
	}
	////////

////////////
function checkboxStyle(){
	if ($("input.flat")[0]) {
			$(document).ready(function () {
				$('input.flat').iCheck({
					checkboxClass: 'icheckbox_flat-green',
					radioClass: 'iradio_flat-green'
				});
			});
		}
		$('table input').on('ifChecked', function () {
		checkState = '';
		$(this).parent().parent().parent().addClass('selected');
		countChecked();
	});
		$('table input').on('ifUnchecked', function () {
		checkState = '';
		$(this).parent().parent().parent().removeClass('selected');
		countChecked();
	});
}  

	//Формирует рандомно пароль
	function str_rand() {
        var result       = '';
        var words        = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        var max_position = words.length - 1;
            for( i = 0; i < 10; ++i ) {
                position = Math.floor ( Math.random() * max_position );
                result = result + words.substring(position, position + 1);
            }
			
        return result;
		
    }