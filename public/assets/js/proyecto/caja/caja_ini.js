var formdata_exportar_caja = null;
//eventos_exportacion();

function eventos_exportacion() {
    let form = document.querySelector('#form_caja_exportar');
    let btn = document.querySelector('#btn_caja_exportar');
    
    form.addEventListener('submit',
    function(e){
        e.preventDefault();
        let form = document.querySelector('#form_caja_exportar');
        formdata_exportar_caja = new FormData(form);
        console.log('si entra');
        var xhr = new XMLHttpRequest();
        xhr.open('POST','/Caja/Exportar', true);
        //xhr.overrideMimeType("application/pdf");
        xhr.onload = function(){
            // 1 4
            if(this.readyState == 1 && this.status == 200){

            }
            if(this.readyState == 4 && this.status == 200){
                console.log(xhr.responseText);
                let iframe = document.createElement('iframe');
                iframe.setAttribute('src',xhr.responseText);
                let container = document.querySelector('#pdf_container');
                container.innerHTML = "";
                container.append(iframe);
                $('#modalexportarcaja').modal('hide');
                $('#modal_pdf').modal('show');
                console.log(formdata_exportar_caja);
                
            }
        }
        xhr.onreadystatechange = function(){
            // 1 2 3 4
            if(this.readyState == 1 && this.status == 200){
                
            }
        }
        xhr.onerror = function() {
            console.log('presenta error');
        }
        xhr.send(formdata_exportar_caja);
    });
}

$(function(){

})

