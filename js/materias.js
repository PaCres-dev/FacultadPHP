$(document).ready(function() {
  	// Global Settings
  	mostrarMaterias();
});

// CHECKEAR SI EL POPUP ESTA SIENDO MOSTRADO
function isShowed() {
	if ( $('#popupbox').css('display') != 'none' ) {
		$("body").on("keydown", function(e) {
		    if(e.key == "Escape"){
		    	cancelar();
		    }
	    });
	}
}

// BUSQUEDA DE MATERIAS
 $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mytable .tablitatr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
 });

// AGREGAR MATERIAS
function agregar() {
	$("#addMateria").trigger("reset");
    $("#popupbox").show();
    $("#modify").hide();
    $("#save").show();
	$("#block").hide();
	isShowed();
}

function guardar() {
	console.log($("#materia").val());
	$.ajax({
	  	url: "crudMaterias/materias-add.php",
	  	type: "POST",
	  	data: {
	  		materia: $("#materia").val(),
	  		descripcion: $("#descripcion").val()
	  	},
	 	"success":function(data){	
	  		$("#addMateria").trigger("reset");
	  		$("#popupbox").toggle();
	  		$('#block').html(data);
	  		mostrarMaterias();
	  		$('#block').show();	
	  	}
	});
}

// EDITAR REGISTROS
function editar(i, m, d) {
	$("#id").val(i);
	$("#materia").val(m);
	$("#descripcion").val(d);

	$("#save").hide();
	$("#modify").show();
	$("#popupbox").show();
	$("#block").hide();
	isShowed();
}

function modificar() {
	$.ajax({
		type: "POST",
		url: "crudMaterias/materias-modify.php",
		data: {
			id: $("#id").val(),
		  	materia: $("#materia").val(),
	  		descripcion: $("#descripcion").val()
		},
		"success":function(data){
			$("#addMateria").trigger("reset");
			$("#popupbox").toggle();
			$('#block').html(data);
			mostrarMaterias();
			$('#block').show();	
		}
	});
}

// BORRAR REGISTROS
function eliminar(id) {
	$.ajax({
	  	type: "POST",
	  	url: "crudMaterias/materias-delete.php",
	 	data: { id: id },
	  	"success":function(data){
	  		$("#addMateria").trigger("reset");	
	  		$('#block').html(data);
	  		$('#block').show();
	  		mostrarMaterias();	
		}
	});
}

// CANCELAR ACCION
function cancelar() {
	$('#popupbox').hide();
	$("#addMateria").trigger("reset");
	$('#block').hide();
}

// MOSTRAR MATERIAS
function mostrarMaterias() {
	$.ajax({
	  	url: 'crudMaterias/materias-list.php',
	  	type: 'GET',
	  	success: function(response) {
	    	const materias = JSON.parse(response);
	    	let template = '';
	    	materias.forEach(m => {
	      		template += `
	                <tr class="tablitatr">
	                  	<td>${m.id}</td>
	                  	<td>${m.materia}</td>
	                  	<td>${m.descripcion}</td>
	                  	<td>
	                    	<button class="btn btn-success btn-sm" onclick="editar(${m.id}, '${m.materia}', '${m.descripcion}');">
	                     		Editar
	                    	</button>
	                  	</td>
	                  	<td>
	                    	<button class="btn btn-danger btn-sm" onclick="if(!confirm(\'Se borrará el registro seleccionado\'))return false; else eliminar(${m.id});">
	                     		Borrar
	                    	</button>
	                  	</td>
	                </tr>
	                `
	        });
	    	$('#materias').html(template);
	  	}
	});
}