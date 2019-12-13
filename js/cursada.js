$(document).ready(function() {
  	// Global Settings
  	mostrarRegistros();
});

// CHECKEAR SI EL POPUP ESTA SIENDO MOSTRADO
function isShowed() {
	if ( $('.popupbox').css('display') != 'none' ) {
		$("body").on("keydown", function(e) {
		    if(e.key == "Escape"){
		    	cancelar();
		    }
	    });
	}
}

// BUSQUEDA DE REGISTROS
$("#search").on("keyup", function() {
	$('#block').hide();
	var value = $(this).val().toLowerCase();
	$("#mytable .tablitatr").filter(function() {
  		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
});

// AGREGAR REGISTROS
function agregar() {
	$("#cantN").val(0); //valor cantidad de notas
	$("#notasBody").html('');
	$("#addRegistro").trigger("reset");
    $("#popupbox").show();
    $("#modify").hide();
    $("#save").show();
	$("#block").hide();
	isShowed();
}

function guardar() {
	if($("#recursante").prop("checked")) {
		var recursante = 1;
	} else {
		var recursante = 0;
	}
	$.ajax({
	  	url: "crudCursada/seguimiento-add.php",
	  	type: "POST",
	  	data: {
	  		materias: $("#materias").val(),
	  		temas: $("#temas").val(),
	  		fechafinal: $("#fechafinal").val(),
	  		carrera: $("#carrera").val(),
	  		recursante: recursante,
	  		sede: $("#direccion").val()
	  	},
	 	"success":function(data){
	 		const info = JSON.parse(data);
	 		console.log("guardar nota id del seguimiento ",info[0].id);
	 		saveNota(info[0].id); //Guarda las notas pasando id del seguimiento, usa el archivo notas.js
	  		$("#addRegistro").trigger("reset");
	  		$("#popupbox").toggle();
	  		$('#block').html(info[0].block);
	  		mostrarRegistros();
	  		$('#block').show();	
	  	}
	});
}

// EDITAR REGISTROS
function editar(i, m, t, ff, c, r, d) {
	$("#recursante").prop("checked", false);
	if (r == 1) {
		var rec = "checked";
	}
	else {
		var rec = "unchecked";
	}
	$("#id").val(i);
	$("#materias option").each(function() { this.selected = (this.text == m); });
	$("#temas").val(t);
	$("#notasBody").html('');
	mostrarNotasEditar(i); //Muestra las notas pasando id del seguimiento, usa el archivo notas.js
	$("#fechafinal").val(ff);
	$("#carrera option").each(function() { this.selected = (this.text == c); });
	$("#recursante").prop(rec, rec);
	$("#recursante").val(r);
	$("#precio").val(d);
	$("#direccion").val(d);

	$("#save").hide();
	$("#modify").show();
	$("#popupbox").show();
	$("#block").hide();
	isShowed();
}

function modificar() {
	if($("#recursante").prop("checked")) {
		var recu = 1;
	} else {
		var recu = 0;
	}
	$.ajax({
		type: "POST",
		url: "crudCursada/seguimiento-modify.php",
		data: {
			id: $("#id").val(),
		  	materias: $("#materias").val(),
	  		temas: $("#temas").val(),
	  		fechafinal: $("#fechafinal").val(),
	  		carrera: $("#carrera").val(),
	  		recursante: recu,
	  		sede: $("#direccion").val()
		},
		"success":function(data){
			const info = JSON.parse(data);
			modificarNotas(info[0].id); //Modifica las notas pasando id del seguimiento, usa el archivo notas.js
			$("#addRegistro").trigger("reset");
			$("#popupbox").toggle();
			$('#block').html(info[0].block);
			mostrarRegistros();
			$('#block').show();	
		}
	});
}

// BORRAR REGISTROS
function eliminar(id) {
	$.ajax({
	  	type: "POST",
	  	url: "crudCursada/seguimiento-delete.php",
	 	data: { id: id },
	  	"success":function(data){
	  		$("#addRegistro").trigger("reset");	
	  		$('#block').html(data);
	  		$('#block').show();
	  		mostrarRegistros();
	  	}
	});
}

// CANCELAR ACCION
function cancelar() {
	$("#notasBody").html('');
	$("#cantN").val(0);
	$('#popupbox').hide();
	$('#addRegistro').trigger("reset");	
	$('#block').hide();
}

// MOSTRAR REGISTROS
function mostrarRegistros() {
	$.ajax({
	  	url: 'crudCursada/seguimiento-list.php',
	  	type: 'GET',
	  	success: function(response) {
	    	const seguimientos = JSON.parse(response);
	    	let template = '';
	    	seguimientos.forEach(s => {
	    		mostrarNotas(s.id);
	    		if (s.recursante == 1) {
	    			var recursante = "checked";
	    		}
				else {
					var recursante = "unchecked";
				}
	      		template += `
	                <tr class="tablitatr">
	                  	<td>${s.id}</td>
	                  	<td>${s.materias}</td>
	                  	<td>${s.temas}</td>
	                  	<td>
	                  		<table class="text-center table table-sm table-bordered table-dark" style="display: absolute;">
	                  			<thead>
	                  				<tr>
	                  					<th scope="col">Examen</th>
	                  					<th scope="col">Nota</th>
	                  					<th scope="col">Profesor</th>
	                  					<th scope="col">Fecha</th>
	                  				</tr>
	                  			</thead>
	                  			<tbody id="tnotasbody${s.id}">
	                  			</tbody>
	                  		</table>
	                  	</td>
	                  	<td>${s.fechafinal}</td>
	                  	<td>${s.carrera}</td>
	                  	<td><input type="checkbox" disabled="disabled" ${recursante} ></td>
	                  	<td>${s.direccion}</td>
	                  	<td>
	                    	<button class="btn btn-primary btn-sm" onclick="ver(${s.id})">
	                     		Ver
	                    	</button>
	                  	</td>
	                  	<td>
	                    	<button class="btn btn-success btn-sm" onclick="editar(${s.id}, '${s.materias}', \`${s.temas}\`,'${s.fechafinal}', '${s.carrera}', '${s.recursante}', '${s.direccion}');">
	                     		Editar
	                    	</button>
	                  	</td>
	                  	<td>
	                    	<button class="btn btn-danger btn-sm" onclick="if(!confirm(\'Se borrará el registro seleccionado\'))return false; else eliminar(${s.id});">
	                     		Borrar
	                    	</button>
	                  	</td>
	                </tr>
	                `
	        });
	    	$('#seguimiento').html(template);
	  	}
	});
}

// MOSTRAR UN UNICO REGISTRO
function ver(id) {
	window.location.href = `vercursada.php?id=${id}`;
}