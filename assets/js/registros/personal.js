$(document).ready(function(){


    /**
     * Modal
     */
    $(document).on('click', '.verDetalleModal',function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var personal = $(this).data('personal');
        //$('#personalPdf').attr('href', '<?=base_url("Registros/Registro/fichaPersonal/")?>'+personal);
        $('#personalPdf').attr('href', "registros/personal/ficha/"+personal);
        $('#personalGafete').attr('href', "registros/personal/gafete/"+personal);
        $('#personalGafeteTrasera').attr('href', "registros/personal/gafeteB/"+personal);
        //console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            success: function(data){
                $('#bodyModal').empty();
                $('#bodyModal').html(data);
            }
        })
        /**
         * /modal
         */

//		var curp = "GUMA830801HTSRRL00";
            //capacitaciones
// 		$.ajax({
// 			url: '',
// 			type: 'POST',
// 			data: {curp:curp},

// 			success: function(datos) {
//                 console.log(datos);
// alert("hola");
// 			alert(datos);
//             }
// 		})

            // fetch('http://setcapacitacion.tamaulipas.gob.mx/mec/api/personal-calendarizado/', {
            //   method:'POST',

            //     body: JSON.stringify({
            //     curp:curp,
            //     })
            // });

        var url     = 'http://setcapacitacion.tamaulipas.gob.mx/mec/api/personal-calendarizado';
        var params  = "curp="+$(this).data('curp');
        var xhr     = new XMLHttpRequest();
        let nombre_curso = "";
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);

        xhr.onreadystatechange = function(data) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const curs = JSON.parse(xhr.responseText);

                if (Object.keys(curs) == "") {
                    document.getElementById("capacitaciones").style.display="none";

                } else {
                    for (const x in curs) {
                        var newCurso = document.createElement("div");
                        newCurso.textContent = curs[x].nombre_curso;
                        var currentDiv = document.getElementById("nombre_curso");
                        currentDiv.appendChild(newCurso);
                        var nwefechaini = document.createElement("div");
                        nwefechaini.textContent = curs[x].fecha_inicio_curso;
                        var currentDiv = document.getElementById("fecha_inicio");
                        currentDiv.appendChild(nwefechaini);
                        var newFechafin = document.createElement("div");
                        newFechafin.textContent = curs[x].fecha_fin_curso;
                        var currentDiv = document.getElementById("fecha_fin");
                        currentDiv.appendChild(newFechafin);
                    }
                    //console.log(JSON.parse(xhr.responseText));
                }
            }

        }

        /**
         let response = fetch(url, {
        method: 'POST',
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
        },
        body: JSON.stringify({curp: 'GASJ841229HTSRSN09'})
      }).then(async (app) => {
        let promise = new Promise((resolve, reject) => {
          setTimeout(() => resolve("done!"), 6000)
          console.log(reject);
        })
        let result = await promise;
        console.log(promise);
      })




         async function fetchAPI(apiURL) {
        let response = await fetch(url, {
          method: 'POST',
          headers: {
            "Content-type": "application/x-www-form-urlencoded",
          },
          body: JSON.stringify({curp: 'guma830801htsrrl00'})
        });
        let data = await response.json();
        return data;
      }

         fetchAPI(url).then(data => {
        console.log('Toda la info: ', data);
      }).catch(error => {console.log(error)});

         */
    })
})