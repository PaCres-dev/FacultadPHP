
/* 

 CRUD DE LA TABLA NOTAS

*/


// MOSTRAR NOTAS DE LOS REGISTROS
function mostrarNotas(id) {
	console.log("ESTE ES EL ID",id);
	$.ajax({
	  	url: 'crudCursada/crudNotas/notas-list.php',
	  	type: 'GET',
	  	success: function(response) { 
	  		const notas = JSON.parse(response);
	  		let Ntemplate = '';
	    	notas.forEach(n => {
	    		//console.log("mostrarMaterias ",n);
	    		if (n.seguimientoid == id) {
	    			Ntemplate += `
		    			<tr class="tablitatr">
		                  	<td>${n.nombre}</td>
		                  	<td>${n.nota}</td>
		                  	<td>${n.profesor}</td>
		                  	<td>${n.fecha}</td>
		                </tr>
	    			`
	    		}
	    	});
	    	$("#tnotasbody"+id).html(Ntemplate);
		}
	});
}

// AGREGAR NOTA
function addNota() {
	let NewNota = '';
	let cantN = $("#cantN").val();
	cantN++
	NewNota+= `
		<tr>
			<input type="hidden" class="notaid${cantN}" value="">
          	<td>
          		<input id="nombre${cantN}" type="text" class="form-control">
          	</td>
          	<td>
          		<input id="nota${cantN}" type="number" class="form-control" maxlength="2" min="1" max="10">
          	</td>
          	<td>
          		<input id="profesor${cantN}" type="text" class="form-control">
          	</td>
          	<td>
          		<input id="fecha${cantN}" type="date" class="form-control">	
          	</td>
          	<td>
          		<button class="btn btn-success" disabled>✏️</button>
          	</td>
          	<td>
          		<a class="btn btn-success btnDelete" onclick="cancelNota();">❌</a>
          	</td>
        </tr>
	`
	$("#notasBody").append(NewNota);
	$("#cantN").val(cantN);
}

// CANCELAR NOTA
function cancelNota() {
	$("#notasBody").on('click','.btnDelete',function(){
		$(this).closest('tr').fadeOut('slow', function() { $(this).remove(); });
	});
}

// GUARDAR NOTA
function saveNota(ids) {
	console.log("guardar nota id del seguimiento ",ids);
	let n = parseInt($("#cantN").val());
	for (var i = 1; i <= n; i++) {
		let nombre = $(`#nombre${i}`).val();
  		let nota = $(`#nota${i}`).val();
  		let profesor = $(`#profesor${i}`).val();
  		let fecha = $(`#fecha${i}`).val();
  		let seguimientoid = ids;

		if (!nombre || nombre == '' || nota== '' || profesor== '' || fecha== '') 
		{
			console.log(i, " no existe");
		}
		else {
			$.ajax({
			  	url: "crudCursada/crudNotas/notas-add.php",
			  	type: "POST",
			  	data: {
			  		nombre: nombre,
			  		nota: nota,
			  		profesor: profesor,
			  		fecha: fecha,
			  		seguimientoid: ids
			  	},
			 	"success":function(data){
			 		console.log(data);
			 		$("#cantN").val(0);
					$("#notasBody").html('');
			  	}
			});
		}
	}
}

// EDITAR NOTAS
function mostrarNotasEditar(id) {
	$.ajax({
	  	url: 'crudCursada/crudNotas/notas-list.php',
	  	type: 'GET',
	  	success: function(response) { 
	  		const notas = JSON.parse(response);
	  		let cantN = $("#cantN").val();
	  		let Ntemplate = '';
	    	notas.forEach(n => {
	    		if (n.seguimientoid == id) {
	    			cantN++
	    			Ntemplate += `
		    			<tr class="${cantN}">
		    				<input type="hidden" class="notaid${cantN}" value="${n.id}">
		                  	<td>
		                  		<span class="inputnotitas">${n.nombre}</span>
		                  		<input id="nombre${cantN}" class="inputnotas form-control" type="text">
		                  	</td>
		                  	<td>
		                  		<span class="inputnotitas">${n.nota}</span>
		                  		<input id="nota${cantN}" class="inputnotas form-control" type="number">
		                  	</td>
		                  	<td>
		                  		<span class="inputnotitas">${n.profesor}</span>
		                  		<input id="profesor${cantN}" class="inputnotas form-control" type="text">
		                  	</td>
		                  	<td>
		                  		<span class="inputnotitas">${n.fecha}</span>
		                  		<input id="fecha${cantN}" class="inputnotas form-control" type="date">
		                  	</td>
		                  	<td>
		                  		<a class="btn btn-success" onclick="editarNota(${cantN}, '${n.nombre}', ${n.nota}, '${n.profesor}', '${n.fecha}');">✏️</a>
		                  	</td>
		                  	<td>
		                  		<a class="btn btn-success" id="btnDelete" onclick="deleteNota(${n.id});">❌</a>
		                  	</td>
		                </tr>
	    			`
	    		}
	    	});
	    	$("#notasBody").html(Ntemplate);
	    	$("#cantN").val(cantN);
		}
	});
}

function editarNota(c, n, nota, p, f) {
	$(`tr.${c} span.inputnotitas`).hide();
	$(`tr.${c} input.inputnotas`).show();

	$(`#nombre${c}`).val(n);
	$(`#nota${c}`).val(nota);
	$(`#profesor${c}`).val(p);
	$(`#fecha${c}`).val(f);
}

// MODIFICAR NOTAS
function modificarNotas(ids) {
	let n = parseInt($("#cantN").val());
	for (var i = 1; i <= n; i++) {
		let id = $(`.notaid${i}`).val();
		console.log("ESTE ES EL ID QUE SE EDITARA", id);
		let nombre = $(`#nombre${i}`).val();
  		let nota = $(`#nota${i}`).val();
  		let profesor = $(`#profesor${i}`).val();
  		let fecha = $(`#fecha${i}`).val();
  		let seguimientoid = ids;

		if (!nombre || nombre == '' || nota== '' || profesor== '' || fecha== '') 
		{
			console.log(i, " no existe para editar");
		}
		else if (!id) {
			$.ajax({
			  	url: "crudCursada/crudNotas/notas-add.php",
			  	type: "POST",
			  	data: {
			  		nombre: nombre,
			  		nota: nota,
			  		profesor: profesor,
			  		fecha: fecha,
			  		seguimientoid: ids
			  	},
			 	"success":function(data){
			 		console.log("new nota when edit ",data);
			 		$("#cantN").val(0);
					$("#notasBody").html('');
			  	}
			});
		}
		else if (id) {
			$.ajax({
			  	url: "crudCursada/crudNotas/notas-modify.php",
			  	type: "POST",
			  	data: {
			  		id: id,
			  		nombre: nombre,
			  		nota: nota,
			  		profesor: profesor,
			  		fecha: fecha,
			  	},
			 	"success":function(data){
			 		console.log("editing ",data);
			 		$("#cantN").val(0);
					$("#notasBody").html('');
			  	}
			});
		}
		
	}
}

// BORRAR NOTA
function deleteNota(id) {
	$.ajax({
	  	type: "POST",
	  	url: "crudCursada/crudNotas/notas-delete.php",
	 	data: { id: id },
	  	"success":function(data){
	  		console.log(data);
	  		mostrarRegistros();
	  	}
	});
	$("#notasBody").on('click','#btnDelete',function(){
		$(this).closest('tr').fadeOut('fast', function() { $(this).remove(); });
	});
}