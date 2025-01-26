	function confi() {

	 alert("Se Modifido Correctamente");	
	}
// confi();
function editar(){

 var data = new FormData(); 

   
    var  imagen = document.getElementById("imagen");
    var imgfin = imagen.files[0];
    if (imgfin !== undefined) {
       data.append("imagen", imgfin);
    }
    data.append("param21", $("#Conteni").val());
    data.append("param22", $("#id").val());


   $.ajax({
    
    url: 'confi_inicioenviar.php',
    type: 'POST',
    data: data,
     contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
    })
   // .done(function(res){

   //     // $('#resultado').html(res)
   //     alert("Ingresado Correctamente" );
        
   //  });



    alert("Modifido Correctamente");
    window.location.href='confi_inicio.php';
}

function editar1(){

 var data = new FormData(); 

   
    var  imagen = document.getElementById("imagen1");
    var imgfin = imagen.files[0];
    if (imgfin !== undefined) {
       data.append("imagen", imgfin);
    }
    data.append("param21", $("#Conteni1").val());
    data.append("param22", $("#id1").val());


   $.ajax({
    
    url: 'confi_inicioenviar.php',
    type: 'POST',
    data: data,
     contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
    }).done(function(res){

       // $('#resultado').html(res)
       alert("Ingresado Correctamente" );
         window.location.href='confi_inicio.php';
    });



      alert("Modifido Correctamente");
    window.location.href='confi_inicio.php';
}

function editar2(){

 var data = new FormData(); 

   
    var  imagen = document.getElementById("imagen2");
    var imgfin = imagen.files[0];
    if (imgfin !== undefined) {
       data.append("imagen", imgfin);
    }
    data.append("param21", $("#Conteni2").val());
    data.append("param22", $("#id2").val());


   $.ajax({
    
    url: 'confi_inicioenviar.php',
    type: 'POST',
    data: data,
     contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
    })

alert("Modifido Correctamente");
    window.location.href='confi_inicio.php';


    // alert("USUARIO O CONTRASEÑA INCORRECTA");
}

function editar3(){

 var data = new FormData(); 

   
    var  imagen = document.getElementById("imagen3");
    var imgfin = imagen.files[0];
       var  imagen1 = document.getElementById("docum4");
        var imgfin1 = imagen1.files[0];
    
    if (imgfin !== undefined) {
       data.append("imagen","imagen1", imgfin);
    }
    data.append("param21", $("#Conteni3").val());
    data.append("param22", $("#id3").val());
    data.append("param23", $("#titu3").val());

   $.ajax({
    
    url: 'confi_inicioenviar.php',
    type: 'POST',
    data: data,
     contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
    })

   alert("Modifido Correctamente");
    window.location.href='confi_inicio.php';
    // alert("USUARIO O CONTRASEÑA INCORRECTA");
}

function editar6(){

var data = new FormData(); 

   
    var  imagen = document.getElementById("imagen4");
    var imgfin = imagen.files[0];
       var  imagen1 = document.getElementById("docum6");
        var imgfin1 = imagen1.files[0];
    
    if (imgfin !== undefined) {
       data.append("imagen","imagen1", imgfin);

    data.append("param21", $("#Conteni4").val());
    data.append("param22", $("#id4").val());
    data.append("param23", $("#titu4").val());




   $.ajax({
    
    url: 'confi_inicioenviar.php',
    type: 'POST',
    data: data,
     contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
    })

   alert("Modifido Correctamente");
    window.location.href='confi_inicio.php';
    // alert("USUARIO O CONTRASEÑA INCORRECTA");
}

function editar5(){

 var data = new FormData(); 

   
    var  imagen = document.getElementById("imagen5");
    var imgfin = imagen.files[0];
        var  imagen1 = document.getElementById("docum5");
        var imgfin1 = imagen1.files[0];
    
    if (imgfin !== undefined) {
       data.append("imagen","imagen1", imgfin);
    }


    // var  imagen1 = document.getElementById("docum5");
    // var imgfin1 = imagen1.files[0];
    // if (imgfin1 !== undefined) {
    //    data.append("imagen1", imgfin1);
    // }


    data.append("param21", $("#Conteni5").val());
    data.append("param22", $("#id5").val());
    data.append("param23", $("#titu5").val());




   $.ajax({
    
    url: 'confi_inicioenviar.php',
    type: 'POST',
    data: data,
     contentType: false,
        processData: false,
        cache: false,
        dataType: "json",
    })

   alert("Modifido Correctamente");
    window.location.href='confi_inicio.php';

    // alert("USUARIO O CONTRASEÑA INCORRECTA");
}
